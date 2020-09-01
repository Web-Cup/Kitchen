@extends('layouts/masterLayout')


@section('title', 'Checkout')

@section('vendor-style')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/vendors/css/extensions/toastr.css')}}">
    <!-- END: Vendor CSS-->
@endsection
@section('page-style')
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/core/menu/menu-types/horizontal-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/pages/app-ecommerce-shop.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/plugins/forms/wizard.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/plugins/extensions/toastr.css')}}">
    <!-- END: Page CSS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link href="{{ asset('public/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<style>
    input.layout-name {
        width: 35%!important;
    }
    p.stock-status-in {
    color: #626262;
    }
    .disabledbutton {
    pointer-events: none;
    opacity: 0.4;
    }
    #map {
    height: 100%;
    }
    html,
    body {
    height: 100%;
    margin: 0;
    padding: 0;
    }
    #commentandsuggestion:focus{
        outline-offset: 0px !important;
        outline: none !important;
        border: 1px solid green !important;
        box-shadow: 0 0 3px green !important;
        -moz-box-shadow: 0 0 3px green !important;
        -webkit-box-shadow: 0 0 3px green !important;
    }
    #commentandsuggestion{
        width: 100%;
        border: none;
        border-color: #cdd4db;
    }
    #selUser::after{
        content: '\f502';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
    }
    .delivery_type{
        margin: 0 auto; width:115px; text-align:left;
    }
</style>
 <!-- BEGIN: Content-->
