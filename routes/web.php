<?php
Route::impersonate();

/* Setting the locale route */
Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
});
// Route::get('/', 'PageController@indexPage')->name('get.index');

// Route::get('/schedule/run/{password}', 'SchedulerController@run');

/* Auth Routes */
Route::get('/login', 'PageController@loginPage')->name('get.login');
Route::post('/login', 'Auth\LoginController@login')->name('post.login');
Route::get('auth/logout', 'Auth\LoginController@logout')->name('logout');


/* END Auth Routes */

/* Restaurant Order Routes */
Route::post('/storeValue', 'RestaurantOwnerController@storeValue')->name('storeValue');
Route::post('/SingleCartUpdates', 'RestaurantOwnerController@SingleCartUpdates')->name('SingleCartUpdates');
Route::get('/SingleCartGet/{id}', 'RestaurantOwnerController@SingleCartGet')->name('SingleCartGet');
Route::get('/SingleproductGet/{id}/{storeID}', 'RestaurantOwnerController@SingleproductGet')->name('SingleproductGet');
Route::post('/RemoveCart', 'RestaurantOwnerController@RemoveCart')->name('RemoveCart');
Route::post('/SaveDeliverAddress', 'RestaurantOwnerController@SaveDeliverAddress')->name('SaveDeliverAddress');
Route::post('/orderSubmit', 'RestaurantOwnerController@orderSubmit')->name('orderSubmit');
Route::post('/storefilter', 'RestaurantOwnerController@storefilter')->name('storefilter');
Route::get('/checkout/{id}', 'RestaurantOwnerController@checkout')->name('restaurant.checkout');
Route::get('/checkoutAutocompleteAjax', 'RestaurantOwnerController@checkoutAutocompleteAjax')->name('restaurant.checkoutAutocompleteAjax');
Route::get('/item_image/{id}', 'RestaurantOwnerController@item_image')->name('item_image');
Route::get('/item_image/{id}', 'RestaurantOwnerController@item_image')->name('restaurant.item_image');
 
Route::get('/', 'RestaurantOwnerController@orders')->name('restaurant.orders');
Route::get('/orders85', 'RestaurantOwnerController@orders85')->name('restaurant.orders85');
Route::get('/datefilter/{from_date}/{to_date}', 'RestaurantOwnerController@datefilter')->name('restaurant.datefilter');
Route::get('/history', 'RestaurantOwnerController@history')->name('restaurant.history');
Route::get('/viewshop/{id}', 'RestaurantOwnerController@viewshop')->name('restaurant.viewshop');

Route::get('finish-order/{order_id}', 'RestaurantOwnerController@finishOrder')->name('restaurant.finishOrder');
Route::get('/order/{order_id}', 'RestaurantOwnerController@viewOrder')->name('restaurant.viewOrder');
Route::get('/getorder/{order_id}', 'RestaurantOwnerController@getOrder')->name('restaurant.getOrder');
/* END Restaurant Owner Routes */


/* EXTRAS */
// Route::get('/init', 'InitController@init')->name('init');
