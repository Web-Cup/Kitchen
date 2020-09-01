
@extends('admin.layouts.contentLayoutMaster')
@section('vendor-style')
        {{-- vendor files --}}
        <link rel="stylesheet" href="{{ asset('public/vendors/css/file-uploaders/dropzone.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/vendors/css/tables/datatable/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css') }}">
@endsection
@section('page-style')
        {{-- Page css files --}}
        <link rel="stylesheet" href="{{ asset('public/css/plugins/file-uploaders/dropzone.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/pages/data-list-view.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/core/menu/menu-types/horizontal-menu.css') }}">
@endsection

@section('content')
{{-- Data list view starts --}}
<!-- <link href="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/css/components.min.css" rel="stylesheet" type="text/css"> -->
<div class="horizontal-menu-wrapper">
        <div class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-light navbar-without-dd-arrow navbar-shadow menu-border navbar-brand-center" role="navigation" data-menu="menu-wrapper" data-nav="brand-center">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mr-auto"><a class="navbar-brand" href="../../../html/ltr/horizontal-menu-template/index.html">
                            <div class="brand-logo"></div>
                            <h2 class="brand-text mb-0">Vuexy</h2>
                        </a></li>
                    <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
                </ul>
            </div>
            <!-- Horizontal menu content-->
            <div class="navbar-container main-menu-content" data-menu="menu-container">
                <!-- include ../../../includes/mixins-->
                <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
                    <div class="col-md-8 col-sm-8">
                      <li class="nav-item"><a href="history" class="nav-link"><i style="font-size: 22px;" class="feather icon-edit"></i><span style="font-size: 22px;" data-i18n="History">History</span></a>
                      </li>
                    </div>
                    <div class="col-md-4 col-sm-4">
                      <div class="float-right">
                        <div>
                          <div class="d-flex justify-content-start">
                            <div class="mx-50 my-2">
                                <fieldset>
                                <div class="vs-radio-con vs-radio-primary">
                                    <input type="radio" name="layoutOptions" value="false" onclick="layoutChange(this)" class="layout-name" data-layout="" checked>
                                    <span class="vs-radio">
                                    <span class="vs-radio--border"></span>
                                    <span class="vs-radio--circle"></span>
                                    </span>
                                    <span class="">Light</span>
                                </div>
                                </fieldset>
                            </div>
                            <div class="mx-50 my-2">
                                <fieldset>
                                <div class="vs-radio-con vs-radio-primary">
                                    <input type="radio" name="layoutOptions" value="false" onclick="layoutChange(this)" class="layout-name" data-layout="dark-layout">
                                    <span class="vs-radio">
                                    <span class="vs-radio--border"></span>
                                    <span class="vs-radio--circle"></span>
                                    </span>
                                    <span class="">Dark</span>
                                </div>
                                </fieldset>
                            </div>
                            <li class="nav-item"><a onclick="sweetalert()" class="nav-link"><i style="font-size: 22px;" class="feather icon-power"></i><span style="font-size: 22px;" data-i18n="logout"></span></a></li>
                          </div>
                        </div>
                      </div>
                  </div>
                    <!-- <li style="margin-right: 75%;" class="nav-item">  
                    </li> -->
                    
                </ul>
            </div>
        </div>
    </div>