<meta name="csrf-token" content="{!! csrf_token() !!}">
<?php 
use App\Http\Controllers\RestaurantOwnerController;
?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="crossorigin="anonymous"></script>

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Checkouts</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('restaurant.orders')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{asset('/viewshop/'.$storeID)}}">{{$storename}}</a>
                                    </li>
                                    <li class="breadcrumb-item active">Checkout
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <form id="OrderForm" class="icons-tab-steps checkout-tab-steps wizard-circle">
                    @csrf
                    <h6><i class="step-icon step feather icon-shopping-cart"></i>Cart</h6>
                    <fieldset class="checkout-step-1 px-0">
                        <section id="place-order" class="list-view product-checkout">
                            <div class="checkout-items">
                            @foreach ($items as $key => $SubItem)


                                <div class="card ecommerce-card">
                                    <div class="card-content">
                                        <?php 
                                            $imglink = $SubItem->image;
                                            $url = "https://resto.solutionweb.io".$imglink;
                                            ?>
                                        <a href="app-ecommerce-details">
                                        <div class="item-img text-center" style="padding-bottom: 8px; padding-top: 8px;">
                                            <img src="{{$url}}" alt="img-placeholder" style="width: 100%;height: 200px;">
                                        </div>
                                        </a>
                                        <div class="card-body">
                                            <div class="item-name" style="font-size: 1.35rem;margin-bottom: 2.25rem;">
                                                <a href="#">{{ $SubItem->name }}</a>
                                                <span></span>
                                               
                                            @foreach ( $orderaddon as $Suborderaddon)
                                                        <?php 
                                                            $suborderitemID = $Suborderaddon->orderitem_id;
                                                            $originalorderitemID = $SubItem->id
                                                        ?>
                                                    @if($suborderitemID == $originalorderitemID)
                                                        <p class="stock-status-in">
                                                            {{$Suborderaddon->quantity}} x {{$Suborderaddon->addon_name}}
                                                        </p>

                                                    @endif
                                            @endforeach
                                            <input type="hidden" name="addonName" class="addonValue{{$SubItem->item_id}}" value="{{$addonValues[$key]}}">

                                            </div>
                                            <div class="item-quantity">
                                                <p class="quantity-title" style="font-size: 1.3rem;">Quantity</p>
                                                <div class="input-group quantity-counter-wrapper">
                                                    <input type="hidden" class="item-ID" value="{{ $SubItem->item_id }}">
                                                    <input type="hidden" class="orderitemID" value="{{ $SubItem->id }}">
                                                    <input type="text" class="quantity-counter" value="{{ $SubItem->quantity }}">
                                                    <input type="hidden" class="single-item-name{{ $SubItem->item_id }}" value="{{ $SubItem->name }}">
                                                    <input type="hidden" class="single-item-quantity{{ $SubItem->item_id }}" value="{{ $SubItem->quantity }}">
                                                    <input type="hidden" class="single-item-price{{ $SubItem->item_id }}" value="{{ $SubItem->original_price }}">
                                                    <input type="hidden" class="orderID{{ $SubItem->item_id }}" value="{{ $SubItem->order_id }}">
                                                    <input type="hidden" name="" id="image{{ $SubItem->item_id }}" value="{{ $SubItem->image }}">
                                                    <input type="hidden" class="current-status" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-options text-center">
                                            <div class="item-wrapper">
                                                
                                                <div class="item-cost">
                                                    <h6 class="item-price item-price{{ $SubItem->item_id }}" style="font-size: 45px;">
                                                        {{ (int)($SubItem->price) }}<i class="fas fa-euro-sign"></i>
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="wishlist remove-wishlist">
                                                <i class="feather icon-x align-middle"></i> <a href="#" onclick="RemoveCart('{{ $SubItem->item_id }}')"> Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                            @endforeach
                            <input type="hidden" class="final_total_price" id="final_total_price" name="final_total_price" value="{{$totalPrice}}">
                            <input type="hidden" name="delivery_charges" id="delivery_charges" value="{{$delivery_charges}}">
                            <input type="hidden" name="restaurant_charges" id="restaurant_charges" value="{{$restaurant_charges}}">
                            <input type="hidden" id="DeliverAddress" value="">
                            <input type="hidden" id="DeliverUserAddress" value="">
                            </div>
                            <div class="checkout-options">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="options-title">
                                                       <input type="text" name="" placeholder="Write your comment/cuggestion for the restaurant..." style="width: 100%; " id="commentandsuggestion">
                                            </div>  
                                            <div class="coupons">
                                                <div class="coupons-title">
                                                    <p>Coupons</p>
                                                </div>
                                                <div class="apply-coupon">
                                                    <p>Apply</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="price-details">
                                                <p>Price Details</p>
                                            </div>
                                            <?php 
                                            $currency = '<i class="fas fa-euro-sign"></i>';
                                            $restaurant_charges_currency = "<i class='fas fa-euro-sign'></i>";
                                            $delivery_charges_currency = '<i class="fas fa-euro-sign"></i>';
                                                if((float)$restaurant_charges == '0'){
                                                    
                                                    $restaurant_charges_currency = '';
                                                }
                                                if((float)$delivery_charges == ''){
                                                 
                                                    $delivery_charges_currency = '';
                                                }
                                            ?>
                                            <div class="detail">
                                                <div class="detail-title">
                                                    Item Total
                                                </div>
                                                <div class="detail-amt discount-amt">
                                                 {{$priceValue}}<i class="fas fa-euro-sign"></i>
                                                </div>
                                            </div>
                                            
                                            <div class="detail">
                                                <div class="detail-title">
                                                    Restaurant Charges
                                                </div>
                                                <div class="detail-amt discount-amt">
                                                <!--  -->
                                                
                                                 {{$restaurant_charges}}  
                                                 @if((float)$restaurant_charges > 0)
                                                       <i class="fas fa-euro-sign"></i>
                                                 @else
                                                 free
                                                 @endif
                                                </div>
                                            </div>
                                            
                                            <div class="detail delivery_charges">
                                                <div class="detail-title">
                                                     Delivery Charges
                                                </div>
                                                <div class="detail-amt discount-amt">
                                                    <span>
                                                        {{$delivery_charges}}
                                                    </span> 
                                                 @if((float)$delivery_charges > 0)
                                                       <i class="fas fa-euro-sign"></i>
                                                 @else
                                                 free
                                                 @endif
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="detail">
                                                <div class="detail-title detail-total">Total</div>
                                                <div class="detail-amt total-amt"> 
                                                    <span class="DeliveryTotalPrice">
                                                    {{$totalPrice}}
                                                    </span> 
                                                    <i class="fas fa-euro-sign"></i></div>
                                            </div>
                                            
                                            <div class="row" style="margin-bottom: 10px;">
                                               <div class="col-md-6">
                                                <span class="vs-radio-con vs-radio-primary py-25 delivery_type">
                                                        <input type="radio" class="delivery_type1" checked name="delivery_type" value="1" >
                                                        <span class="vs-radio">
                                                            <span class="vs-radio--border"></span>
                                                            <span class="vs-radio--circle"></span>
                                                        </span>
                                                        <span class="ml-50">Delivery</span>
                                                    </span>  
                                               </div>
                                               <div class="col-md-6">
                                                <span class="vs-radio-con vs-radio-primary py-25 delivery_type">
                                                        <input type="radio" class="delivery_type2" name="delivery_type" value="2" >
                                                        <span class="vs-radio">
                                                            <span class="vs-radio--border"></span>
                                                            <span class="vs-radio--circle"></span>
                                                        </span>
                                                        <span class="ml-50">Self Pickup</span>
                                                    </span>
                                               </div>
                                            </div>
                                            <div class="btn btn-primary btn-block PlaceOrderDisabled place-order">PLACE ORDER</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </fieldset>
                  
                    <div class="modal fade text-left" id="bootstrap-touchspin-up" tabindex="-1" role="dialog" aria-labelledby="myModalLabel21" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel21"> Customizations </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <b id="customizationname">
                                        </b> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row addonmodal">
                                            </div> 
                                        </div>
                                        <input type="hidden" id="customizationID" value="">
                                        <input type="hidden" id="storeID" value="{{ $storeID }}">
                                        <input type="hidden" id="customizationimage" value="">
                                        <input type="hidden" id="modalID" value="">
                                        <input type="hidden" id="customizationname" value="">
                                        <input type="hidden" id="ModalOrderitemID" value="">
                                        <input type="hidden" id="customizationvalue" value="">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="acceptcartCheckout" class="acceptcartCheckout btn btn-outline-primary"  data-dismiss="modal">Accept</button>
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- Modal -->
                        <div class="modal fade text-left" id="Ordersuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel110" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary  white">
                                        <h5 class="modal-title" id="myModalLabel110">Order</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row" style="margin: 30px;">
                                            <div class="col-md-12" style="text-align: center;">
                                                <h1>
                                                    Order Placed Successfully
                                                </h1>
                                                <h2>
                                                    <b id="result_orderId" style="color: rgb(255, 159, 67);">
                                                     
                                                    </b>
                                                </h2>
                                                <h4>
                                                    Waiting to the restaurant to confirm your order
                                                </h4>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <h6><i class="step-icon step feather icon-home"></i>Address</h6>
                    <fieldset class="checkout-step-2 px-0">
                        <section id="checkout-address" class="list-view product-checkout">
                            <div class="card">
                                <div class="card-header flex-column align-items-start">
                                    <h4 class="card-title">Add New Address</h4>
                                    <p class="text-muted mt-25">Be sure to check "Deliver to this address" when you have finished</p>
                                </div>
                                <div class="card-content">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="checkout-name">Full Name:</label>
                                                        <input type="text" id="checkout-name" class="form-control " name="fname">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="checkout-number">Mobile Number:</label>
                                                        <input type="number" id="checkout-number" class="form-control " name="mnumber">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="checkout-apt-number">Email:</label>
                                                        <input type="email" id="checkout-apt-number" class="form-control " name="apt-number">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="add-type">Address Type:</label>
                                                        <select class="form-control" id="add-type">
                                                            <option value="Home">Home</option>
                                                            <option value="Work">Work</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="checkout-city">Address:</label>
                                                        <input type="text" name="city" id="checkout-city" class="form-control" placeholder="Select Location">
                                                        <div class="form-group d-none" id="lat_area">
                                                            <label for="latitude"> Latitude </label>
                                                            <input type="text" name="latitude" id="latitude" class="form-control">
                                                            <input type="hidden" name="nextlatitude" id="nextlatitude" class="form-control">
                                                        </div>
                                
                                                        <div class="form-group d-none" id="long_area">
                                                            <label for="latitude"> Longitude </label>
                                                            <input type="text" name="longitude" id="longitude" class="form-control">
                                                            <input type="hidden" name="nextlongitude" id="nextlongitude" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 offset-md-6">
                                                    <div class="btn btn-primary disabledbutton SaveAndDelivery delivery-address float-right" onclick="RemoveClass()">
                                                        SAVE AND DELIVER HERE
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="customer-card">
                                <div class="card">
                                    <div>
                                            <!-- Dropdown -->       
                                            <select id='selUser' name="address" style='width: 100%;'>
                                                 <option value='0'> Please select</option>          
                                                @foreach ( $addresses as $address)
                                                        <option value="{{ $address->id }}" >{{ $address->phone }}</option>  
                                        
                                                @endforeach                                            
                                            </select>   
                                                @foreach ( $addresses as $address)
                                                <input type="hidden" name="" id="address{{ $address->id }}_name" value="{{ $address->name }}">
                                                <input type="hidden" name="" id="address{{ $address->id }}_email" value="{{ $address->email }}">
                                                <input type="hidden" name="" id="address{{ $address->id }}_house" value="{{ $address->house }}">
                                                <input type="hidden" name="" id="address{{ $address->id }}_phone" value="{{ $address->phone }}">
                                                <input type="hidden" name="" id="address{{ $address->id }}_longitude" value="{{ $address->longitude }}">
                                                <input type="hidden" name="" id="address{{ $address->id }}_latitude" value="{{ $address->latitude }}">
                                                @endforeach

                                            <br/>
                                    </div>
                                    <div class="card-header">
                                        <h4 class="card-title" id="AdevileryName"></h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body actions">
                                            <p class="mb-0" id="AdevileryEmail"></p>
                                            <p id="AdevileryHouse"></p>
                                            <p id="AdevileryPhone"></p>
                                            <hr>
                                            <div class="btn btn-primary btn-block deliveryAddress delivery-address" onclick="AddClass()">DELIVER TO THIS ADDRESS</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </fieldset>
                    <h6><i class="step-icon step feather icon-credit-card"></i>Payment</h6>
                    <fieldset class="checkout-step-3 px-0">
                        <section id="checkout-payment" class="list-view product-checkout">
                                <div class="payment-type">
                                    <div class="card">
                                        <div class="card-header flex-column align-items-start">
                                            <h4 class="card-title">Payment options</h4>
                                            <p class="text-muted mt-25">Be sure to click on correct payment option</p>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <ul class="other-payment-options list-unstyled">
                                                    <li>
                                                        <div class="vs-radio-con vs-radio-primary py-25">
                                                            <input type="radio" class="paymentmode" name="paymentmode"  checked="" value="COD">
                                                            <span class="vs-radio">
                                                                <span class="vs-radio--border"></span>
                                                                <span class="vs-radio--circle"></span>
                                                            </span>
                                                            <span>
                                                                Cash On Delivery
                                                            </span>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <hr>
                                                <div class="gift-card">
                                                <div class="float-right" style="margin-bottom:1rem" onclick="Ordering()">
                                                       <span class="btn btn-primary">CONTINUE</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="amount-payable checkout-options">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Price Details</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="detail">
                                                    <div class="details-title">
                                                    items Price
                                                    </div>
                                                    <div class="detail-amt">
                                                        <strong>{{$priceValue}} <i class="fas fa-euro-sign"></i></strong>
                                                    </div>
                                                </div>
                                                <div class="detail">
                                                    <div class="detail-title">
                                                        Restaurant Charges
                                                    </div>
                                                    <div class="detail-amt discount-amt">
                                                    <!--  -->
                                                    
                                                    {{$restaurant_charges}}  
                                                    @if((float)$restaurant_charges > 0)
                                                        <i class="fas fa-euro-sign"></i>
                                                    @else
                                                    free
                                                    @endif
                                                    </div>
                                                </div>
                                                <div class="detail delivery_charges">
                                                    <div class="details-title">
                                                        Delivery Charges
                                                    </div>
                                                    <div class="detail-amt discount-amt">
                                                    {{$delivery_charges}}
                                                    @if((float)$delivery_charges > 0)
                                                       <i class="fas fa-euro-sign"></i>
                                                    @else
                                                    free
                                                    @endif
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="detail">
                                                    <div class="details-title">
                                                        Amount Payable
                                                    </div>
                                                    <div class="detail-amt total-amt"><strong>
                                                        <span class="DeliveryTotalPrice">
                                                            {{$totalPrice}}
                                                        </span> 
                                                        <i class="fas fa-euro-sign"></i></strong></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                    </fieldset>
                </form>
                

            </div>
        </div>
    </div>
    <!-- <div id="map" style="width: 100%; height:400px;"></div> -->

