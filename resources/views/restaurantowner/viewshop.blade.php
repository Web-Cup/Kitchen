@extends('layouts.base')
@section('content')
<style>
    .shopoption{
        -webkit-box-flex: 1;
        -webkit-flex-grow: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        background-color: #F6F6F6;
        color: #2C2C2C;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        padding: 0.8rem 2rem;
    }
    div#cardplus:hover {
        background-color: #ff9f43;
    }
    div#cartmin:hover {
        background-color: #ff9f43;
    }
    div.ecommerce-allcard{
        display: none;
    }
</style>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="csrf-token" content="{!! csrf_token() !!}">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Shop</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('restaurant.orders')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ $storename }}</a>
                                    </li>
                                    <li class="breadcrumb-item active">Shop
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrum-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings"></i></button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-detached content-right">
                <div class="content-body">
                    <!-- Ecommerce Content Section Starts -->
                    <section id="ecommerce-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="ecommerce-header-items">
                                    <div class="result-toggler">
                                        <button class="navbar-toggler shop-sidebar-toggler" type="button" data-toggle="collapse">
                                            <span class="navbar-toggler-icon d-block d-lg-none"><i class="feather icon-menu"></i></span>
                                        </button>
                                        <div class="sea
                                        rch-results">
                                            
                                        </div>
                                    </div>
                                    <div class="view-options">
                                        <select class="price-options form-control" id="ecommerce-price-options">
                                            <option selected>Featured</option>
                                            <option value="1">Lowest</option>
                                            <option value="2">Highest</option>
                                        </select>
                                        <div class="view-btn-option">
                                            <button class="btn btn-white view-btn grid-view-btn active">
                                                <i class="feather icon-grid"></i>
                                            </button>
                                            <button class="btn btn-white list-view-btn view-btn">
                                                <i class="feather icon-list"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Ecommerce Content Section Starts -->
                    <!-- background Overlay when sidebar is shown  starts-->
                    <div class="shop-content-overlay"></div>
                    <!-- background Overlay when sidebar is shown  ends-->

                    <!-- Ecommerce Search Bar Starts -->
                    <section id="ecommerce-searchbar">
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <fieldset class="form-group position-relative">
                                    <input type="text" class="form-control search-product" id="iconLeft5" placeholder="Search here">
                                    <div class="form-control-position">
                                        <i class="feather icon-search"></i>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </section>
                    <!-- Ecommerce Search Bar Ends -->

                    <!-- Ecommerce Products Starts -->
                    <section id="ecommerce-products" class="grid-view">
                        <input type="hidden" id="storeID" value="{{ $storeID }}">
                        @foreach ($Item as $key => $SubItem)

                        <div class="card ecommerce-card ecommerce-singlecard{{ $SubItem->id }}">
                            <div class="card-content">
                                <div class="item-img text-center">
                                    <a href="app-ecommerce-details.html">
                                    <?php 
                                    $imglink = $SubItem->image;
                                    $url = "https://resto.solutionweb.io".$imglink;
                                    ?>
                                        <img class="img-fluid" src="{{ $url }}" alt="img-placeholder"></a>
                                </div>
                                <input type="hidden" name="" id="image{{ $SubItem->id }}" value="{{ $SubItem->image }}">
                                <div class="card-body">
                                 <?php 
                                    $id = $SubItem->id;
                                    $is_actived = $SubItem->is_active;
                                    if(count($addons[$id]) > 0)
                                    {
                                        
                                        $Customizable = '<span style="color:red">Customizable</span>';
                                        $Customizabled = 'onshow';
                                    }else{
                                        
                                        $Customizabled = '0';
                                        $Customizable = "";
                                    }
                                    if($is_actived == 0){
                                        $color = "danger";
                                        $status_actived = "addstyleforActived";
                                    }else if($is_actived == 1){
                                        $color = "success";
                                        $status_actived = "removestyleforActived";
                                    }
                                 ?>
                                    <input type="hidden"  class="addonValue{{$SubItem->id}}" value="{{$addonValues[$key]}}">
                                    <input type="hidden" class="item-ID" value="{{ $SubItem->id }}">
                                    <input type="hidden" class="single-item-name{{ $SubItem->id }}" value="{{ $SubItem->name }}">
                                    <input type="hidden" name="" id="image{{ $SubItem->id }}" value="{{ $SubItem->image }}">
                                    <input type="hidden" class="current-status" value="">
                                    <input type="hidden" class="customizableItem{{ $SubItem->id }}" value="{{$Customizabled}}">
                                    <div class="item-name">
                                        <div class="vs-radio-con vs-radio-{{$color}}">
                                            <input type="radio" checked value="true">
                                            <span class="vs-radio">
                                                <span class="vs-radio--border"></span>
                                                <span class="vs-radio--circle"></span>
                                            </span>
                                            <span class=""><a href="#" id="cartname{{ $SubItem->id }}">{{ $SubItem->name }}</a></span>
                                        </div>
                                    </div>
                                    <div> 
                                        <span class="item-description" id="cartprice{{ $SubItem->id }}">{{ $SubItem->price }}</span>
                                        <i class="fas fa-euro-sign"></i>
                                        <?php 
                                            echo strip_tags($Customizable, '<span>');
                                        ?>
                                        
                                    </div>
                                </div>
                                <div class="item-options text-center">
                                        <?php 
                                            $SitemID = $SubItem->id;
                                            $style = "addstyle";
                                            if($sub_order !== null)
                                            {
                                                foreach($sub_order as $sub_ordervalues){
                                                    $restaurantorder_id = $sub_ordervalues->order_id;
                                                    $restaurantitem_id = $sub_ordervalues->item_id;
                                                    $restaurantquantity = $sub_ordervalues->quantity;
                                                    if($restaurantorder_id == $storeID && $restaurantitem_id == $SitemID){
                                                        $quantity = (int)$restaurantquantity;
                                                        if($quantity >= 1){
                                                            $style = "removestyle";
                                                        }
                                                        
                                                    }  
                                                }
                                            }

                                        ?>
                                        <style>
                                            .addstyle{
                                                pointer-events: none;
                                                margin: 9px;
                                            }
                                            .removestyle{
                                                margin: 9px;
                                            }
                                            .addstyleforActived{
                                                pointer-events: none!important;
                                                margin: 9px;
                                            }
                                            .removestyleforActived{
                                                margin: 9px;
                                            }
                                        </style>
                                    <div class="{{$status_actived}} shopoption shopoptionminus cartmin{{ $SubItem->id }} {{$style}}" id="cartmin"  data-toggle="modal" data-target="#{{$Customizabled}}" value="{{ $SubItem->id }}">
                                        <i class="fa fa-minus"></i>
                                    </div>
                                    <div class="{{$status_actived}} shopoption shopoptionplus" id="cardplus" data-toggle="modal" data-target="#{{$Customizabled}}" style="margin: 9px;" value="{{ $SubItem->id }}">
                                        <i class="fa fa-plus"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                         @endforeach
                    </section>
                    <!-- Ecommerce Products Ends -->
                        <!-- Modal Plus -->
                    <div class="modal fade text-left" id="onshow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel21" aria-hidden="true">
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
                                        <b  id="customizationname">
                                                
                                        </b>    
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row addonmodal">
                                                
                                                <!-- <div class="col-md-6">
                                                    <span id="customizationvalue">
                                                    </span>
                                                <i class="fa fa-usd" aria-hidden="true"></i>
                                                </div> -->
                                            </div> 
                                        </div>
                                        <input type="hidden" id="customizationID" value="">
                                        <input type="hidden" id="customizationimage" value="">
                                        <input type="hidden" id="storeID" value="{{ $storeID }}">
                                        <input type="hidden" id="modalID" value="">
                                        <input type="hidden" id="customizationname" value="">
                                        <input type="hidden" id="ModalOrderitemID" value="">
                                        <input type="hidden" id="customizationvalue" value="">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="acceptcart" class="btn btn-outline-primary" data-dismiss="modal">Accept</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Ecommerce Pagination Starts -->
                    <section id="ecommerce-pagination">
                        <div class="row">
                            <div class="col-sm-12">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center mt-2">
                                        <li class="page-item prev-item"><a class="page-link" href="#"></a></li>
                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item" aria-current="page"><a class="page-link" href="#">4</a></li>
                                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                                        <li class="page-item"><a class="page-link" href="#">7</a></li>
                                        <li class="page-item next-item"><a class="page-link" href="#"></a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </section>
                    <!-- Ecommerce Pagination Ends -->

                </div>
            </div>
            <div class="sidebar-detached sidebar-left">
                <div class="sidebar">
                    <!-- Ecommerce Sidebar Starts -->
                    <div class="sidebar-shop" id="ecommerce-sidebar-toggler">

                        <div class="row">
                            <div class="col-sm-12">
                                <h6 class="filter-heading d-none d-lg-block">Filters</h6>
                            </div>
                        </div>
                        <span class="sidebar-close-icon d-block d-md-none">
                            <i class="feather icon-x"></i>
                        </span>
                        <div class="card">
                            <div class="card-body">
                                <div class="multi-range-price">
                                    <div class="multi-range-title pb-75">
                                        <h6 class="filter-title mb-0">Multi Range</h6>
                                    </div>
                                    <ul class="list-unstyled price-range" id="price-range">
                                        <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="price-range" checked value="All">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50">All</span>
                                            </span>
                                        </li>

                                        <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="price-range" value="10">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50"> 10€</span>
                                            </span>
                                        </li>
                                   
                                        <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="price-range" value="20">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50"> 20€</span>
                                            </span>
                                        </li>
                                      
                                        <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="price-range" value="30">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50"> 30€</span>
                                            </span>
                                        </li>
                                        
                                        <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="price-range" value="40">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50"> 40€</span>
                                            </span>
                                        </li>
                                      
                                        <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="price-range" value="50">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50"> 50€</span>
                                            </span>
                                        </li> 
                                    </ul>
                                </div>
                                <!-- /Price Filter -->
                                <hr>
                            
                                <!-- Categories Starts -->
                                <div id="product-categories">
                                    <div class="product-category-title">
                                        <h6 class="filter-title mb-1">Categories</h6>
                                    </div>
                                    <ul class="list-unstyled categories-list">
                                        <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" class="category-filter" checked name="category-filter" value="All" >
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50">All</span>
                                            </span>
                                        </li>
                                        @foreach($ItemCategoryIDs as $ItemCategoryID)
                                        <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" class="category-filter" name="category-filter" value="{{$ItemCategoryID->id}}" >
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50">{{$ItemCategoryID->name}}</span>
                                            </span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- Categories Ends -->
                                <hr>
                                <!-- Brands -->
                                <div class="brands">
                                    <div class="brand-title mt-1 pb-1">
                                        <h6 class="filter-title mb-0">Brands</h6>
                                    </div>
                                    <div class="brand-list" id="brands">
                                        <ul class="list-unstyled">
                                            <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" id="IsRecommended" value="Recommended">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Is Recommended?</span>
                                                </span>
                                                <!-- <span>298</span> -->
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" id="IsPopular" value="Popular">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Is Popular?</span>
                                                </span>
                                                <!-- <span>298</span> -->
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" id="IsNew" value="New">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Is New?</span>
                                                </span>
                                                <!-- <span>298</span> -->
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" id="IsVeg" value="Veg">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Is Veg?</span>
                                                </span>
                                                <!-- <span>298</span> -->
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /Brand -->
                                <hr>
                               
                                <!-- Clear Filters Starts -->
                                <div id="clear-filters">
                                    <button class="btn btn-block btn-primary">CLEAR ALL FILTERS</button>
                                </div>
                                <!-- Clear Filters Ends -->

                            </div>
                        </div>
                    </div>
                    <!-- Ecommerce Sidebar Ends -->

                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>



    <!-- BEGIN: Page JS-->
    <script src="{{ asset('public/app-assets/js/scripts/pages/app-ecommerce-shop.js')}}"></script>
    <!-- END: Page JS-->

    @endsection
