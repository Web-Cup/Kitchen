
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
        <link rel="stylesheet" href="{{ asset('assets/backend/css/backend-custom.css') }}">
        <!-- <link rel="stylesheet" href="{{ asset('assets/backend/global_assets/css/icons/icomoon/styles.min.css') }}"> -->
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
            <th>{{__('storeDashboard.dashboardOrderPlacedTime')}}</th>
            <th>{{__('storeDashboard.dashboardOrderAcceptedTime')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($orders as $order)
            @if($order->orderstatus_id != 8 && empty($order->finished_at))
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
              <tr onclick="actionEdit(event,this)" id="{{ $order->unique_order_id }}">
                <td></td>
                <td class="product-name">{{ $order->unique_order_id }}</td>
                <input type="hidden" class="order_time" value="<?php echo $order->created_at; ?>"><td class="product-ordertime"><?php $created = $order->created_at->diffInMinutes();
                if($created < 11){ echo "<span style='color:green'>".$order->created_at->diffForHumans()."</span>";}else{echo "<span style='color:red'>".$order->created_at->diffForHumans()."</span>";}?></td>
                <input type="hidden" class="order_accept" value="<?php echo $order->updated_at; ?>">
                <td class="product-orderaccept">
                  <?php 
                    $updated = $order->updated_at->diffInMinutes();
                    if($updated < 11){ echo "<span style='color:green'>".$order->updated_at->diffForHumans()."</span>";}else{echo "<span style='color:red'>".$order->updated_at->diffForHumans()."</span>";}
                  ?>
                </td>
              </tr>
            @endif
          @endforeach
        </tbody>
      </table>
    </div>
    {{-- dataTable ends --}}

    {{-- add new sidebar starts --}}
    <input type="hidden" value="{{ csrf_token() }}" class="csrfToken">
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
              <div style="border-bottom: 1px solid #22292f1a;" class="col-sm-12 data-field-col">
                <label for="data-name"><strong>Order Placed</strong></label>
                <label for="value-name" id="d_placed_date"></label>
              </div>
              <div class="col-sm-12 data-field-col">
                <label for="data-store-name"><strong>Store Name</strong></label>
                <label for="value-store-name" id="store_name"></label>
              </div>
              <div  class="col-sm-12 data-field-col">
                <label for="data-status"><strong>Status</strong></label>
                <span id="value-status" class="badge badge-flat border-grey-800 text-default text-capitalize"></span>
              </div>
              <div id="comment-suggestion" style="border-bottom: 1px solid #22292f1a;" class="col-sm-12 data-field-col">
                <label for="comments"><strong>Comment/Suggestion: </strong><span id="comments"></span></label>
              </div>
              <div class="items col-sm-12">

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
        <script src="{{ asset('public/vendors/js/extensions/moment.min.js') }}"></script>
        <script src="{{ asset('public/vendors/js/extensions/moment-timezone.min.js') }}"></script>
        <script src="{{ asset('public/vendors/js/extensions/dropzone.min.js') }}"></script>
        <script src="{{ asset('public/vendors/js/tables/datatable/datatables.min.js') }}"></script>
        <script src="{{ asset('public/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
        <script src="{{ asset('public/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('public/vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
        <script src="{{ asset('public/vendors/js/tables/datatable/dataTables.select.min.js') }}"></script>
        <script src="{{ asset('public/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
        <script src="{{ asset('public/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
        <script type="text/javascript" src="assets/backend/global_assets/js/plugins/notifications/sweet_alert.min.js"></script>
        <script type="text/javascript" src="assets/backend/js/printThis.js"></script>
@endsection
@section('page-script') 
        {{-- Page js files --}}
        <script src="{{ asset('public/js/scripts/ui/data-list-view.js') }}"></script>
        <script>
          moment.tz.setDefault("Europe/Paris");
          setInterval(() => {
            $.each($(".order_time"), function (index, element) {
              var time = moment(element.value).fromNow();
              var time_arr = time.split(" ");
              var td_time = $('.product-ordertime');
              if(time_arr[0] < 11 && (time_arr[1] == "minutes" || time_arr[1] == "minute")){
                td_time[index].children[0].style.color = 'green';
                td_time[index].children[0].innerHTML = time;
              }else{
                td_time[index].children[0].style.color = 'red';
                td_time[index].children[0].innerHTML = time;
              }
            })
          }, 60000);
          setInterval(() => {
            $.each($(".order_accept"), function (index, element) {
              var time = moment(element.value).fromNow();
              var time_arr = time.split(" ");
              var td_time = $('.product-orderaccept');
              if(time_arr[0] < 11 && (time_arr[1] == "minutes" || time_arr[1] == "minute")){
                td_time[index].children[0].style.color = 'green';
                td_time[index].children[0].innerHTML = time;
              }else{
                td_time[index].children[0].style.color = 'red';
                td_time[index].children[0].innerHTML = time;
              }
            })
          }, 60000);
          function sweetalert(){
            Swal.fire({
              title:"Are you sure?",text:"You won't be able to revert this!",type:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, complete it!",confirmButtonClass:"btn btn-primary",cancelButtonClass:"btn btn-danger ml-1",buttonsStyling:!1
            }).then(function(t){
              t.value?location.href='auth/logout':t.dismiss===Swal.DismissReason.cancel&&Swal.fire({title:"Cancelled",text:"Your imaginary file is safe :)",type:"error",confirmButtonClass:"btn btn-success"})
            })
          }
          $("#confirm-color").on("click",function(){
            var order_id = $(this).attr('data-id');
            var finishorderURL = 'finish-order/'+order_id;
            Swal.fire({
              title:"Are you sure?",text:"You won't be able to revert this!",type:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Yes, complete it!",confirmButtonClass:"btn btn-primary",cancelButtonClass:"btn btn-danger ml-1",buttonsStyling:!1
            }).then(function(t){
                t.value ? 
                  $.ajax({
                  url: finishorderURL,
                  type: 'GET',
                  dataType: 'json'
                }).done(function(){
                    location.href = 'history'; 
                  }).fail(function(){
                    location.href = 'history'; 
                  }) : t.dismiss===Swal.DismissReason.cancel&&Swal.fire({title:"Cancelled",text:"Your imaginary file is safe :)",type:"error",confirmButtonClass:"btn btn-success"})
                
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
                                                        '<label class="control-label no-margin text-semibold mr-2"><strong style="color:black;">Order Placed: </strong></label>'+result.order_placed+
                                                    '</div>'+
                                                    '<hr>'+
                                                    '<div class="form-group">'+
                                                        '<label class="control-label no-margin text-semibold mr-2"><strong style="color:black;">Store Name: </strong></label>'+result.restaurant_name+
                                                    '</div>'+
                                                    '<div class="form-group">'+
                                                        '<label class="control-label no-margin text-semibold mr-2"><strong style="color:black;">Status:</strong></label>'+
                                                        '<span class="badge badge-flat border-grey-800 text-default text-capitalize"><strong>';
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
                  
                  order_detail +='</strong></span>'+

                                                                                  
                                                    '</div>'+
                                                    '<div class="form-group">'+
                                                        '<label class="control-label no-margin text-semibold mr-2"><strong style="color:black;">Comment/Suggestion: </strong><span id="comments">'+result.order_comment+'</span></label>'+
                                                        '<span>'+
                                                        
                                                        '</span>'+
                                                    '</div>'+
                                                    '<hr>'+
                                                           '<div class="text-right">'+
                                                        '<div class="form-group">'+
                                                            '<div class="clearfix"></div>'+
                                                            '<div class="row">'+
                                                              '<div class="col-md-12 p-2 mb-3" style="background-color: #f7f8fb; float: right; text-align: left;">'+
                                                                '<div>';
                                                                for (const key in result.orderitems) {
                                                                  if (result.orderitems.hasOwnProperty(key)) {
                                                                    const element = result.orderitems[key];
                                                                    order_detail += '<div class="d-flex mb-1 align-items-start" style="font-size: 1.2rem;">'+
                                                                        '<strong style="font-weight:900;color:black" class="badge mr-2">x'+element.quantity+'</strong>'+
                                                                        '<strong class="mr-2" style="width: 100%;">'+element.name+'</strong>'+
                                                                        '</div>';
                                                                        if(element.order_item_addons.length > 0){
                                                                          order_detail += '<div class="table-responsive">'+
                                                                                            '<table class="table table-striped">'+
                                                                                                '<thead>'+
                                                                                                    '<tr>'+
                                                                                                        '<th>Category</th>'+
                                                                                                        '<th>Addon</th>'+
                                                                                                    '</tr>'+
                                                                                                '</thead>'+
                                                                                                '<tbody>';
                                                                          for (const key in element.order_item_addons) {
                                                                            if (element.order_item_addons.hasOwnProperty(key)) {
                                                                              const ele = element.order_item_addons[key];
                                                                              order_detail += '<tr>'+
                                                                              '<td>'+ele.addon_category_name+'</td>'+
                                                                              '<td>'+ele.addon_name+'</td>'+
                                                                          '</tr>';
                                                                            }
                                                                          }
                                                                          order_detail += '</tbody>'+
                                                                              '</table>'+
                                                                            '</div>';
                                                                        }
                                                                      }
                                                                      order_detail += '<div class="mb-2" style="border-bottom: 2px solid #c9c9c9;"></div>';
                                                                    }
                                                                    
                                                                    order_detail += '</div>'+'</div>'+
                                                            '</div>'+
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
          function actionEdit(event,element){
            
            event.stopPropagation();
            var order_id = $(element).attr('id');
            let url = "getorder/"+order_id;
            $.ajax({
              url: url,
              type: 'get',
              dataType: 'json',
              success: function (data) {
                $(".items").empty();
                var status;
                if(data.orderstatus_id == "1"){
                  status = "Order Placed";
                }else if(data.orderstatus_id == "2"){
                  status = "Order Accepted";
                }else if(data.orderstatus_id == "3"){
                  status = "Delivery Assigned";
                }else if(data.orderstatus_id == "4"){
                  status = "Picked Up";
                }else if(data.orderstatus_id == "5"){
                  status = "Completed";
                }else if(data.orderstatus_id == "6"){
                  status = "Canceled";
                }else if(data.orderstatus_id == "7"){
                  status = "Ready to Pickup";
                }else if(data.orderstatus_id == "8"){
                  status = "Order Finished";
                }

                $("#value-status").html(status);
                $('#data-order-id').html(data.unique_order_id);
                $('.btn-print-order').attr('data-id',data.unique_order_id);
                $('#d_placed_date').html(data.order_placed);
                $('#store_name').html(data.restaurant_name);
                $('#comments').html(data.order_comment);
                // $('#value-quantity').html("x"+data.quantity);
                // $('#value-item').html(data.name);
                for (const key in data.orderitems) {
                  if (data.orderitems.hasOwnProperty(key)) {
                    const element = data.orderitems[key];
                    var items = '<div class="col-sm-12 data-field-col">'+
                                  '<span id="value-quantity" class="badge badge-flat border-grey-800 text-default mr-2">x'+element.quantity+'</span><strong id="value-item">'+element.name+'</strong>';
                    if(element.order_item_addons.length > 0){
                      items += '<div class="table-responsive">'+
                      '<table class="table table-striped">'+
                          '<thead>'+
                              '<tr>'+
                                  '<th>Category</th>'+
                                  '<th>Addon</th>'+
                              '</tr>'+
                          '</thead>'+
                          '<tbody>';
                            for (const key in element.order_item_addons) {
                              if (element.order_item_addons.hasOwnProperty(key)) {
                                const ele = element.order_item_addons[key];
                                items += '<tr>'+
                                '<td>'+ele.addon_category_name+'</td>'+
                                '<td>'+ele.addon_name+'</td>'+
                            '</tr>';
                              }
                            }
                          items += '</tbody>'+
                                '</table>'+
                              '</div>';
                    }
                    items += '<div class="mb-2" style="border-bottom: 2px solid #c9c9c9;"></div>'+
                    '</div>';
                    $('.items').append(items);
                  }
                }
                $('.btnFinish').attr('data-id',data.unique_order_id);
                $(".add-new-data").addClass("show");
                $(".overlay-bg").addClass("show");
              }
            })
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