<section id="data-thumb-view" class="data-thumb-view-header">
    <!-- <div class="action-btns d-none">
      <div class="btn-dropdown mr-1 mb-1">
        <div class="btn-group dropdown actions-dropodown">
          <button type="button" class="btn btn-white px-1 py-1 dropdown-toggle waves-effect waves-light"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Actions
          </button>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="#"><i class="feather icon-trash"></i>Delete</a>
            <a class="dropdown-item" href="#"><i class="feather icon-archive"></i>Archive</a>
            <a class="dropdown-item" href="#"><i class="feather icon-file"></i>Print</a>
            <a class="dropdown-item" href="#"><i class="feather icon-save"></i>Another Action</a>
          </div>
          
        </div>
        
      </div>
      
    </div> -->
    <section id="data-thumb-view" class="data-thumb-view-header">
      <!-- <div class="action-btns d-none">
        <div class="btn-dropdown mr-1 mb-1">
          <div class="btn-group dropdown actions-dropodown">
            <button type="button" class="btn btn-white px-1 py-1 dropdown-toggle waves-effect waves-light"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Status
            </button>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="#"> Order Placed</a>
              <a class="dropdown-item" href="#"> Order Accepted</a>
              <a class="dropdown-item" href="#"> FINISH</a>
             </div>
            
          </div>
          
        </div>
        
      </div> -->
     
    
    
    

    {{-- dataTable starts --}}
    <div class="table-responsive">
      <table class="table data-thumb-view">
        
        <thead>
          
          <tr>
            <th></th>
            <th class="firstitem">{{__('storeDashboard.dashboardOrderID')}}</th>
            <th>{{__('storeDashboard.dashboardPrice')}}</th>
            <th>{{__('storeDashboard.dashboardOrderPlacedTime')}}</th>
            <th>{{__('storeDashboard.dashboardOrderAcceptedTime')}}</th>
            <th>{{__('storeDashboard.dashboardOrderCompletionTime')}}</th>
            <th>{{__('storeDashboard.opTableStatus')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($orders as $order)
            @if($order->orderstatus_id == 1 || $order->orderstatus_id == 2)
              <?php $color = "success" ?>
            @elseif($order->orderstatus_id == 3 || $order->orderstatus_id == 4)
              <?php $color = "primary" ?>
            @elseif($order->orderstatus_id == 5 || $order->orderstatus_id == 7)
              <?php $color = "warning" ?>
            @elseif($order->orderstatus_id == 8)
              <?php $color = "danger" ?>
            @endif
            
            <?php
              $arr = array('success', 'primary', 'info', 'warning','danger');
            ?>
            <tr class="action-edit" id="{{ $order->unique_order_id }}">
              <td></td>
              <td class="product-name">{{ $order->unique_order_id }}</td>
              <td class="product-price">{{ config('settings.currencyFormat') }} {{ $order->total }}</td>
              <td class="product-name">{{ $order->created_at->diffForHumans() }}</td>
              <td class="product-name">@if($order->orderstatus_id == 2){{ $order->updated_at->diffForHumans() }}@endif</td>
              <td class="product-name"> @if($order->orderstatus_id == 8){{$order->finshed_at->diffForHumans()}}@endif</td>
              <td>
                <div class="chip chip-{{$color}}">
                  <div class="chip-body">
                    <div class="chip-text">
                      @if ($order->orderstatus_id == 1) {{__('storeDashboard.opOrderStatus1')}} @endif
                      @if ($order->orderstatus_id == 2) {{__('storeDashboard.opOrderStatus2')}} @endif
                      @if ($order->orderstatus_id == 3) {{__('storeDashboard.opOrderStatus3')}} @endif
                      @if ($order->orderstatus_id == 4) {{__('storeDashboard.opOrderStatus4')}} @endif
                      @if ($order->orderstatus_id == 5) {{__('storeDashboard.opOrderStatus5')}} @endif
                      @if ($order->orderstatus_id == 6) {{__('storeDashboard.opOrderStatus6')}} @endif
                      @if ($order->orderstatus_id == 7) {{__('storeDashboard.opOrderStatus7')}} @endif
                      @if ($order->orderstatus_id == 8) {{__('storeDashboard.opOrderStatus8')}} @endif
                      @if($order->accept_delivery !== null)
                      @if($order->orderstatus_id > 2 && $order->orderstatus_id  < 6)
                      {{__('storeDashboard.opDeliveryBy')}}: <b>{{ $order->accept_delivery->user->name }}</b>
                      @endif
                      @endif
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    {{-- dataTable ends --}}

    {{-- add new sidebar starts --}}
    <div class="add-new-data-sidebar">
      <div class="overlay-bg"></div>
      <div class="add-new-data">
        <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
          <div>
            <h4 id="data-order-id" class="text-uppercase"></h4>
          </div>
          <div class="hide-data-sidebar">
            <i class="feather icon-x"></i>
          </div>
        </div>
        <div class="data-items pb-3">
          <div class="data-fields px-2 mt-1">
            <div class="row">
              <div style="text-align:right;" class="col-sm-12">
                <button class="btn btn-sm btn-primary btn-print-order">Print</button>
              </div>
              <div class="col-sm-12 data-field-col">
                <label for="data-name">Name</label>
                <input type="text" readonly class="form-control" id="data-name">
              </div>
              <!-- <div class="col-sm-12 data-field-col">
                <label for="data-category"> Category </label>
                <select class="form-control" id="data-category">
                  <option>Audio</option>
                  <option>Computers</option>
                  <option>Fitness</option>
                  <option>Appliance</option>
                </select>
              </div> -->
              <div class="col-sm-12 data-field-col">
                <label for="data-status">Order Status</label>
                <input type="text" readonly class="form-control" id="data-status">
              </div>
              <div class="col-sm-12 data-field-col">
                <label for="data-price">Price</label>
                <input type="text" readonly class="form-control" id="data-price">
              </div>
              <div style="margin-top: 10px;" class="col-sm-12">
                <img id="data-image" src="" alt="" width="100%">
                <!-- <form action="#" class="dropzone dropzone-area" id="dataListUpload">
                  <div class="dz-message">Upload Image</div>
                </form> -->
              </div>
            </div>
          </div>
        </div>
        <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
          <div class="add-data-btn">
            <button id="confirm-color" class="btn btn-warning btn-block btnFinish">Finish Order</button>
          </div>
        </div>
      </div>
    </div>
    {{-- add new sidebar ends --}}
    {{-- print modal starts --}}
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row order-body"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    {{-- print modal ends --}}

  </section>
  {{-- Data list view end --}}
@endsection
@section('vendor-script')
{{-- vendor js files --}}
        <script src="{{ asset('public/vendors/js/extensions/dropzone.min.js') }}"></script>
        <script src="{{ asset('public/vendors/js/tables/datatable/datatables.min.js') }}"></script>
        <script src="{{ asset('public/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
        <script src="{{ asset('public/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('public/vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
        <script src="{{ asset('public/vendors/js/tables/datatable/dataTables.select.min.js') }}"></script>
        <script src="{{ asset('public/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
        <script type="text/javascript" src="assets/backend/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
        <script type="text/javascript" src="assets/backend/js/printThis.js"></script>
@endsection
@section('page-script')
        {{-- Page js files --}}
        <script src="{{ asset('public/js/scripts/ui/data-list-view.js') }}"></script>
        <script>
          function sweetalert(){
            Swal.fire({
              title:"Are you sure?",text:"You won't be able to revert this!",type:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, complete it!",confirmButtonClass:"btn btn-primary",cancelButtonClass:"btn btn-danger ml-1",buttonsStyling:!1
            }).then(function(t){
              t.value?location.href='auth/logout':t.dismiss===Swal.DismissReason.cancel&&Swal.fire({title:"Cancelled",text:"Your imaginary file is safe :)",type:"error",confirmButtonClass:"btn btn-success"})
            })
          }
          $("#confirm-color").on("click",function(){
            Swal.fire({
              title:"Are you sure?",text:"You won't be able to revert this!",type:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, complete it!",confirmButtonClass:"btn btn-primary",cancelButtonClass:"btn btn-danger ml-1",buttonsStyling:!1
            }).then(function(t){
                var order_id = $(this).attr('data-id');
                var finishorderURL = 'order/finish-order/'+order_id;
                $.ajax({
                url: finishorderURL,
                type: 'GET',
                dataType: 'json',
                success: function () {
                  t.value?Swal.fire({type:"success",title:"Deleted!",text:"Your file has been deleted.",confirmButtonClass:"btn btn-success"}):t.dismiss===Swal.DismissReason.cancel&&Swal.fire({title:"Cancelled",text:"Your imaginary file is safe :)",type:"error",confirmButtonClass:"btn btn-success"})
                }
              })
            })
          });
          $(".btn-print-order").on('click', function (e) {
            e.preventDefault();e.stopPropagation();
            var order_id = $(this).attr('data-id');
            var url = "getorder/"+order_id;
            $.ajax({
              url: url,
              type: 'GET',
              success: function (result) {
                if(result){
                  var order_detail = '<div class="col-xl-8" id="printThis">'+
                                        '<div class="sidebar-category mt-4" style="box-shadow: 0 1px 6px 1px rgba(0, 0, 0, 0.05);background-color: #fff;">'+
                                            '<div class="category-content">'+
                                                '<div href="#" class="btn btn-block content-group" style="text-align: left; background-color: #8360c3; color: #fff; border-radius: 0;"><strong style="font-size: 1.3rem;">'+result.unique_order_id+'</strong>'+
                                                    '<a href="javascript:void(0)" id="printButton" class="btn btn-sm" style="color: #fff; border: 1px solid #ccc; float: right;">Print</a>'+
                                                '</div>'+
                                                '<div class="p-3">'+
                                                    '<div class="form-group">'+
                                                        '<label class="control-label no-margin text-semibold mr-2"><strong style="color:black;">Order Placed: </strong></label>'+result.created_at+
                                                    '</div>'+
                                                    '<hr>'+
                                                    '<div class="form-group">'+
                                                        '<label class="control-label no-margin text-semibold mr-2"><strong style="color:black;">Customer Details: </strong></label>'+
                                                        '<br>'+
                                                        '<p><b style="color:black;">Name: </b> '+result.user_name+'</p>'+
                                                        '<p><b style="color:black;">Email: </b> '+result.email+'</p>'+
                                                        '<p><b style="color:black;">Contact Number: </b> '+result.phone+'</p>'+
                                                    '</div>'+
                                                    '<hr>'+
                                                    '<div class="form-group">'+
                                                        '<label class="control-label no-margin text-semibold mr-2"><strong style="color:black;">Store Name: </strong></label>'+result.restu_name+
                                                    '</div>'+
                                                    '<div class="form-group">'+
                                                        '<label class="control-label no-margin text-semibold mr-2"><strong style="color:black;">Status:</strong></label>'+
                                                        '<span class="badge badge-flat border-grey-800 text-default text-capitalize">';
                  if(result.orderstatus_id == "1"){
                    order_detail += "Order Placed";
                  }else if(result.orderstatus_id == "2"){
                    order_detail += "Order Accepted";
                  }else if(result.orderstatus_id == "3"){
                    order_detail += "Delivery Assigned";
                  }else if(result.orderstatus_id == "4"){
                    order_detail += "Picked Up";
                  }else if(result.orderstatus_id == "5"){
                    order_detail += "Completed";
                  }else if(result.orderstatus_id == "6"){
                    order_detail += "Canceled";
                  }else if(result.orderstatus_id == "7"){
                    order_detail += "Ready to Pickup";
                  }else if(result.orderstatus_id == "8"){
                    order_detail += "Order Finished";
                  }
                  
                  order_detail +='</span>'+

                                                                                  
                                                    '</div>'+
                                                    '<div class="form-group">'+
                                                        '<label class="control-label no-margin text-semibold mr-2"><strong style="color:black;">Address: </strong></label>'+
                                                        '<p>, '+result.address+'</p>'+
                                                    '</div>'+
                                                    '<div class="form-group">'+
                                                        '<label class="control-label no-margin text-semibold mr-2"><strong style="color:black;">Payment Mode: </strong></label>'+
                                                        '<span class="badge badge-flat border-grey-800 text-default text-capitalize">'+result.payment_mode+
                                                        '</span>'+
                                                    '</div>'+
                                                    '<div class="form-group">'+
                                                        '<label class="control-label no-margin text-semibold mr-2"><strong style="color:black;">Comment/Suggestion: </strong></label>'+
                                                        '<span>'+
                                                        
                                                        '</span>'+
                                                    '</div>'+
                                                    '<hr>'+
                                                           '<div class="text-right">'+
                                                        '<div class="form-group">'+
                                                            '<div class="clearfix"></div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>';
                  $('.order-body').empty();
                  $('.order-body').append(order_detail);  
                  $(".order-body").printThis();
                  
                }
              }
            })
          })
          var body = $("body");
          function layoutChange(element) {
            var $this = $(element);
            var currentLayout = $this.data("layout");
            body.removeClass("dark-layout semi-dark-layout").addClass(currentLayout);
            if (currentLayout === "") {
              mainMenu.removeClass("menu-dark").addClass("menu-light");
              navbar.removeClass("navbar-dark").addClass("navbar-light");
            }
          }
          // $('body').on('click','.btnFinish', function (e) {
          //   e.stopPropagation();
          //   var order_id = $(this).attr('data-id');
          //   var finishorderURL = 'order/finish-order/'+order_id;
          //   $.ajax({
          //     url: finishorderURL,
          //     type: 'GET',
          //     dataType: 'json',
          //     success: function (params) {
                
          //     }
          //   })
          // })
        </script>
@endsection
