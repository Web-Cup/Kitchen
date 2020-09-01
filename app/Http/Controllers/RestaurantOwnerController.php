<?php

namespace App\Http\Controllers;

use App\Addon;
use App\AddonCategory;
use App\Item;
use App\ItemCategory;
use App\Order;
use App\PushNotify;
use App\Restaurant;
use App\RestaurantEarning;
use App\RestaurantPayout;
use App\Orderitem;
use App\OrderItemAddon;
use App\Sms;
use App\User;
use App\Address;
use Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Image;
use Illuminate\Support\Facades\Hash;

class RestaurantOwnerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $restaurant = $user->restaurants;

        $restaurantIds = $user->restaurants->pluck('id')->toArray();
        // dd($restaurantIds);

        $newOrders = Order::whereIn('restaurant_id', $restaurantIds)
            ->where('orderstatus_id', '1')
            ->orderBy('id', 'DESC')
            ->with('restaurant')
            ->get();

        $newOrdersIds = $newOrders->pluck('id')->toArray();

        $acceptedOrders = Order::whereIn('restaurant_id', $restaurantIds)
            ->whereIn('orderstatus_id', ['2', '3', '7'])
            ->orderBy('id', 'DESC')
            ->get();

        $allOrders = Order::whereIn('restaurant_id', $restaurantIds)
            ->with('orderitems')
            ->get();
        $ordersCount = count($allOrders);

        $orderItemsCount = 0;
        foreach ($allOrders as $order) {
            $orderItemsCount += count($order->orderitems);
        }

        $allCompletedOrders = Order::whereIn('restaurant_id', $restaurantIds)
            ->where('orderstatus_id', '5')
            ->with('orderitems')
            ->get();

        $totalEarning = 0;
        settype($var, 'float');

        foreach ($allCompletedOrders as $completedOrder) {
            $totalEarning += $completedOrder->total;
        }

        return view('restaurantowner.dashboard', array(
            'restaurantsCount' => count($user->restaurants),
            'ordersCount' => $ordersCount,
            'orderItemsCount' => $orderItemsCount,
            'totalEarning' => $totalEarning,
            'newOrders' => $newOrders,
            'newOrdersIds' => $newOrdersIds,
            'acceptedOrders' => $acceptedOrders,
        ));
    }
 
    /**
     * @param Request $request
     */
    public function getNewOrders(Request $request)
    {
        $user = Auth::user();

        $restaurant = $user->restaurants;

        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $listedOrderIds = $request->listed_order_ids;
        if ($listedOrderIds) {
            $newOrders = Order::whereIn('restaurant_id', $restaurantIds)
                ->whereNotIn('id', $listedOrderIds)
                ->where('orderstatus_id', '1')
                ->orderBy('id', 'DESC')
                ->with('restaurant', 'restaurant.location')
                ->get();
        } else {
            $newOrders = Order::whereIn('restaurant_id', $restaurantIds)
                ->where('orderstatus_id', '1')
                ->orderBy('id', 'DESC')
                ->with('restaurant', 'restaurant.location')
                ->get();
        }

        return response()->json($newOrders);
    }

    /**
     * @param $id
     */
    public function acceptOrder($id)
    {
        $user = Auth::user();
        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $order = Order::where('id', $id)->whereIn('restaurant_id', $restaurantIds)->first();

        if ($order->orderstatus_id == '1') {
            $order->orderstatus_id = 2;
            $order->save();

            if (config('settings.enablePushNotificationOrders') == 'true') {
                //to user
                $notify = new PushNotify();
                $notify->sendPushNotification('2', $order->user_id, $order->unique_order_id);
            }

            // Send Push Notification to Delivery Guy
            if (config('settings.enablePushNotificationOrders') == 'true') {
                //get restaurant
                $restaurant = Restaurant::where('id', $order->restaurant_id)->first();
                if ($restaurant) {
                    //get all pivot users of restaurant (delivery guy/ res owners)
                    $pivotUsers = $restaurant->users()
                        ->wherePivot('restaurant_id', $order->restaurant_id)
                        ->get();
                    //filter only res owner and send notification.
                    foreach ($pivotUsers as $pU) {
                        if ($pU->hasRole('Delivery Guy')) {
                            //send Notification to Res Owner
                            $notify = new PushNotify();
                            $notify->sendPushNotification('TO_DELIVERY', $pU->id);
                        }
                    }
                }
            }
            // END Send Push Notification to Delivery Guy

            // Send SMS Notification to Delivery Guy
            if (config('settings.smsDeliveryNotify') == 'true') {
                //get restaurant
                $restaurant = Restaurant::where('id', $order->restaurant_id)->first();
                if ($restaurant) {
                    //get all pivot users of restaurant (delivery guy/ res owners)
                    $pivotUsers = $restaurant->users()
                        ->wherePivot('restaurant_id', $order->restaurant_id)
                        ->get();
                    //filter only res owner and send notification.
                    foreach ($pivotUsers as $pU) {
                        if ($pU->hasRole('Delivery Guy')) {
                            //send sms to Delivery Guy
                            if ($pU->delivery_guy_detail->is_notifiable) {
                                $message = config('settings.defaultSmsDeliveryMsg');
                                $otp = null;
                                $smsnotify = new Sms();
                                $smsnotify->processSmsAction('OD_NOTIFY', $pU->phone, $otp, $message);
                            }
                        }
                    }
                }
            }
            // END Send SMS Notification to Delivery Guy

            if (\Illuminate\Support\Facades\Request::ajax()) {
                return response()->json(['success' => true]);
            } else {
                return redirect()->back()->with(array('success' => 'Order Accepted'));
            }

        } else {
            if (\Illuminate\Support\Facades\Request::ajax()) {
                return response()->json(['success' => false], 406);
            } else {
                return redirect()->back()->with(array('message' => 'Something went wrong.'));
            }
        }
    }
    public function finishOrder($order_id){
        $order = Order::where('unique_order_id', $order_id)->first();
        $order->orderstatus_id = 8;
        $order->finished_at = date("Y-m-d H:i:s");
        $order->save();
        // Send SMS Notification to Delivery Guy
        if (config('settings.smsDeliveryNotify') == 'true') {
            //get restaurant
            $restaurant = Restaurant::where('id', $order->restaurant_id)->first();
            if ($restaurant) {
                //get all pivot users of restaurant (delivery guy/ res owners)
                $pivotUsers = $restaurant->users()
                    ->wherePivot('restaurant_id', $order->restaurant_id)
                    ->get();
                //filter only res owner and send notification.
                foreach ($pivotUsers as $pU) {
                    if ($pU->hasRole('Delivery Guy')) {
                        //send Notification to Delivery Guy
                        $message = config('settings.defaultSmsDeliveryMsg');
                        $otp = null;
                        $smsnotify = new Sms();
                        $smsnotify->processSmsAction('OD_NOTIFY', $pU->phone, $otp, $message);
                    }
                }
            }
        }
        // END Send SMS Notification to Delivery Guy

        return redirect()->back()->with(array('success' => 'Order Finished'));
        
    }

    /**
     * @param $id
     */
    public function markOrderReady($id)
    {
        $user = Auth::user();
        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $order = Order::where('id', $id)->whereIn('restaurant_id', $restaurantIds)->first();

        if ($order->orderstatus_id == '2') {
            $order->orderstatus_id = 7;
            $order->save();

            if (config('settings.enablePushNotificationOrders') == 'true') {

                //to user
                $notify = new PushNotify();
                $notify->sendPushNotification('7', $order->user_id, $order->unique_order_id);
            }

            return redirect()->back()->with(array('success' => 'Order Marked as Ready'));
        } else {
            return redirect()->back()->with(array('message' => 'Something went wrong.'));
        }
    }

    /**
     * @param $id
     */
    public function markSelfPickupOrderAsCompleted($id)
    {
        $user = Auth::user();
        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $order = Order::where('id', $id)->whereIn('restaurant_id', $restaurantIds)->first();

        if ($order->orderstatus_id == '7') {
            $order->orderstatus_id = 5;
            $order->save();

            //if selfpickup add amount to restaurant earnings if not COD then add order total
            if ($order->payment_mode == 'STRIPE' || $order->payment_mode == 'PAYPAL' || $order->payment_mode == 'PAYSTACK' || $order->payment_mode == 'RAZORPAY') {
                $restaurant_earning = RestaurantEarning::where('restaurant_id', $order->restaurant->id)
                    ->where('is_requested', 0)
                    ->first();
                if ($restaurant_earning) {
                    $restaurant_earning->amount += $order->total;
                    $restaurant_earning->save();
                } else {
                    $restaurant_earning = new RestaurantEarning();
                    $restaurant_earning->restaurant_id = $order->restaurant->id;
                    $restaurant_earning->amount = $order->total;
                    $restaurant_earning->save();
                }
            }
            //if COD, then take the $total minus $payable amount
            if ($order->payment_mode == 'COD') {
                $restaurant_earning = RestaurantEarning::where('restaurant_id', $order->restaurant->id)
                    ->where('is_requested', 0)
                    ->first();
                if ($restaurant_earning) {
                    $restaurant_earning->amount += $order->total - $order->payable;
                    $restaurant_earning->save();
                } else {
                    $restaurant_earning = new RestaurantEarning();
                    $restaurant_earning->restaurant_id = $order->restaurant->id;
                    $restaurant_earning->amount = $order->total - $order->payable;
                    $restaurant_earning->save();
                }
            }

            if (config('settings.enablePushNotificationOrders') == 'true') {

                //to user
                $notify = new PushNotify();
                $notify->sendPushNotification('5', $order->user_id, $order->unique_order_id);
            }

            return redirect()->back()->with(array('success' => 'Order Completed'));
        } else {
            return redirect()->back()->with(array('message' => 'Something went wrong.'));
        }
    }

    public function restaurants()
    {
        $user = Auth::user();
        $restaurants = $user->restaurants;

        return view('restaurantowner.restaurants', array(
            'restaurants' => $restaurants,
        ));
    }

    /**
     * @param $id
     */
    public function getEditRestaurant($id)
    {
        $user = Auth::user();
        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $restaurant = Restaurant::where('id', $id)->whereIn('id', $restaurantIds)->first();

        if ($restaurant) {

            return view('restaurantowner.editRestaurant', array(
                'restaurant' => $restaurant,
                'schedule_data' => json_decode($restaurant->schedule_data),
            ));
        } else {
            return redirect()->route('restaurant.restaurants')->with(array('message' => 'Access Denied'));
        }
    }

    /**
     * @param $id
     */
    public function disableRestaurant($id)
    {
        $restaurant = Restaurant::where('id', $id)->first();
        if ($restaurant) {
            $restaurant->toggleActive()->save();
            return redirect()->back()->with(array('success' => 'Operation Successful'));
        } else {
            return redirect()->route('restaurant.restaurants');
        }
    }

    /**
     * @param Request $request
     */
    public function saveNewRestaurant(Request $request)
    {
        $restaurant = new Restaurant();

        $restaurant->name = $request->name;
        $restaurant->description = $request->description;

        $image = $request->file('image');
        $rand_name = time() . str_random(10);
        $filename = $rand_name . '.' . $image->getClientOriginalExtension();
        Image::make($image)
            ->resize(160, 117)
            ->save(base_path('assets/img/restaurants/' . $filename));
        $restaurant->image = '/assets/img/restaurants/' . $filename;

        $restaurant->delivery_time = $request->delivery_time;
        $restaurant->price_range = $request->price_range;

        if ($request->is_pureveg == 'true') {
            $restaurant->is_pureveg = true;
        } else {
            $restaurant->is_pureveg = false;
        }

        $restaurant->slug = str_slug($request->name) . '-' . str_random(15);
        $restaurant->certificate = $request->certificate;

        $restaurant->address = $request->address;
        $restaurant->pincode = $request->pincode;
        $restaurant->landmark = $request->landmark;
        $restaurant->latitude = $request->latitude;
        $restaurant->longitude = $request->longitude;

        $restaurant->restaurant_charges = $request->restaurant_charges;

        $restaurant->sku = time() . str_random(10);

        $restaurant->is_active = 0;

        $restaurant->min_order_price = $request->min_order_price;

        try {
            $restaurant->save();
            $user = Auth::user();
            $user->restaurants()->attach($restaurant);
            return redirect()->back()->with(array('success' => 'Restaurant Saved'));
        } catch (\Illuminate\Database\QueryException $qe) {
            return redirect()->back()->with(['message' => $qe->getMessage()]);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => $th]);
        }
    }

    /**
     * @param Request $request
     */
    public function updateRestaurant(Request $request)
    {
        $restaurant = Restaurant::where('id', $request->id)->first();

        if ($restaurant) {
            $restaurant->name = $request->name;
            $restaurant->description = $request->description;

            if ($request->image == null) {
                $restaurant->image = $request->old_image;
            } else {
                $image = $request->file('image');
                $rand_name = time() . str_random(10);
                $filename = $rand_name . '.' . $image->getClientOriginalExtension();

                Image::make($image)
                    ->resize(160, 117)
                    ->save(base_path('assets/img/restaurants/' . $filename));
                $restaurant->image = '/assets/img/restaurants/' . $filename;

            }

            $restaurant->delivery_time = $request->delivery_time;
            $restaurant->price_range = $request->price_range;

            if ($request->is_pureveg == 'true') {
                $restaurant->is_pureveg = true;
            } else {
                $restaurant->is_pureveg = false;
            }

            $restaurant->certificate = $request->certificate;

            $restaurant->address = $request->address;
            $restaurant->pincode = $request->pincode;
            $restaurant->landmark = $request->landmark;
            $restaurant->latitude = $request->latitude;
            $restaurant->longitude = $request->longitude;

            $restaurant->restaurant_charges = $request->restaurant_charges;

            $restaurant->min_order_price = $request->min_order_price;

            if ($request->is_schedulable == 'true') {
                $restaurant->is_schedulable = true;
            } else {
                $restaurant->is_schedulable = false;
            }

            try {
                $restaurant->save();
                return redirect()->back()->with(array('success' => 'Restaurant Updated'));
            } catch (\Illuminate\Database\QueryException $qe) {
                return redirect()->back()->with(['message' => $qe->getMessage()]);
            } catch (Exception $e) {
                return redirect()->back()->with(['message' => $e->getMessage()]);
            } catch (\Throwable $th) {
                return redirect()->back()->with(['message' => $th]);
            }
        }
    }

    public function itemcategories()
    {
        $itemCategories = ItemCategory::orderBy('id', 'DESC')
            ->where('user_id', Auth::user()->id)
            ->get();
        $itemCategories->loadCount('items');
        $count = count($itemCategories);

        return view('restaurantowner.itemcategories', array(
            'itemCategories' => $itemCategories,
            'count' => $count,
        ));
    }

    /**
     * @param Request $request
     */
    public function createItemCategory(Request $request)
    {
        $itemCategory = new ItemCategory();

        $itemCategory->name = $request->name;
        $itemCategory->user_id = Auth::user()->id;

        try {
            $itemCategory->save();
            return redirect()->back()->with(array('success' => 'Category Created'));
        } catch (\Illuminate\Database\QueryException $qe) {
            return redirect()->back()->with(['message' => $qe->getMessage()]);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => $th]);
        }
    }

    /**
     * @param $id
     */
    public function disableCategory($id)
    {
        $itemCategory = ItemCategory::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        if ($itemCategory) {
            $itemCategory->toggleEnable()->save();
            return redirect()->back()->with(array('success' => 'Operation Successful'));
        } else {
            return redirect()->route('restaurant.itemcategories');
        }
    }

    /**
     * @param Request $request
     */
    public function updateItemCategory(Request $request)
    {
        $itemCategory = ItemCategory::where('id', $request->id)->where('user_id', Auth::user()->id)->firstOrFail();
        $itemCategory->name = $request->name;
        $itemCategory->save();
        return redirect()->back()->with(['success' => 'Operation Successful']);
    }

    public function items()
    {
        $user = Auth::user();

        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $items = Item::whereIn('restaurant_id', $restaurantIds)
            ->orderBy('id', 'DESC')
            ->with('item_category', 'restaurant')
            ->paginate(20);

        $count = $items->total();

        $restaurants = $user->restaurants;

        $itemCategories = ItemCategory::where('is_enabled', '1')
            ->where('user_id', Auth::user()->id)
            ->get();
        $addonCategories = AddonCategory::where('user_id', Auth::user()->id)->get();

        return view('restaurantowner.items', array(
            'items' => $items,
            'count' => $count,
            'restaurants' => $restaurants,
            'itemCategories' => $itemCategories,
            'addonCategories' => $addonCategories,
        ));
    }

    /**
     * @param Request $request
     */
    public function searchItems(Request $request)
    {
        $user = Auth::user();

        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $query = $request['query'];

        $items = Item::whereIn('restaurant_id', $restaurantIds)
            ->where('name', 'LIKE', '%' . $query . '%')
            ->with('item_category', 'restaurant')
            ->paginate(20);

        $count = $items->total();

        $restaurants = Restaurant::get();
        $itemCategories = ItemCategory::where('is_enabled', '1')->get();
        $addonCategories = AddonCategory::where('user_id', Auth::user()->id)->get();

        return view('restaurantowner.items', array(
            'items' => $items,
            'count' => $count,
            'restaurants' => $restaurants,
            'query' => $query,
            'itemCategories' => $itemCategories,
            'addonCategories' => $addonCategories,
        ));
    }

    /**
     * @param Request $request
     */
    public function saveNewItem(Request $request)
    {
        // dd($request->all());

        $item = new Item();

        $item->name = $request->name;
        $item->price = $request->price;
        $item->old_price = $request->old_price == null ? 0 : $request->old_price;
        $item->restaurant_id = $request->restaurant_id;
        $item->item_category_id = $request->item_category_id;

        $image = $request->file('image');
        $rand_name = time() . str_random(10);
        $filename = $rand_name . '.jpg';
        Image::make($image)
            ->resize(486, 355)
            ->save(base_path('assets/img/items/' . $filename), config('settings.uploadImageQuality '), 'jpg');

        $item->image = '/assets/img/items/' . $filename;

        if ($request->is_recommended == 'true') {
            $item->is_recommended = true;
        } else {
            $item->is_recommended = false;
        }

        if ($request->is_popular == 'true') {
            $item->is_popular = true;
        } else {
            $item->is_popular = false;
        }

        if ($request->is_new == 'true') {
            $item->is_new = true;
        } else {
            $item->is_new = false;
        }

        if ($request->is_veg == 'true') {
            $item->is_veg = true;
        } else {
            $item->is_veg = false;
        }
        $item->desc = $request->desc;
        try {
            $item->save();
            if (isset($request->addon_category_item)) {
                $item->addon_categories()->sync($request->addon_category_item);
            }
            return redirect()->back()->with(['success' => 'Item Saved']);
        } catch (\Illuminate\Database\QueryException $qe) {
            return redirect()->back()->with(['message' => $qe->getMessage()]);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => $th]);
        }
    }

    /**
     * @param $id
     */
    public function getEditItem($id)
    {
        $user = Auth::user();
        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $item = Item::where('id', $id)
            ->whereIn('restaurant_id', $restaurantIds)
            ->first();

        $addonCategories = AddonCategory::where('user_id', Auth::user()->id)->get();

        if ($item) {
            $restaurants = $user->restaurants;
            $itemCategories = ItemCategory::where('is_enabled', '1')
                ->where('user_id', Auth::user()->id)
                ->get();

            return view('restaurantowner.editItem', array(
                'item' => $item,
                'restaurants' => $restaurants,
                'itemCategories' => $itemCategories,
                'addonCategories' => $addonCategories,
            ));
        } else {
            return redirect()->route('restaurant.items')->with(array('message' => 'Access Denied'));
        }
    }

    /**
     * @param $id
     */
    public function disableItem($id)
    {
        $user = Auth::user();
        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $item = Item::where('id', $id)
            ->whereIn('restaurant_id', $restaurantIds)
            ->first();
        if ($item) {
            $item->toggleActive()->save();
            return redirect()->back()->with(array('success' => 'Operation Successful'));
        } else {
            return redirect()->route('restaurant.items');
        }
    }

    /**
     * @param Request $request
     */
    public function updateItem(Request $request)
    {
        $user = Auth::user();
        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $item = Item::where('id', $request->id)
            ->whereIn('restaurant_id', $restaurantIds)
            ->first();

        if ($item) {
            $item->name = $request->name;
            $item->restaurant_id = $request->restaurant_id;
            $item->item_category_id = $request->item_category_id;

            if ($request->image == null) {
                $item->image = $request->old_image;
            } else {
                $image = $request->file('image');
                $rand_name = time() . str_random(10);
                $filename = $rand_name . '.jpg';
                Image::make($image)
                    ->resize(486, 355)
                    ->save(base_path('assets/img/items/' . $filename), config('settings.uploadImageQuality '), 'jpg');
                $item->image = '/assets/img/items/' . $filename;

            }

            $item->price = $request->price;
            $item->old_price = $request->old_price == null ? 0 : $request->old_price;

            if ($request->is_recommended == 'true') {
                $item->is_recommended = true;
            } else {
                $item->is_recommended = false;
            }

            if ($request->is_popular == 'true') {
                $item->is_popular = true;
            } else {
                $item->is_popular = false;
            }

            if ($request->is_new == 'true') {
                $item->is_new = true;
            } else {
                $item->is_new = false;
            }

            if ($request->is_veg == 'true') {
                $item->is_veg = true;
            } else {
                $item->is_veg = false;
            }

            $item->desc = $request->desc;
            try {
                $item->save();
                if (isset($request->addon_category_item)) {
                    $item->addon_categories()->sync($request->addon_category_item);
                }
                if ($request->remove_all_addons == '1') {
                    $item->addon_categories()->sync($request->addon_category_item);
                }
                return redirect()->back()->with(array('success' => 'Item Saved'));
            } catch (\Illuminate\Database\QueryException $qe) {
                return redirect()->back()->with(['message' => $qe->getMessage()]);
            } catch (Exception $e) {
                return redirect()->back()->with(['message' => $e->getMessage()]);
            } catch (\Throwable $th) {
                return redirect()->back()->with(['message' => $th]);
            }
        }
    }

    public function addonCategories()
    {

        $addonCategories = AddonCategory::where('user_id', Auth::user()->id)
            ->orderBy('id', 'DESC')
            ->paginate(20);
        $addonCategories->loadCount('addons');

        $count = $addonCategories->total();

        return view('restaurantowner.addonCategories', array(
            'addonCategories' => $addonCategories,
            'count' => $count,
        ));
    }

    /**
     * @param Request $request
     */
    public function searchAddonCategories(Request $request)
    {
        $query = $request['query'];

        $addonCategories = AddonCategory::where('user_id', Auth::user()->id)
            ->where('name', 'LIKE', '%' . $query . '%')
            ->paginate(20);
        $addonCategories->loadCount('addons');

        $count = $addonCategories->total();

        return view('restaurantowner.addonCategories', array(
            'addonCategories' => $addonCategories,
            'count' => $count,
        ));
    }

    /**
     * @param Request $request
     */
    public function saveNewAddonCategory(Request $request)
    {
        $addonCategory = new AddonCategory();

        $addonCategory->name = $request->name;
        $addonCategory->type = $request->type;
        $addonCategory->user_id = Auth::user()->id;

        try {
            $addonCategory->save();
            return redirect()->back()->with(array('success' => 'Addon Category Saved'));
        } catch (\Illuminate\Database\QueryException $qe) {
            return redirect()->back()->with(array('message' => 'Something went wrong. Please check your form and try again.'));
        } catch (Exception $e) {
            return redirect()->back()->with(array('message' => $e->getMessage()));
        } catch (\Throwable $th) {
            return redirect()->back()->with(array('message' => $th));
        }
    }

    /**
     * @param $id
     */
    public function getEditAddonCategory($id)
    {
        $addonCategory = AddonCategory::where('id', $id)->first();
        if ($addonCategory) {
            if ($addonCategory->user_id == Auth::user()->id) {
                return view('restaurantowner.editAddonCategory', array(
                    'addonCategory' => $addonCategory,
                ));
            } else {
                return redirect()
                    ->route('restaurant.editAddonCategory')
                    ->with(array('message' => 'Access Denied'));
            }
        } else {
            return redirect()
                ->route('restaurant.editAddonCategory')
                ->with(array('message' => 'Access Denied'));
        }
    }

    /**
     * @param Request $request
     */
    public function updateAddonCategory(Request $request)
    {
        $addonCategory = AddonCategory::where('id', $request->id)->first();

        if ($addonCategory) {
            $addonCategory->name = $request->name;
            $addonCategory->type = $request->type;

            try {
                $addonCategory->save();
                return redirect()->back()->with(array('success' => 'Addon Category Updated'));
            } catch (\Illuminate\Database\QueryException $qe) {
                return redirect()->back()->with(array('message' => 'Something went wrong. Please check your form and try again.'));
            } catch (Exception $e) {
                return redirect()->back()->with(array('message' => $e->getMessage()));
            } catch (\Throwable $th) {
                return redirect()->back()->with(array('message' => $th));
            }
        }
    }

    public function addons()
    {
        $addons = Addon::where('user_id', Auth::user()->id)->with('addon_category')->paginate();

        $count = $addons->total();

        $addonCategories = AddonCategory::where('user_id', Auth::user()->id)->get();

        return view('restaurantowner.addons', array(
            'addons' => $addons,
            'count' => $count,
            'addonCategories' => $addonCategories,
        ));
    }

    /**
     * @param Request $request
     */
    public function searchAddons(Request $request)
    {
        $query = $request['query'];

        $addons = Addon::where('user_id', Auth::user()->id)
            ->where('name', 'LIKE', '%' . $query . '%')
            ->with('addon_category')
            ->paginate(20);

        $count = $addons->total();

        $addonCategories = AddonCategory::where('user_id', Auth::user()->id)->get();

        return view('restaurantowner.addons', array(
            'addons' => $addons,
            'count' => $count,
            'addonCategories' => $addonCategories,
        ));
    }

    /**
     * @param Request $request
     */
    public function saveNewAddon(Request $request)
    {
        $addon = new Addon();

        $addon->name = $request->name;
        $addon->price = $request->price;
        $addon->user_id = Auth::user()->id;
        $addon->addon_category_id = $request->addon_category_id;

        try {
            $addon->save();
            return redirect()->back()->with(array('success' => 'Addon Saved'));
        } catch (\Illuminate\Database\QueryException $qe) {
            return redirect()->back()->with(array('message' => 'Something went wrong. Please check your form and try again.'));
        } catch (Exception $e) {
            return redirect()->back()->with(array('message' => $e->getMessage()));
        } catch (\Throwable $th) {
            return redirect()->back()->with(array('message' => $th));
        }
    }

    /**
     * @param $id
     */
    public function getEditAddon($id)
    {
        $addon = Addon::where('id', $id)
            ->where('user_id', Auth::user()->id)
            ->first();

        $addonCategories = AddonCategory::where('user_id', Auth::user()->id)->get();
        if ($addon) {
            return view('restaurantowner.editAddon', array(
                'addon' => $addon,
                'addonCategories' => $addonCategories,
            ));
        } else {
            return redirect()->route('restaurant.addons')->with(array('message' => 'Access Denied'));
        }
    }

    /**
     * @param Request $request
     */
    public function updateAddon(Request $request)
    {
        $addon = Addon::where('id', $request->id)->first();

        if ($addon) {
            if ($addon->user_id == Auth::user()->id) {
                $addon->name = $request->name;
                $addon->price = $request->price;
                $addon->addon_category_id = $request->addon_category_id;

                try {
                    $addon->save();
                    return redirect()->back()->with(array('success' => 'Addon Updated'));
                } catch (\Illuminate\Database\QueryException $qe) {
                    return redirect()->back()->with(array('message' => 'Something went wrong. Please check your form and try again.'));
                } catch (Exception $e) {
                    return redirect()->back()->with(array('message' => $e->getMessage()));
                } catch (\Throwable $th) {
                    return redirect()->back()->with(array('message' => $th));
                }
            } else {
                return redirect()->route('restaurant.addons')->with(array('message' => 'Access Denied'));
            }
        } else {
            return redirect()->route('restaurant.addons')->with(array('message' => 'Access Denied'));
        }
    }

    /**
     * @param $id
     */
    public function disableAddon($id)
    {
        $addon = Addon::where('id', $id)->firstOrFail();
        if ($addon) {
            $addon->toggleActive()->save();
            return redirect()->back()->with(['success' => 'Operation Successful']);
        } else {
            return redirect()->back()->with(['message' => 'Something Went Wrong']);
        }
    }
    public function orders85()
    {
        $user = Auth::user();
        if($user){
            $restaurantIds = $user->restaurants->pluck('id')->toArray();
    
            $orders = Order::orderBy('id', 'DESC')
                ->whereIn('restaurant_id', $restaurantIds)
                ->where('orderstatus_id',2)
                ->with('accept_delivery.user', 'restaurant')->get();
                // ->paginate('20');
            // $count = $orders->total();
            // dd($orders);
            // return view('restaurantowner.orders', array(
            //     'orders' => $orders,
            //     'count' => $count,
            // ));
    
            // To get all json data
            $json = file_get_contents(storage_path('products-export.json'));
            $objs = json_decode($json,true);
    
            // Breadcrumb
            $breadcrumbs = [
                ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Data List"], ['name'=>"Thumb View"]
            ];
            $newOrders = Order::whereIn('restaurant_id', $restaurantIds)
            ->where('orderstatus_id', '1')
            ->orderBy('id', 'DESC')
            ->with('restaurant')
            ->get();

            $newOrdersIds = $newOrders->pluck('id')->toArray();
            return view('restaurantowner.orders85', [
                'breadcrumbs' => $breadcrumbs,
                'products' => $objs['products'],
                'orders' => $orders,
                'newOrdersIds' => $newOrdersIds,
                'newOrders' => $newOrders,
            ]);
        }else{
            return redirect()->route('get.login');
        }
    }
    public function orders()
    {
        $cartorder = null;
        $user = Auth::user();
        if($user){
            $restaurantIds = $user->restaurants->pluck('id')->toArray();
            // var_dump($restaurantIds);exit;
            $orders = Order::orderBy('id', 'DESC')
                ->whereIn('restaurant_id', $restaurantIds)
                ->where('orderstatus_id',2)
                ->with('accept_delivery.user', 'restaurant')->get();
                // ->paginate('20');
            // $count = $orders->total();
            // dd($orders);
            // return view('restaurantowner.orders', array(
            //     'orders' => $orders,
            //     'count' => $count,
            // ));
    
            // To get all json data
            $json = file_get_contents(storage_path('products-export.json'));
            $objs = json_decode($json,true);
    
            // Breadcrumb
            $breadcrumbs = [
                ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Data List"], ['name'=>"Thumb View"]
            ];
            $newOrders = Order::whereIn('restaurant_id', $restaurantIds)
            ->where('orderstatus_id', '1')
            ->orderBy('id', 'DESC')
            ->with('restaurant')
            ->get();
            // $restaurants = $user->restaurants;
            // var_dump($restaurants);exit;
            $restaurants = Restaurant::where('is_accepted','1')->get();
            $newOrdersIds = $newOrders->pluck('id')->toArray();
            return view('restaurantowner.orders', [
                'breadcrumbs' => $breadcrumbs,
                'products' => $objs['products'],
                'cartorder' => $cartorder,
                'orders' => $orders,
                'restaurants' => $restaurants,
                'newOrdersIds' => $newOrdersIds,
                'newOrders' => $newOrders,
            ]);
        }else{
            return redirect()->route('get.login');
        }
    }
    public function viewshop($id)
    {
        $cartorder = 1;
        $user = Auth::user();
        if($user){
            $restaurantIds = $user->restaurants->pluck('id')->toArray();
            $Item = Item::orderBy('id', 'DESC')
            ->where('restaurant_id', $id)->get();
            $ItemIDs = DB::table('items')->select('id')->where('restaurant_id',$id)->get();
            $ItemCategoryIDs = DB::table('item_categories')->select('item_categories.id', 'item_categories.name')
            ->leftjoin('items','items.item_category_id','=','item_categories.id')
            ->where('items.restaurant_id',$id)
            ->where('item_categories.is_enabled','1')->get();
            if(count($ItemIDs) < 0 ){
                $addons = null;
               
            }else{ 
                foreach($ItemIDs as $ItemID)
                {
                    $singleID = $ItemID->id;
                    $addons[$singleID] = DB::table('addons')
                    ->leftjoin('addon_category_item','addon_category_item.addon_category_id','=','addons.addon_category_id')
                    ->where('addon_category_item.item_id',$singleID)->get();


                }                
            }                    
            if(!isset($addons)){
                        $addons = null;
            }

            $itemids = DB::table('items')->select('id')->where('restaurant_id',$id)->get();
            foreach($itemids as $key => $itemid){
                $single_itemid[$key] = $itemid->id;
                $addonValues[$key] = DB::table('addons')
                ->select('addons.name','addons.price', 'addons.id')
                ->join('addon_category_item','addon_category_item.addon_category_id','=','addons.addon_category_id')
                ->where(['item_id' => $single_itemid[$key]])
                ->get();
                $addonValue_length[$key] = count($addonValues[$key]);
            }
            if(!isset($addonValues)){
                $addonValues = null;
                $addonValue_length = null;
            }

                $json = file_get_contents(storage_path('products-export.json'));
                $objs = json_decode($json,true);
                
                // Breadcrumb
                $breadcrumbs = [
                    ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Data List"], ['name'=>"Thumb View"]
                ];
                $price = DB::table('orderitems')->where('order_id',$id)->get()->sum("price");
                $orderitemIDs = DB::table('order_item_addons')->select('orderitem_id')->get();
                if(count($orderitemIDs) > 0){
                    foreach($orderitemIDs as $orderitemID)
                    {
                        $singleitem_ID = $orderitemID->orderitem_id;
                        $sub_orderitems[$singleitem_ID] = DB::table('orderitems')->select('order_id', 'item_id')->where('id',$singleitem_ID)->get();
                        $count_suborderitems = $sub_orderitems[$singleitem_ID];
                        if(count($count_suborderitems) > 0){

                        }else{
                            $sub_orderitems = null;
                        }
                    }                    
                }else{
                    $sub_orderitems = null;
                }
                
                $sub_order= DB::table('orderitems')->select('order_id', 'item_id', 'quantity')->where('order_id',$id)->get();
                if(count($sub_order) > 0){
                }else{
                    $sub_order = null;
                }
                $count = DB::table('orderitems')->where('order_id',$id)->groupBy('item_id')->get()->count();
                $storename = DB::table('restaurants')->where('id',$id)->value('name');
                // $price = (float)$price*(int)$count;
                return view('restaurantowner.viewshop', [
                    'cartorder' => $cartorder,
                    'breadcrumbs' => $breadcrumbs,
                    'products' => $objs['products'],
                    'Item' => $Item,
                    'addons' => $addons,
                    'ItemCategoryIDs' => $ItemCategoryIDs,
                    'orderitemIDs' => $orderitemIDs,
                    'sub_order' => $sub_order,
                    'sub_orderitems' => $sub_orderitems,
                    'addonValues' => $addonValues,
                    'addonValue_length' => $addonValue_length,
                    'price' => $price,
                    'count' => $count,
                    'storename' => $storename,
                    'storeID' => $id,
                    ]);
        }else{
            return redirect()->route('get.login');
        }
    }
    public function storeValue(Request $request)
    {
        $customized= $request->customizableItem;
        if(isset($customized)){

                                $storeID= $request->storeID;
                                $item_id= $request->customizationID;
                                $customizationname= $request->customizationname;
                                $customizationimage= $request->customizationimage;
                                $customizationvalue= $request->customizationvalue;
                                $currentStatus= $request->currentStatus;

                                $price = DB::table('orderitems')->where('order_id',$storeID)->where('item_id',$item_id)->value('price');
                                if($currentStatus == "1"){
                                            $insertValue = (float)($customizationvalue);
                                            $newprice = (float)$insertValue + (float)$price;
                                }else{
                                    $insertValue = (float)($customizationvalue);
                                    $newprice = (float)$price - (float)$insertValue;
                                }


                                $quantity = DB::table('orderitems')->where('order_id',$storeID)->where('item_id',$item_id)->value('quantity');
                                if($quantity == ''){

                                    $order = new Orderitem();
                                    $order->order_id= $request->storeID;
                                    $order->item_id= $request->customizationID;
                                    $order->name= $request->customizationname;
                                    $order->image= $request->customizationimage;
                                    $order->quantity= 1;
                                    $order->price= $newprice;
                                    $order->original_price= $request->customizationvalue;
                                    $order->save();
                                }else{
                                    $value = $request->customizationvalue;
                                    $newquantity = (int)$quantity + 1;
                                    DB::table('orderitems')
                                    ->where('order_id',$storeID)->where('item_id',$item_id)
                                    ->update(['quantity' => $newquantity,'price' => $newprice]);
                                }
        }else{
                            $storeID= $request->storeID;
                            $item_id= $request->customizationID;
                            $customizationname= $request->customizationname;
                            $customizationimage= $request->customizationimage;
            

                            $currentStatus= $request->currentStatus;
                            $addonID= $request->addonID;
                            $addonname= $request->addonname;
                            $addonprice= $request->addonprice;
                            $customizationvalue= $request->customizationvalue;

                            $price = DB::table('orderitems')->where('order_id',$storeID)->where('item_id',$item_id)->value('price');
                            if($currentStatus == "1"){
                                        $insertValue = (float)($customizationvalue) + (float)($addonprice);
                                        $newprice = (float)$insertValue + (float)$price;
                            }else{
                                $insertValue = (float)($customizationvalue) + (float)($addonprice);
                                $newprice = (float)$price - (float)$insertValue;
                            }


                            $quantity = DB::table('orderitems')->where('order_id',$storeID)->where('item_id',$item_id)->value('quantity');
                            if($quantity == ''){

                                $order = new Orderitem();
                                $order->order_id= $request->storeID;
                                $order->item_id= $request->customizationID;
                                $order->name= $request->customizationname;
                                $order->image= $request->customizationimage;
                                $order->quantity= 1;
                                $order->price= $newprice;
                                $order->original_price= $request->customizationvalue;
                                $order->save();
                            }else{
                                $value = $request->customizationvalue;
                                $newquantity = (int)$quantity + 1;
                                DB::table('orderitems')
                                ->where('order_id',$storeID)->where('item_id',$item_id)
                                ->update(['quantity' => $newquantity,'price' => $newprice]);
                            }

                            $OrderitemID = DB::table('orderitems')
                            ->where('order_id',$storeID)->where('item_id',$item_id)->value('id');
                            $Check_addon = DB::table('order_item_addons')->where('orderitem_id',$OrderitemID)->where('addonID',$addonID)->get();
                            $quantityAddon = DB::table('order_item_addons')->where('orderitem_id',$OrderitemID)->where('addonID',$addonID)->value('quantity');
                            if(count($Check_addon) > 0){
                                if($currentStatus == "1"){
                                    $newquantity = (int)$quantityAddon + 1;
                                    DB::table('order_item_addons')
                                    ->where('orderitem_id',$OrderitemID)->where('addonID',$addonID)
                                    ->update(['quantity' => $newquantity]);
                                }else{
                                    $newquantity = (int)$quantityAddon - 1;
                                    if($newquantity == 0){
                                        DB::table('order_item_addons')
                                        ->where('orderitem_id',$OrderitemID)->where('addonID',$addonID)
                                        ->delete();
                                    }else{
                                        DB::table('order_item_addons')
                                        ->where('orderitem_id',$OrderitemID)->where('addonID',$addonID)
                                        ->update(['quantity' => $newquantity]);
                                    }
                                }


                            }else{
                                $orderAddon = new OrderItemAddon();
                                $orderAddon->orderitem_id = $OrderitemID;
                                $orderAddon->addonID= $addonID;
                                $orderAddon->addon_name= $addonname;
                                $orderAddon->addon_price= $addonprice;
                                $orderAddon->save();
                            }

        }
        if((float)$newprice == '0.00'){
            DB::table('orderitems')
            ->where('order_id',$storeID)->where('item_id',$item_id)
            ->delete();
        }
        $price = DB::table('orderitems')->where('order_id',$storeID)->get()->sum("price");
        $count = DB::table('orderitems')->where('order_id',$storeID)->groupBy('item_id')->get()->count();
        return response()->json([$price, $count]);
    }
    public function SingleCartGet($id)
    {
        $data = DB::table('order_item_addons')->where('orderitem_id',$id)->get();

        return response()->json([$data]);
    }
    public function SingleproductGet($id, $storeID)
    {
        $orderitemId = DB::table('orderitems')->where('order_id',$storeID)->where('item_id',$id)->value('id');
        $data = DB::table('order_item_addons')->where('orderitem_id',$orderitemId)->get();

        return response()->json([$data]);
    }
    public function SingleCartUpdates(Request $request)
    {
        $storeID= $request->storeID;
        $addonID= $request->addonID;
        $OrderitemID= $request->OrderitemID;
        $addonname= $request->addonname;
        $addonprice= $request->addonprice;
        $item_id= $request->customizationID;
        $customizationvalue= $request->customizationvalue;
        $states = $request->states;
        $currentStatus= $request->currentStatus;


        $Check_addon = DB::table('order_item_addons')->where('orderitem_id',$OrderitemID)->where('addonID',$addonID)->get();
        $quantityAddon = DB::table('order_item_addons')->where('orderitem_id',$OrderitemID)->where('addonID',$addonID)->value('quantity');
        if(count($Check_addon) > 0){
            if($states == "plus"){
                $newquantity = (int)$quantityAddon + 1;
                DB::table('order_item_addons')
                ->where('orderitem_id',$OrderitemID)->where('addonID',$addonID)
                ->update(['quantity' => $newquantity]);
            }else{
                $newquantity = (int)$quantityAddon - 1;
                if($newquantity == 0){
                    DB::table('order_item_addons')
                    ->where('orderitem_id',$OrderitemID)->where('addonID',$addonID)
                    ->delete();
                }else{
                    DB::table('order_item_addons')
                    ->where('orderitem_id',$OrderitemID)->where('addonID',$addonID)
                    ->update(['quantity' => $newquantity]);
                }
            }


        }else{
            $orderAddon = new OrderItemAddon();
            $orderAddon->orderitem_id = $OrderitemID;
            $orderAddon->addonID= $addonID;
            $orderAddon->addon_name= $addonname;
            $orderAddon->addon_price= $addonprice;
            $orderAddon->save();
        }





            $price = DB::table('orderitems')->where('order_id',$storeID)->where('item_id',$item_id)->value('price');
            $newquantity = $request->InsertValue;
            $newquantity = (int)$newquantity;
            if($currentStatus == '1'){
                $newprice = (float)$price + $customizationvalue + (float)$addonprice;
            }else{
                $newprice = (float)$price - $customizationvalue - (float)$addonprice;
            }

            DB::table('orderitems')
            ->where('order_id',$storeID)->where('item_id',$item_id)
            ->update(['quantity' => $newquantity,'price' => $newprice]);
            $count = DB::table('orderitems')->where('order_id',$storeID)->get();
           
            return response()->json([$newprice, $item_id, $addonID]);

    }
    public function RemoveCart(Request $request)
    {
        $storeID= $request->storeID;
        $item_id= $request->customizationID;

        $orderitemid = DB::table('orderitems')->where('order_id', $storeID)->where('item_id', $item_id)->value('id');
        $orderitem_ids = DB::table('order_item_addons')->where('orderitem_id', $orderitemid)->get();
        if(count($orderitem_ids) > 0){
            DB::table('order_item_addons')->where('orderitem_id', $orderitemid)->delete();
        }
        DB::table('orderitems')->where('order_id', $storeID)->where('item_id', $item_id)->delete();
        return $storeID;

    }
    public function checkoutAutocompleteAjax()
    {

        $addresses = DB::table('users')
        ->select( 'users.id', 'users.name' )
        ->leftjoin('addresses','addresses.user_id','=','users.id')
        ->get();
        return response()->json($addresses);

    }
    public function SaveDeliverAddress(Request $request)
    {
        $FullName= $request->FullName;
        $PhoneNumber= $request->PhoneNumber;
        $Email= $request->Email;
        $AddressType= $request->AddressType;
        $latitude= $request->latitude;
        $longitude= $request->longitude;
        $City= $request->City;
        $NewUser = User::create([
            'name' => $FullName,
            'email' => $Email,
            'password' => Hash::make($PhoneNumber),
            'phone' => $PhoneNumber,
        ]);
        $id = $NewUser->id;
        $Address = new Address;
        $Address->user_id = $id;
        $Address->house = $City;
        $Address->address = $City;
        $Address->tag = $AddressType;
        $Address->latitude = $latitude;
        $Address->longitude = $longitude;
        $Address->save();
        $addressID = $Address->id;
        return $addressID;

    }
    public function storefilter(Request $request)
    {
        $storeID= $request->storeID;
        $CheckedCategoryValue= $request->CheckedCategoryValue;
        $CheckedPriceValue= $request->CheckedPriceValue;
        $IsRecommended= $request->IsRecommended;
        $IsPopular= $request->IsPopular;
        $IsNew= $request->IsNew;
        $IsVeg= $request->IsVeg;
        $sql = "SELECT * FROM items WHERE restaurant_id = '$storeID'".(($CheckedPriceValue !== 'All') ? "AND price >= '$CheckedPriceValue'" : "").(($CheckedCategoryValue !== 'All') ? "AND item_category_id = '$CheckedCategoryValue'" : "").(($IsRecommended !== '0') ? "AND is_recommended = '$IsRecommended'" : "").(($IsPopular !== '0') ? "AND is_popular = '$IsPopular'" : "").(($IsVeg !== '0') ? "AND is_veg = '$IsVeg'" : "").(($IsNew !== '0') ? "AND is_new = '$IsNew'" : ""); 
        $Item = DB::select($sql);
        // $Item = Item::where('restaurant_id', $storeID)->where('item_category_id', $CheckedCategoryValue)->where('is_recommended', $IsRecommended)->where('is_popular', $IsPopular)->where('is_new', $IsNew)->where('is_veg', $IsVeg)->where('item_category_id', $CheckedPriceValue)->orderBy('id', 'DESC')->get();
        // $count = count($Item);
        return response()->json($Item);
    }
    public function checkout($storeID)
    {
        $cartorder = 0;
        $count = DB::table('orderitems')->where('order_id',$storeID)->groupBy('item_id')->get()->count();
        $items = DB::table('orderitems')->where('order_id',$storeID)->get();
        $itemsPrices = DB::table('orderitems')->select('price')->where('order_id',$storeID)->get();
        $priceValue = 0;
        foreach($itemsPrices as $key => $itemsPrice){

            $Price = $itemsPrice->price;
            $priceValue += (float)$Price;
        }
        $storename = DB::table('restaurants')->where('id',$storeID)->value('name');
        $restaurant_charges = DB::table('restaurants')->where('id',$storeID)->value('restaurant_charges');
        $delivery_charges = DB::table('restaurants')->where('id',$storeID)->value('delivery_charges');
        $totalPrice = $priceValue + (float)$restaurant_charges + (float)$delivery_charges;

        $itemids = DB::table('orderitems')->select('item_id')->where('order_id',$storeID)->get();
        foreach($itemids as $key => $itemid){
            $single_itemid[$key] = $itemid->item_id;
            $addonValues[$key] = DB::table('addons')
            ->select('addons.name','addons.price', 'addons.id')
            ->join('addon_category_item','addon_category_item.addon_category_id','=','addons.addon_category_id')
            ->where(['item_id' => $single_itemid[$key]])
            ->get();
            $addonValue_length[$key] = count($addonValues[$key]);
        }
        if(!isset($addonValues)){
            $addonValues = null;
            $addonValue_length = null;
        }



        //2 step
        $addresses = DB::table('users')
        ->select('users.name','users.email', 'users.id', 'users.phone', 'addresses.house', 'addresses.latitude', 'addresses.longitude')
        ->leftjoin('addresses','addresses.user_id','=','users.id')
        ->get();


        $orderaddon = DB::table('order_item_addons')->get();
        return view('restaurantowner.checkout',
        ['cartorder' => $cartorder,
        'storeID' => $storeID,
        'storename' => $storename,
        'count' => $count,
        'totalPrice' => $totalPrice,
        'priceValue' => $priceValue,
        'restaurant_charges' => $restaurant_charges,
        'delivery_charges' => $delivery_charges,
        'items' => $items,
        'addresses' => $addresses,
        'orderaddon' => $orderaddon,
        'addonValues' => $addonValues,
        'addonValue_length' => $addonValue_length,
        ]);
    }
    public function orderSubmit(Request $request)
    {
        // $nextlongitude= $request->nextlongitude;
        // $latitude= $request->latitude;
        // $final_total_price= $request->final_total_price;
        // var_dump($final_total_price);
        // var_dump($nextlongitude);
        // exit;
        // $nextlatitude= $request->nextlatitude;
        $restaurant_charges= $request->restaurant_charges;
        $delivery_charges= $request->delivery_charges;
        $final_total_price= $request->final_total_price;
        $DeliverAddress= $request->DeliverAddress;
        $DeliverUserAddress= $request->DeliverUserAddress;
        $delivery_type= $request->delivery_type;
        $RestaurantID= $request->RestaurantID;
        $paymentmode= $request->paymentmode;
        $date = date("Y-m-d");
        $date_year = substr($date, 2,2);
        $date_month = substr($date, 5,2);
        $date_day = substr($date, 8,2);
        $date = $date_day.$date_month.$date_year;
        if($delivery_type == '2'){
            $delivery_charges= 0;
        }
        if($DeliverAddress == ""){
            $addresses = DB::table('addresses')
            ->where('user_id', $DeliverUserAddress)
            ->first();
            $lat = $addresses->latitude;
            $lng = $addresses->longitude;
            $addr = $addresses->address;
            $house = $addresses->house;
            $tag = $addresses->tag;
        }
        if($DeliverUserAddress == ""){
            $addresses = DB::table('addresses')
            ->where('id', $DeliverAddress)
            ->get();
            $DeliverUserAddress = DB::table('addresses')
            ->where('id', $DeliverAddress)
            ->value('user_id');
            foreach($addresses as $address){
                $lat = $address->latitude;
                $lng = $address->longitude;
                $addr = $address->address;
                $house = $address->house;
                $tag = $address->tag;
            }
        }
        $generated_string = ""; 
        $domain = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890"; 
        $len = strlen($domain); 
        $n = 5;   
        for ($i = 0; $i < $n; $i++) 
        { 
            $index = rand(0, $len - 1); 
            $generated_string = $generated_string . $domain[$index]; 
        } 
        // $OrderID = "003-".$date."-00".$RestaurantID."-0".$DeliverUserAddress."-".$delivery_type."-".$paymentmode."-".$generated_string;
        $OrderID = "003-".$date."-00".$RestaurantID."-0".$DeliverUserAddress."-".$delivery_type."-".$paymentmode;

        $location = array();
        $location = '{"lat": '.$lat.',"lng": '.$lng.', "address": '.$addr.',"house": '.$house.',"tag": '.$tag.'}';

        $Order = new Order;
        $Order->unique_order_id = $OrderID;
        $Order->orderstatus_id = 1;
        $Order->user_id = $DeliverUserAddress;
        $Order->location = $location;
        $Order->address = $addr;
        $Order->restaurant_charge = $restaurant_charges;
        $Order->delivery_charge = $delivery_charges;
        $Order->total = $final_total_price;
        $Order->payment_mode = $paymentmode;
        $Order->restaurant_id = $RestaurantID;
        $Order->payable = $final_total_price;
        $Order->delivery_type = $delivery_type;
        $Order->save();
        
        return response()->json($OrderID);

        // return view('restaurantowner.orderstatus',
        // [
        //     'cartorder' => '0',
        //     'nextlatitude' => $nextlatitude,
        //     'nextlongitude' => $nextlongitude,
        //     'latitude' => $latitude,
        // ]
        // );
    }
    public function history()
    {
        $user = Auth::user();
        if($user){
            $restaurantIds = $user->restaurants->pluck('id')->toArray();
            
            $orders = Order::orderBy('id', 'DESC')
            ->whereIn('restaurant_id', $restaurantIds)
            ->with('accept_delivery.user', 'restaurant')->get();
            // ->paginate('20');
            // $count = $orders->total();
            // dd($orders);
            // return view('restaurantowner.orders', array(
                //     'orders' => $orders,
                //     'count' => $count,
                // ));
                
                // To get all json data
                $json = file_get_contents(storage_path('products-export.json'));
                $objs = json_decode($json,true);
                
                // Breadcrumb
                $breadcrumbs = [
                    ['link'=>"dashboard-analytics",'name'=>"Home"],['link'=>"dashboard-analytics",'name'=>"Data List"], ['name'=>"Thumb View"]
                ];
                
                return view('restaurantowner.history', [
                    'breadcrumbs' => $breadcrumbs,
                    'products' => $objs['products'],
                    'orders' => $orders,
                    ]);
        }else{
            return redirect()->route('get.login');
        }
    }
    public function datefilter($from_date,$to_date){
        $user = Auth::user();
        $restaurantIds = $user->restaurants->pluck('id')->toArray();
        $orders = Order::orderBy('id', 'DESC')
            ->whereIn('restaurant_id', $restaurantIds)
            ->where('orderstatus_id', 8)
            ->whereBetween('created_at', [$from_date, $to_date])
            ->get();
        if($orders){
            $update_orders = [];
            foreach($orders as $order){
                if($order->orderstatus_id == 1){
                    $order->status = "Order Placed";
                }else if($order->orderstatus_id == 2){
                    $order->status = "Order Accepted";
                }else if($order->orderstatus_id == 3){
                    $order->status = "Delivery Assigned";
                }else if($order->orderstatus_id == 4){
                    $order->status = "Picked Up";
                }else if($order->orderstatus_id == 5){
                    $order->status = "Completed";
                }else if($order->orderstatus_id == 6){
                    $order->status = "Canceled";
                }else if($order->orderstatus_id == 7){
                    $order->status = "Ready to Pickup";
                }else if($order->orderstatus_id == 8){
                    $order->status = "Order Finished";
                }
                $order->humanreadabletime = $order->created_at->diffForHumans();
                $order->humanreadablefinishtime = Carbon::parse($order->finished_at)->diffForHumans();
                array_push($update_orders, $order);
            }
            return $update_orders;
        }else{
            return redirect()->back()->with(['message' => 'No records found in this date filter']);
        }
    }

    /**
     * @param Request $request
     */
    public function postSearchOrders(Request $request)
    {
        $user = Auth::user();
        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $query = $request['query'];

        $orders = Order::whereIn('restaurant_id', $restaurantIds)
            ->where('unique_order_id', 'LIKE', '%' . $query . '%')
            ->with('accept_delivery.user', 'restaurant')
            ->paginate(20);

        $count = $orders->total();

        return view('restaurantowner.orders', array(
            'orders' => $orders,
            'count' => $count,
        ));
    }

    /**
     * @param $order_id
     */
    public function viewOrder($order_id)
    {
        $user = Auth::user();
        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $order = Order::whereIn('restaurant_id', $restaurantIds)
            ->where('unique_order_id', $order_id)
            ->with('orderitems.order_item_addons')
            ->first();

        if ($order) {
            return view('restaurantowner.viewOrder', array(
                'order' => $order,
            ));
        } else {
            return redirect()->route('restaurantowner.orders');
        }
    }
    public function getOrder($order_id)
    {
        $user = Auth::user();
        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $order = Order::whereIn('restaurant_id', $restaurantIds)
                ->where('unique_order_id', $order_id)
                ->with('orderitems.order_item_addons')
                ->first();
            // ->where('unique_order_id', $order_id)
            // ->with('orderitems.order_item_addons')
            // ->join('orderitems','orders.id','=','orderitems.order_id')
            // ->join('items','orderitems.item_id','=','items.id')
            // ->join('users','orders.user_id','=', 'users.id')
            // ->join('restaurants','orders.restaurant_id','=', 'restaurants.id')
            // ->join('addresses','users.default_address_id','=','addresses.id')
            // ->select('orders.*', 'orderitems.*', 'items.*','users.email','users.name as user_name','users.phone','restaurants.name as restu_name','addresses.address')
            // ->first();
        if ($order) {
            $order->order_placed = date_format($order->created_at,"d-m-Y H:i:s");
            $restaurant = Restaurant::select('name')
                            ->where("id", $order->restaurant_id)
                            ->first();
            $order->restaurant_name = $restaurant->name;
            return $order;
        } 
    }

    /**
     * @param $restaurant_id
     */
    public function earnings($restaurant_id = null)
    {
        if ($restaurant_id) {
            $user = Auth::user();
            $restaurant = $user->restaurants;
            $restaurantIds = $user->restaurants->pluck('id')->toArray();

            $restaurant = Restaurant::where('id', $restaurant_id)->first();
            // check if restaurant exists
            if ($restaurant) {
                //check if restaurant belongs to the auth user
                // $contains = Arr::has($restaurantIds, $restaurant->id);
                $contains = in_array($restaurant->id, $restaurantIds);
                if ($contains) {
                    //true
                    $allCompletedOrders = Order::where('restaurant_id', $restaurant->id)
                        ->where('orderstatus_id', '5')
                        ->get();

                    $totalEarning = 0;
                    settype($var, 'float');

                    foreach ($allCompletedOrders as $completedOrder) {
                        $totalEarning += $completedOrder->total - $completedOrder->delivery_charge;
                    }

                    // Build an array of the dates we want to show, oldest first
                    $dates = collect();
                    foreach (range(-30, 0) as $i) {
                        $date = Carbon::now()->addDays($i)->format('Y-m-d');
                        $dates->put($date, 0);
                    }

                    // Get the post counts
                    $posts = Order::where('restaurant_id', $restaurant->id)
                        ->where('orderstatus_id', '5')
                        ->where('created_at', '>=', $dates->keys()->first())
                        ->groupBy('date')
                        ->orderBy('date')
                        ->get([
                            DB::raw('DATE( created_at ) as date'),
                            DB::raw('SUM( total ) as "total"'),
                        ])
                        ->pluck('total', 'date');

                    // Merge the two collections; any results in `$posts` will overwrite the zero-value in `$dates`
                    $dates = $dates->merge($posts);

                    // dd($dates);
                    $monthlyDate = '[';
                    $monthlyEarning = '[';
                    foreach ($dates as $date => $value) {
                        $monthlyDate .= "'" . $date . "' ,";
                        $monthlyEarning .= "'" . $value . "' ,";
                    }

                    $monthlyDate = rtrim($monthlyDate, ' ,');
                    $monthlyDate = $monthlyDate . ']';

                    $monthlyEarning = rtrim($monthlyEarning, ' ,');
                    $monthlyEarning = $monthlyEarning . ']';
                    /*=====  End of Monthly Post Analytics  ======*/

                    $balance = RestaurantEarning::where('restaurant_id', $restaurant->id)
                        ->where('is_requested', 0)
                        ->first();

                    if (!$balance) {
                        $balanceBeforeCommission = 0;
                        $balanceAfterCommission = 0;
                    } else {
                        $balanceBeforeCommission = $balance->amount;
                        $balanceAfterCommission = ($balance->amount - ($restaurant->commission_rate / 100) * $balance->amount);
                        $balanceAfterCommission = number_format((float) $balanceAfterCommission, 2, '.', '');
                    }

                    $payoutRequests = RestaurantPayout::where('restaurant_id', $restaurant_id)->orderBy('id', 'DESC')->get();

                    return view('restaurantowner.earnings', array(
                        'restaurant' => $restaurant,
                        'totalEarning' => $totalEarning,
                        'monthlyDate' => $monthlyDate,
                        'monthlyEarning' => $monthlyEarning,
                        'balanceBeforeCommission' => $balanceBeforeCommission,
                        'balanceAfterCommission' => $balanceAfterCommission,
                        'payoutRequests' => $payoutRequests,
                    ));
                } else {
                    return redirect()->route('restaurant.earnings')->with(array('message' => 'Access Denied'));
                }
            } else {
                return redirect()->route('restaurant.earnings')->with(array('message' => 'Access Denied'));
            }
        } else {
            $user = Auth::user();
            $restaurants = $user->restaurants;

            return view('restaurantowner.earnings', array(
                'restaurants' => $restaurants,
            ));
        }
    }

    /**
     * @param Request $request
     */
    public function sendPayoutRequest(Request $request)
    {
        $restaurant = Restaurant::where('id', $request->restaurant_id)->first();
        $earning = RestaurantEarning::where('restaurant_id', $request->restaurant_id)
            ->where('is_requested', 0)
            ->first();

        $balanceBeforeCommission = $earning->amount;
        $balanceAfterCommission = ($earning->amount - ($restaurant->commission_rate / 100) * $earning->amount);
        $balanceAfterCommission = number_format((float) $balanceAfterCommission, 2, '.', '');

        if ($earning) {
            $payoutRequest = new RestaurantPayout;
            $payoutRequest->restaurant_id = $request->restaurant_id;
            $payoutRequest->restaurant_earning_id = $earning->id;
            $payoutRequest->amount = $balanceAfterCommission;
            $payoutRequest->status = 'PENDING';
            try {
                $payoutRequest->save();
                $earning->is_requested = 1;
                $earning->restaurant_payout_id = $payoutRequest->id;
                $earning->save();
            } catch (\Illuminate\Database\QueryException $qe) {
                return redirect()->back()->with(array('message' => 'Something went wrong. Please check your form and try again.'));
            } catch (Exception $e) {
                return redirect()->back()->with(array('message' => $e->getMessage()));
            } catch (\Throwable $th) {
                return redirect()->back()->with(array('message' => $th));
            }

            return redirect()->back()->with(array('success' => 'Payout Request Sent'));
        } else {
            return redirect()->route('restaurant.earnings')->with(array('message' => 'Access Denied'));
        }
    }

    /**
     * @param $id
     */
    public function cancelOrder($id)
    {
        $user = Auth::user();
        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $order = Order::where('id', $id)->whereIn('restaurant_id', $restaurantIds)->first();

        if ($order) {
            if ($order->orderstatus_id == '1') {
                //change order status to 6 (Canceled)
                $order->orderstatus_id = 6;
                $order->save();
                //refund money if paid online
                if (!$order->payment_mode == 'COD') {
                    //paid online or paid fully with wallet (Give full refund)
                    $customer = User::where('id', $order->user_id)->first();
                    if ($customer) {
                        $customer->deposit($order->total * 100, ['description' => config('settings.orderRefundWalletComment') . $order->unique_order_id]);
                    }
                }

                if ($order->payment_mode == 'COD' || $order->payment_mode == 'STRIPE' || $order->payment_mode == 'PAYPAL' || $order->payment_mode == 'PAYSTACK' || $order->payment_mode == 'RAZORPAY') {
                    //if payment is COD, check total and payable.. if there is change, pay the difference
                    $customer = User::where('id', $order->user_id)->first();
                    if ($customer) {
                        if ($order->total - $order->payable != 0) {
                            //that means the customer has used wallet to pay partially..
                            //initiate partial refund
                            $customer->deposit(($order->total - $order->payable) * 100, ['description' => config('settings.orderRefundWalletComment') . $order->unique_order_id]);
                        }
                    }
                }

                if ($order->payment_mode == 'WALLET') {
                    $customer = User::where('id', $order->user_id)->first();
                    if ($customer) {
                        $customer->deposit($order->total * 100, ['description' => config('settings.orderRefundWalletComment') . $order->unique_order_id]);
                    }
                }

                //show notification to user
                if (config('settings.enablePushNotificationOrders') == 'true') {
                    //to user
                    $notify = new PushNotify();
                    $notify->sendPushNotification('6', $order->user_id, $order->unique_order_id);
                }

                if (\Illuminate\Support\Facades\Request::ajax()) {
                    return response()->json(['success' => true]);
                } else {
                    return redirect()->back()->with(array('success' => 'Order Canceled'));
                }
            }
        } else {
            if (\Illuminate\Support\Facades\Request::ajax()) {
                return response()->json(['success' => false], 406);
            } else {
                return redirect()->back()->with(array('message' => 'Something went wrong.'));
            }
        }
    }

    /**
     * @param Request $request
     */
    public function updateRestaurantScheduleData(Request $request)
    {
        $data = $request->except(['_token', 'restaurant_id']);

        $i = 0;
        $str = '{';
        foreach ($data as $day => $times) {
            $str .= '"' . $day . '":[';
            if ($times) {
                foreach ($times as $key => $time) {

                    if ($key % 2 == 0) {
                        $t1 = $time;
                        $str .= '{"open" :' . '"' . $time . '"';

                    } else {
                        $t2 = $time;
                        $str .= '"close" :' . '"' . $time . '"}';
                    }

                    //check if last, if last then dont add comma,
                    if (count($times) != $key + 1) {
                        $str .= ',';
                    }
                }
                // dd($t1);
                if (Carbon::parse($t1) >= Carbon::parse($t2)) {

                    return redirect()->back()->with(['message' => 'Opening and Closing time is incorrect']);
                }
            } else {
                $str .= '}]';
            }

            if ($i != count($data) - 1) {
                $str .= '],';
            } else {
                $str .= ']';
            }
            $i++;
        }
        $str .= '}';

        // Fetches The Restaurant
        $restaurant = Restaurant::where('id', $request->restaurant_id)->first();
        // Enters The Data
        $restaurant->schedule_data = $str;
        // Saves the Data to Database
        $restaurant->save();

        return redirect()->back()->with(['success' => 'Scheduling data saved successfully']);

    }
}
