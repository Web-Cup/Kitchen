@extends('layouts.base')
@section('content')
<style>
.brand-logo {
    background-position: -120px -54px !important;
}

.pagination .page-item.active .page-link {
    background-color: rgb(255, 159, 67);
}
</style>



<!-- BEGIN: Main Menu-->

<!-- END: Main Menu-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Stores list</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                class="feather icon-settings"></i></button>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a
                                class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Data list view starts -->
            <section id="data-thumb-view" class="data-thumb-view-header">

                <!-- dataTable starts -->
                <div class="table-responsive">
                    <table class="table data-thumb-view">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Image</th>
                                <th>NAME</th>
                                <th>Description</th>
                                <th>Approx Delivery Time</th>
                                <th>STATUS</th>
                                <th>Min Order Price</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($restaurants as $key => $restaurant)
                            <tr>
                                <td></td>
                                <?php 
                                    $imglink = $restaurant->image;
                                    $url = "https://resto.solutionweb.io".$imglink;
                                    ?>
                                <td><img src="{{ $url }}" alt="{{ $restaurant->name }}" height="80" width="80"
                                        style="border-radius: 0.275rem;"></td>
                                <td>{{ $restaurant->name }}</td>
                                <td>{{ $restaurant->description }}</td>
                                <td>
                                    {{ $restaurant->delivery_time }}

                                </td>
                                <td> 
                                    @if($restaurant->is_active)
                                    <div class="chip chip-success" style="background-color: green !important;">                                        
                                        <div class="chip-body">
                                            <div class="chip-text">Open
                                    @else
                                    <div class="chip chip-success" style="background-color:  red!important;">                                        
                                        <div class="chip-body">
                                            <div class="chip-text">close
                                    @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <span style="color: red;"> </span>
                                <td class="product-price">
                                    {{ $restaurant->min_order_price }}<i class="fas fa-euro-sign"></i>

                                </td>
                                <td class="product-action">

                                    <button type="button" id="{{$restaurant->id}}" class="action-edit btn btn-outline-success" data-toggle="modal"
                                            data-target="#inlineForm">
                                            Suchedule View
                                    </button>
                                   
                                    <a href="viewshop/{{$restaurant->id}}"> <button type="button" class="btn btn-outline-success" >
                                            Shop</button>
                                        </a>
                                    
                                    <input type="hidden" id="schedule{{$restaurant->id}}" class="form-control"
                                        value="{{$restaurant->schedule_data}}" name="">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- dataTable ends -->
                <!-- Modal -->
                <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel33" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel33">Scheduling Times</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="#">
                                <div class="modal-body">
                                    <div class="overlay-bg"></div>
                                    <div class="add-new-data">

                                        <div class="data-items pb-3">
                                            <div class="data-fields px-2 mt-3">
                                                <div class="row">
                                                    <div class="col-sm-12 data-field-col">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <label for="data-name">Moday</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label for="data-name">Opening Time</label>
                                                                <input type="text" disabled class="form-control" value=""
                                                                    id="mondayopen" name="mondayopen">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label for="data-name">Closing Time</label>
                                                                <input type="text" disabled class="form-control" value=""
                                                                    id="mondayclose" name="mondayclose">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 data-field-col">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <label for="data-name">Tuesday</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label for="data-name">Opening Time</label>
                                                                <input type="text" disabled class="form-control" value=""
                                                                    id="tuesdayopen" name="tuesdayopen">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label for="data-name">Closing Time</label>
                                                                <input type="text" class="form-control" value=""
                                                                    id="tuesdayclose" disabled name="tuesdayclose">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 data-field-col">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <label for="data-name">Wednesday</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label for="data-name">Opening Time</label>
                                                                <input type="text" disabled class="form-control" value=""
                                                                    id="wednesdayopen" name="wednesdayopen">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label for="data-name">Closing Time</label>
                                                                <input type="text" class="form-control" value=""
                                                                    id="wednesdayclose" disabled name="wednesdayclose">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 data-field-col">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <label for="data-name">Thursday</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label for="data-name">Opening Time</label>
                                                                <input type="text" disabled class="form-control" value=""
                                                                    id="thursdayopen" name="thursdayopen">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label for="data-name">Closing Time</label>
                                                                <input type="text" disabled class="form-control" value=""
                                                                    id="thursdayclose" name="thursdayclose">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 data-field-col">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <label for="data-name">Friday</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label for="data-name">Opening Time</label>
                                                                <input type="text" disabled class="form-control" value=""
                                                                    id="fridayopen" name="fridayopen">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label for="data-name">Closing Time</label>
                                                                <input type="text" disabled class="form-control" value=""
                                                                    id="fridayclose" name="fridayclose">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 data-field-col">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <label for="data-name">Saturday</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label for="data-name">Opening Time</label>
                                                                <input type="text" disabled class="form-control" value=""
                                                                    id="saturdayopen" name="saturdayopen">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label for="data-name">Closing Time</label>
                                                                <input type="text" disabled class="form-control" value=""
                                                                    id="saturdayclose" name="saturdayclose">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 data-field-col">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <label for="data-name">Sunday</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label for="data-name">Opening Time</label>
                                                                <input type="text" disabled class="form-control" value=""
                                                                    id="sundayopen" name="sundayopen">
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label for="data-name">Closing Time</label>
                                                                <input type="text" disabled class="form-control" value=""
                                                                    id="sundayclose" name="sundayclose">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- add new sidebar starts -->
                <div class="add-new-data-sidebar">
                    <div class="overlay-bg"></div>
                    <div class="add-new-data">
                        <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                            <div>
                                <legend class="font-weight-semibold text-uppercase font-size-sm"><i
                                        class="fa fa-clock-o"></i> Scheduling Times</legend>
                            </div>
                            <div class="hide-data-sidebar">
                                <i class="feather icon-x"></i>
                            </div>
                        </div>
                        <div class="data-items pb-3">
                            <div class="data-fields px-2 mt-3">
                                <div class="row">
                                    <div class="col-sm-12 data-field-col">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="data-name">Moday</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="data-name">Opening Time</label>
                                                <input type="text" class="form-control" value="" id="mondayopen"
                                                    name="mondayopen">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="data-name">Closing Time</label>
                                                <input type="text" class="form-control" value="" id="mondayclose"
                                                    name="mondayclose">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 data-field-col">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="data-name">Tuesday</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="data-name">Opening Time</label>
                                                <input type="text" class="form-control" value="" id="tuesdayopen"
                                                    name="tuesdayopen">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="data-name">Closing Time</label>
                                                <input type="text" class="form-control" value="" id="tuesdayclose"
                                                    name="tuesdayclose">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 data-field-col">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="data-name">Wednesday</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="data-name">Opening Time</label>
                                                <input type="text" class="form-control" value="" id="wednesdayopen"
                                                    name="wednesdayopen">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="data-name">Closing Time</label>
                                                <input type="text" class="form-control" value="" id="wednesdayclose"
                                                    name="wednesdayclose">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 data-field-col">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="data-name">Thursday</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="data-name">Opening Time</label>
                                                <input type="text" class="form-control" value="" id="thursdayopen"
                                                    name="thursdayopen">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="data-name">Closing Time</label>
                                                <input type="text" class="form-control" value="" id="thursdayclose"
                                                    name="thursdayclose">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 data-field-col">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="data-name">Friday</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="data-name">Opening Time</label>
                                                <input type="text" class="form-control" value="" id="fridayopen"
                                                    name="fridayopen">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="data-name">Closing Time</label>
                                                <input type="text" class="form-control" value="" id="fridayclose"
                                                    name="fridayclose">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 data-field-col">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="data-name">Saturday</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="data-name">Opening Time</label>
                                                <input type="text" class="form-control" value="" id="saturdayopen"
                                                    name="saturdayopen">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="data-name">Closing Time</label>
                                                <input type="text" class="form-control" value="" id="saturdayclose"
                                                    name="saturdayclose">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 data-field-col">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="data-name">Sunday</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="data-name">Opening Time</label>
                                                <input type="text" class="form-control" value="" id="sundayopen"
                                                    name="sundayopen">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="data-name">Closing Time</label>
                                                <input type="text" class="form-control" value="" id="sundayclose"
                                                    name="sundayclose">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- add new sidebar ends -->
            </section>
            <!-- Data list view end -->

        </div>
    </div>
</div>
<!-- END: Content-->
<script src="{{ asset('public/app-assets/js/scripts/ui/data-list-view.js') }}"></script>

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>
@endsection