@endsection

@section('vendor-script')
        <!-- Vendor js files -->
         <script src="{{ asset('public/app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
        <script src="{{ asset('public/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js') }}"></script>
        <script src="{{ asset('public/vendors/js/extensions/jquery.steps.min.js') }}"></script>
        <script src="{{ asset('public/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('public/vendors/js/extensions/toastr.min.js') }}"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
@endsection

@section('page-script')                
        <!-- Select2 library -->
            <script src="{{ asset('public/select2/dist/js/select2.min.js')}}" type="text/javascript"></script>
        <!-- Page js files -->
        <script src="{{ asset('public/js/scripts/pages/app-ecommerce-shop.js') }}"></script>
        <!-- BEGIN: Page JS-->
            <script src="{{ asset('public/app-assets/js/scripts/pages/app-ecommerce-shop.js') }}"></script>
        <!-- END: Page JS-->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <script src="https://maps.google.com/maps/api/js?key=AIzaSyBRbDjAmZEqpIUg9LJclblxdrFwGD7dNcw&amp;libraries=places" type="text/javascript"></script>
        <script>
            "use strict";
            let map;
            function initialize() {
                var latitude = $('#nextlatitude').val();
                var longitude = $('#nextlongitude').val();

                var input = document.getElementById('checkout-city');
                var autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.addListener('place_changed', function() {
                    var place = autocomplete.getPlace();
                    $('#latitude').val(place.geometry['location'].lat());
                    $('#longitude').val(place.geometry['location'].lng());
                });

            }
            google.maps.event.addDomListener(window, 'load', initialize);

        </script>
        <script>
          function AddClass(){
              $("#selUser").addClass("form-control required")
              $("#checkout-name, #checkout-number, #checkout-apt-number, #checkout-city").removeClass("required")
              
          }

        $(document).ready(function(){
            $('.delivery_type1, .delivery_type2').change(function(){
                var delivery_cahrge = '{{$delivery_charges}}';
                var totalPrice = '{{$totalPrice}}';
                var delivery_type = $("input[name='delivery_type']:checked").val();
                if(delivery_type == '2'){
                    $(".delivery_charges").attr("style", "display:none;")
                    var SelfPrice = parseFloat(totalPrice) - parseFloat(delivery_cahrge)
                    $(".final_total_price").val(SelfPrice);
                    $('.DeliveryTotalPrice').text(SelfPrice)
                }else{
                    $(".delivery_charges").attr("style", "display:flex;")
                    $(".final_total_price").val(totalPrice);
                    $('.DeliveryTotalPrice').text(totalPrice)                    
                }

            });
                $("#checkout-name, #checkout-number, #checkout-apt-number, #checkout-city").on("input", function() { canChangeColor(); });
                function canChangeColor() {
                    var can = true;
                    $("#checkout-name, #checkout-number, #checkout-apt-number, #checkout-city").each(function() { if ($(this).val() == '') { can = false; } });
                    if (can) {
                        var validatorEmail = $('#checkout-apt-number').valid();
                        if( validatorEmail == true){
                            $(".SaveAndDelivery").removeClass("disabledbutton")
                        } else {
                            $(".SaveAndDelivery").addClass("disabledbutton")
                        }
                    } else {
                        $(".SaveAndDelivery").addClass("disabledbutton")
                    }
                }

                var ItemTotal = '{{$priceValue}}';
                if(ItemTotal == '0'){
                    $(".PlaceOrderDisabled").addClass("disabledbutton")
                }else{
                    $(".PlaceOrderDisabled").removeClass("disabledbutton")
                }
                // Initialize select2
                $("#selUser").select2({

                    minimumInputLength: 5,
                    placeholder: {
                        id: '0', // the value of the option
                        text: $.parseHTML('<i class="fas fa-phone-alt"></i>| None Selected')
                    },
                    allowClear: true,

                });
                var userid = $('#selUser').val();
                if(userid == '0'){
                        $(".deliveryAddress").addClass("disabledbutton");
                    }else{
                        $(".deliveryAddress").removeClass("disabledbutton");
                    }
                // Read selected option
                $('#selUser').change(function(){
                    var username = $('#selUser option:selected').text();
                    var userid = $('#selUser').val();
                    $('#DeliverUserAddress').val(userid);
                    console.log(userid)
                    $('#DeliverAddress').val("");

                    if(userid == '0'){
                        $('#AdevileryName').html("");
                        $(".deliveryAddress").addClass("disabledbutton");
                        $('#AdevileryName').html("");
                        $('#AdevileryEmail').html("");
                        $('#AdevileryHouse').html("");
                        $('#AdevileryPhone').html("");
                    }else{
                        $(".deliveryAddress").removeClass("disabledbutton");
                    }
                    var AdevileryName = $('#address'+userid+'_name').val();
                    var AdevileryEmail = $('#address'+userid+'_email').val();
                    var AdevileryHouse = $('#address'+userid+'_house').val();
                    var AdevileryPhone = $('#address'+userid+'_phone').val();
                    var longitude = $('#address'+userid+'_longitude').val();
                    var latitude = $('#address'+userid+'_latitude').val();
            
                    $('#nextlatitude').val(latitude);
                    $('#nextlongitude').val(longitude);
                    $('#AdevileryName').html(AdevileryName);
                    $('.card-holder-name').html(AdevileryName);
                    $('#AdevileryEmail').html(AdevileryEmail);
                    $('#AdevileryHouse').html(AdevileryHouse);
                    $('#AdevileryPhone').html(AdevileryPhone);
                });
                window.RemoveCart = function($itemID) {
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    });
                    var storeID = $("#storeID").val();
                    var customizationID = $itemID;
                    $.ajax({
                        method: "POST",
                        url: "/RemoveCart",
                        data: {
                            "storeID": storeID,
                            "customizationID": customizationID,
                        }
                    }).done(function(msg) {
                        location.reload(true);
                        console.log(msg)
                    });
                }
                window.Ordering = function() {
                        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        });
                        var final_total_price = $("#final_total_price").val();
                        var delivery_charges = $("#delivery_charges").val();
                        var restaurant_charges = $("#restaurant_charges").val();
                        var DeliverAddress = $("#DeliverAddress").val();
                        var delivery_type = $("input[name='delivery_type']:checked").val();
                        var paymentmode = $("input[name='paymentmode']:checked").val();
                        var DeliverUserAddress = $("#DeliverUserAddress").val();
                        $.ajax({
                            method: "POST",
                            url: "/orderSubmit",
                            data: {
                                "final_total_price": final_total_price,
                                "delivery_charges": delivery_charges,
                                "restaurant_charges": restaurant_charges,
                                "DeliverAddress": DeliverAddress,
                                "DeliverUserAddress": DeliverUserAddress,
                                "delivery_type": delivery_type,
                                "RestaurantID": '{{$storeID}}',
                                "paymentmode": paymentmode,
                            }
                        }).done(function(msg) {
                            console.log(msg)
                            $('#result_orderId').text(msg)
                            $('#Ordersuccess').modal('show');
                        });                     
                }
                    window.RemoveClass = function() {
                        $("#selUser").removeClass("form-control required")
                        $("#checkout-name, #checkout-number, #checkout-apt-number, #checkout-city").addClass("required")

                        //save
                        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        });
                        var FullName = $("#checkout-name").val();
                        var PhoneNumber = $("#checkout-number").val();
                        var Email = $("#checkout-apt-number").val();
                        var AddressType = $("#add-type").val();
                        var latitude = $("#latitude").val();
                        var longitude = $("#longitude").val();
                        var City = $("#checkout-city").val();
                        $('#nextlatitude').val(latitude);
                        $('#nextlongitude').val(longitude);
                        $.ajax({
                            method: "POST",
                            url: "/SaveDeliverAddress",
                            data: {
                                "FullName": FullName,
                                "PhoneNumber": PhoneNumber,
                                "Email": Email,
                                "AddressType": AddressType,
                                "latitude": latitude,
                                "longitude": longitude,
                                "City": City,
                            }
                        }).done(function(msg) {
                            console.log(msg)
                            $('#DeliverUserAddress').val("");
                            $('#DeliverAddress').val(msg);
                        });

                    }
                $(".bootstrap-touchspin-up").click(function(){
                    $('.addonfield').remove();
                    $('#modalID').val('');
                    var itemID = $(this).parent(".bootstrap-touchspin-injected").siblings(".item-ID").val();
                    var orderitemID = $(this).parent(".bootstrap-touchspin-injected").siblings(".orderitemID").val();
                    var addonValue = $('.addonValue'+itemID).val();
                    var addonvaluearray = JSON.parse(addonValue);
                    var addonvaluelength = addonvaluearray.length;
                    for(var i =0; i<addonvaluelength; i++)
                    {
                        var addonID = addonvaluearray[i]['id'];
                    console.log(addonID)
                        $(".addonmodal").append('<div class="row col-md-12 addonfield" ><div id="addonnamemodalname'+addonID+'" class="col-md-6 addonnamemodalradio'+addonID+'" >'+addonvaluearray[i]["name"]+'</div><div class="col-md-4"><span id="addonnamemodalprice'+addonID+'">'+addonvaluearray[i]["price"]+'</span><i class="fas fa-euro-sign"></i></div><div class="vs-radio-con vs-radio-primary col-md-2"><input type="radio" name="vueradisize" class="addonnamemodalradio addonnamemodalradio'+addonID+'" value="'+addonID+'"><span class="vs-radio vs-radio-lg"><span class="vs-radio--border"></span><span class="vs-radio--circle"></span></span></div></div>');
                    }
                    $("input[type='radio']").click(function(){
                        var modalradio = $(this).val();
                        $('#modalID').val(modalradio);
                    });
                    var name = $('.single-item-name'+itemID).val();
                    var quantity = $('.single-item-quantity'+itemID).val();
                    var price = $('.single-item-price'+itemID).val();
                    var image = $('#image'+itemID).val();
                    $('#customizationID').val(itemID);
                    $('#customizationname').text(name);
                    $('#customizationvalue').val(price);
                    $('#ModalOrderitemID').val(orderitemID);
                    $('#customizationimage').text(image);
                    var currentStatus = $('.current-status').val("1");
                    console.log($('.current-status').val())
                    var quentityCounter = $('.quantity-counter').val();
                    if(quentityCounter == 10){

                    }else{
                        $('#bootstrap-touchspin-up').modal('show');
                    }
                }); 
                $(".bootstrap-touchspin-down").click(function(){
                    $('#modalID').val('');
                    $('.addonfield').remove();
                    var itemID = $(this).parent(".bootstrap-touchspin-injected").siblings(".item-ID").val();
                    var orderitemID = $(this).parent(".bootstrap-touchspin-injected").siblings(".orderitemID").val();
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    });
                    $.ajax({
                        method: "GET",
                        url: "/SingleCartGet/" + orderitemID,
                    }).done(function(dataValue) {

                        var dataLength = dataValue[0].length;
                        var data = dataValue[0];
                        for(var i =0; i<dataLength; i++)
                        {
                            var addonID = data[i]['addonID'];
                            $(".addonmodal").append('<div class="row col-md-12 addonfield" ><div id="addonnamemodalname'+addonID+'" class="col-md-6 addonnamemodalradio'+addonID+'" >'+data[i]["addon_name"]+'</div><div class="col-md-4"><span id="addonnamemodalprice'+addonID+'">'+data[i]["addon_price"]+'</span><i class="fas fa-euro-sign"></i></div><div class="vs-radio-con vs-radio-primary col-md-2"><input type="radio" name="vueradisize" class="addonnamemodalradio addonnamemodalradio'+addonID+'" value="'+addonID+'"><span class="vs-radio vs-radio-lg"><span class="vs-radio--border"></span><span class="vs-radio--circle"></span></span></div></div>');
                        }
                        console.log(data)
                        $("input[type='radio']").click(function(){
                            var modalradio = $(this).val();
                            $('#modalID').val(modalradio);
                        });
                    });
                        
                   

                    var name = $('.single-item-name'+itemID).val();
                    var quantity = $('.single-item-quantity'+itemID).val();
                    var price = $('.single-item-price'+itemID).val();
                    var image = $('#image'+itemID).val();
                    $('#customizationID').val(itemID);
                    $('#customizationname').text(name);
                    $('#customizationvalue').val(price);
                    $('#ModalOrderitemID').val(orderitemID);
                    $('#customizationimage').text(image);
                    var currentStatus = $('.current-status').val("2");
                    var quentityCounter = $('.quantity-counter').val();
                    if(quentityCounter == 1){

                    }else{
                        $('#bootstrap-touchspin-up').modal('show');
                    }
                });           
                $("#acceptcartCheckout").on("click", function() {
                var currentStatus = $('.current-status').val();
                console.log("currentStatus");
                console.log(currentStatus);
                if(currentStatus == 1){
                    var quentityCounter = $('.quantity-counter').val();
                    var InsertValue = parseInt(quentityCounter) + 1;
                    $('.quantity-counter').val(InsertValue);

                        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        });
                        var storeID = $("#storeID").val();
                        var customizationID = $("#customizationID").val();
                        var customizationname = $("#customizationname").text();
                        var customizationvalue = $("#customizationvalue").val();
                        var modalradioID = $('#modalID').val();
                        var customizationimage = $("#customizationimage").val();
                        var ModalOrderitemID = $("#ModalOrderitemID").val();
                        $.ajax({
                            method: "POST",
                            url: "/SingleCartUpdates",
                            data: {
                                "storeID": storeID,
                                "customizationID": customizationID,
                                "customizationname": customizationname,
                                "OrderitemID": ModalOrderitemID,
                                "currentStatus": currentStatus,
                                "InsertValue": InsertValue,
                                "states": "plus",
                                "addonID": modalradioID,
                                "addonname": $('#addonnamemodalname'+modalradioID).text(),
                                "addonprice":$('#addonnamemodalprice'+modalradioID).text(),
                                "customizationvalue": customizationvalue,
                            }
                        }).done(function(msg) {
                            location.reload(true);
                        });

                }else if(currentStatus == 2){
                    var quentityCounter = $('.quantity-counter').val();
                    var InsertValue = parseInt(quentityCounter) - 1;
                    $('.quantity-counter').val(InsertValue);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        });
                        var storeID = $("#storeID").val();
                        var customizationID = $("#customizationID").val();
                        var customizationname = $("#customizationname").text();
                        var customizationvalue = $("#customizationvalue").val();
                        var modalradioID = $('#modalID').val();
                        var ModalOrderitemID = $("#ModalOrderitemID").val();
                        var customizationimage = $("#customizationimage").val();
                        $.ajax({
                            method: "POST",
                            url: "/SingleCartUpdates",
                            data: {
                                "storeID": storeID,
                                "customizationID": customizationID,
                                "customizationname": customizationname,
                                "InsertValue": InsertValue,
                                "OrderitemID": ModalOrderitemID,
                                "currentStatus": currentStatus,
                                "customizationvalue": customizationvalue,
                                "addonID": modalradioID,
                                "states": "minuse",
                                "addonname": $('#addonnamemodalname'+modalradioID).text(),
                                "addonprice":$('#addonnamemodalprice'+modalradioID).text(),
                            }
                        }).done(function(msg) {
                            location.reload(true);
                        });

                }
            });
            });


        </script>
@endsection
   