<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" href="{{ asset('public/app-assets/images/ico/apple-icon-120.png')}}')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/app-assets/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    @yield('vendor-style')

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/themes/semi-dark-layout.css')}}">

    <!-- BEGIN: shopPage CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/core/menu/menu-types/horizontal-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/plugins/extensions/noui-slider.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/app-assets/css/pages/app-ecommerce-shop.css')}}">
    <!-- END: Page CSS-->
    @yield('page-style')


    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/style.css')}}">
    <!-- END: Custom CSS-->
   <!-- BEGIN: Vendor CSS-->
   <link rel="stylesheet" type="text/css" href="../../../public/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../public/app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
    <link rel="stylesheet" type="text/css" href="../../../public/app-assets/vendors/css/extensions/toastr.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../../../public/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../public/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../../public/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../../../public/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../../../public/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../../../public/app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../public/app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../public/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="../../../public/app-assets/css/pages/app-ecommerce-shop.css">
    <link rel="stylesheet" type="text/css" href="../../../public/app-assets/css/plugins/forms/wizard.css">
    <link rel="stylesheet" type="text/css" href="../../../public/app-assets/css/plugins/extensions/toastr.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../public/assets/css/style.css">
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu content-detached-left-sidebar ecommerce-application navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="content-detached-left-sidebar">
   <!-- BEGIN: Header-->
<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-fixed navbar-shadow navbar-brand-center">
    <div class="navbar-header d-xl-block d-none">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item"><a class="navbar-brand"
                    href="{{ asset('public/html/ltr/horizontal-menu-template/index.html') }}">
                    <div class="brand-logo"></div>
                </a></li>
        </ul>
    </div>
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div
                    class="mr-auto float-left bookmark-wrapper vs-radio-con vs-radio-primary d-flex align-items-center">
                    <ul class="nav navbar-nav bookmark-icons">
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" href="#" data-toggle="tooltip" data-placement="top" title="Light">
                                <input type="radio" name="layoutOptions"  style="width: 40%;" value="false" onclick="layoutChange(this)"
                                    class="layout-name" data-layout="" checked>
                                <span class="">Light</span>
                            </a>
                        </li>
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" href="#" data-toggle="tooltip" data-placement="top" title="Dark">
                                <input type="radio" name="layoutOptions"  style="width: 40%;" value="false" onclick="layoutChange(this)"
                                    class="layout-name" data-layout="dark-layout">
                                <span class="">Dark</span>
                            </a>
                        </li>
                        @if($cartorder == 1)
                        <li class="nav-item  d-none d-lg-block" style="align-self: center;background: rgb(96, 178, 70); border-radius: 8px;">
                            <a class="nav-link cartcolor" href="/checkout/{{ $storeID }}"  data-toggle="tooltip" data-placement="top" title="View Cart" style="color: #ffffff; padding-top: 10px; padding-bottom: 10px;">
                              <span id="itemscart" style="color: #ffffff;">{{ $count }}</span> Items | <span id="pricecart" style="color: #ffffff;">{{ $price }}</span>$ &nbsp &nbsp &nbsp &nbsp View Cart <i class="fa fa-shopping-cart" style="color: #ffffff;"></i>
                              <input type="hidden" value="" id="cartinfo">
                            </a>
                        </li>
                        @endif
                    </ul>

                </div>
                <ul class="nav navbar-nav float-right">

                    <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link"
                            id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"><i class="flag-icon flag-icon-us"></i><span
                                class="selected-language">English</span></a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#"
                                data-language="en"><i class="flag-icon flag-icon-us"></i> English</a><a
                                class="dropdown-item" href="#" data-language="fr"><i class="flag-icon flag-icon-fr"></i>
                                French</a><a class="dropdown-item" href="#" data-language="de"><i
                                    class="flag-icon flag-icon-de"></i> German</a><a class="dropdown-item" href="#"
                                data-language="pt"><i class="flag-icon flag-icon-pt"></i> Portuguese</a></div>
                    </li>
                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i
                                class="ficon feather icon-maximize"></i></a></li>
                    <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i
                                class="ficon feather icon-search"></i></a>
                        <div class="search-input">
                            <div class="search-input-icon"><i class="feather icon-search primary"></i></div>
                            <input class="input" type="text" placeholder="Explore Vuexy..." tabindex="-1"
                                data-search="template-list">
                            <div class="search-input-close"><i class="feather icon-x"></i></div>
                            <ul class="search-list search-list-main"></ul>
                        </div>
                    </li>
                    <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#"
                            data-toggle="dropdown"><i class="ficon feather icon-bell"></i><span
                                class="badge badge-pill badge-primary badge-up">5</span></a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <div class="dropdown-header m-0 p-2">
                                    <h3 class="white">5 New</h3><span class="notification-title">App
                                        Notifications</span>
                                </div>
                            </li>
                            <li class="scrollable-container media-list"><a class="d-flex justify-content-between"
                                    href="javascript:void(0)">
                                    <div class="media d-flex align-items-start">
                                        <div class="media-left"><i
                                                class="feather icon-plus-square font-medium-5 primary"></i></div>
                                        <div class="media-body">
                                            <h6 class="primary media-heading">You have new order!</h6><small
                                                class="notification-text"> Are your going to meet me tonight?</small>
                                        </div><small>
                                            <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">9 hours
                                                ago</time></small>
                                    </div>
                                </a><a class="d-flex justify-content-between" href="javascript:void(0)">
                                    <div class="media d-flex align-items-start">
                                        <div class="media-left"><i
                                                class="feather icon-download-cloud font-medium-5 success"></i></div>
                                        <div class="media-body">
                                            <h6 class="success media-heading red darken-1">99% Server load</h6><small
                                                class="notification-text">You got new order of goods.</small>
                                        </div><small>
                                            <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">5 hour
                                                ago</time></small>
                                    </div>
                                </a><a class="d-flex justify-content-between" href="javascript:void(0)">
                                    <div class="media d-flex align-items-start">
                                        <div class="media-left"><i
                                                class="feather icon-alert-triangle font-medium-5 danger"></i></div>
                                        <div class="media-body">
                                            <h6 class="danger media-heading yellow darken-3">Warning notifixation</h6>
                                            <small class="notification-text">Server have 99% CPU usage.</small>
                                        </div><small>
                                            <time class="media-meta"
                                                datetime="2015-06-11T18:29:20+08:00">Today</time></small>
                                    </div>
                                </a><a class="d-flex justify-content-between" href="javascript:void(0)">
                                    <div class="media d-flex align-items-start">
                                        <div class="media-left"><i
                                                class="feather icon-check-circle font-medium-5 info"></i></div>
                                        <div class="media-body">
                                            <h6 class="info media-heading">Complete the task</h6><small
                                                class="notification-text">Cake sesame snaps cupcake</small>
                                        </div><small>
                                            <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">Last
                                                week</time></small>
                                    </div>
                                </a><a class="d-flex justify-content-between" href="javascript:void(0)">
                                    <div class="media d-flex align-items-start">
                                        <div class="media-left"><i class="feather icon-file font-medium-5 warning"></i>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="warning media-heading">Generate monthly report</h6><small
                                                class="notification-text">Chocolate cake oat cake tiramisu
                                                marzipan</small>
                                        </div><small>
                                            <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">Last
                                                month</time></small>
                                    </div>
                                </a></li>
                            <li class="dropdown-menu-footer"><a class="dropdown-item p-1 text-center"
                                    href="javascript:void(0)">Read all notifications</a></li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link"
                            href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600">John
                                    Doe</span><span class="user-status">Available</span></div><span><img class="round"
                                    src="{{ asset('public/app-assets/images/portrait/small/avatar-s-11.jpg') }}"
                                    alt="avatar" height="40" width="40"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item"
                                href="page-user-profile.html"><i class="feather icon-user"></i> Edit Profile</a><a
                                class="dropdown-item" href="app-email.html"><i class="feather icon-mail"></i> My
                                Inbox</a><a class="dropdown-item" href="app-todo.html"><i
                                    class="feather icon-check-square"></i> Task</a><a class="dropdown-item"
                                href="app-chat.html"><i class="feather icon-message-square"></i> Chats</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item" href="auth-login.html"><i
                                    class="feather icon-power"></i> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<ul class="main-search-list-defaultlist d-none">
    <li class="d-flex align-items-center"><a class="pb-25" href="#">
            <h6 class="text-primary mb-0">Files</h6>
        </a></li>
    <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a
            class="d-flex align-items-center justify-content-between w-100" href="#">
            <div class="d-flex">
                <div class="mr-50"><img src="{{ asset('public/app-assets/images/icons/xls.png') }}" alt="png"
                        height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Two new item submitted</p><small class="text-muted">Marketing
                        Manager</small>
                </div>
            </div><small class="search-data-size mr-50 text-muted">&apos;17kb</small>
        </a></li>
    <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a
            class="d-flex align-items-center justify-content-between w-100" href="#">
            <div class="d-flex">
                <div class="mr-50"><img src="{{ asset('public/app-assets/images/icons/jpg.png') }}" alt="png"
                        height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">52 JPG file Generated</p><small class="text-muted">FontEnd
                        Developer</small>
                </div>
            </div><small class="search-data-size mr-50 text-muted">&apos;11kb</small>
        </a></li>
    <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a
            class="d-flex align-items-center justify-content-between w-100" href="#">
            <div class="d-flex">
                <div class="mr-50"><img src="{{ asset('public/app-assets/images/icons/pdf.png') }}" alt="png"
                        height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">25 PDF File Uploaded</p><small class="text-muted">Digital
                        Marketing Manager</small>
                </div>
            </div><small class="search-data-size mr-50 text-muted">&apos;150kb</small>
        </a></li>
    <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a
            class="d-flex align-items-center justify-content-between w-100" href="#">
            <div class="d-flex">
                <div class="mr-50"><img src="{{ asset('public/app-assets/images/icons/doc.png') }}" alt="png"
                        height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Anna_Strong</p><small class="text-muted">Web Designer</small>
                </div>
            </div><small class="search-data-size mr-50 text-muted">&apos;256kb</small>
        </a></li>
    <li class="d-flex align-items-center"><a class="pb-25" href="#">
            <h6 class="text-primary mb-0">Members</h6>
        </a></li>
    <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a
            class="d-flex align-items-center justify-content-between py-50 w-100" href="#">
            <div class="d-flex align-items-center">
                <div class="avatar mr-50"><img
                        src="{{ asset('public/app-assets/images/portrait/small/avatar-s-8.jpg') }}" alt="png"
                        height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">John Doe</p><small class="text-muted">UI designer</small>
                </div>
            </div>
        </a></li>
    <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a
            class="d-flex align-items-center justify-content-between py-50 w-100" href="#">
            <div class="d-flex align-items-center">
                <div class="avatar mr-50"><img
                        src="{{ asset('public/app-assets/images/portrait/small/avatar-s-1.jpg') }}" alt="png"
                        height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Michal Clark</p><small class="text-muted">FontEnd
                        Developer</small>
                </div>
            </div>
        </a></li>
    <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a
            class="d-flex align-items-center justify-content-between py-50 w-100" href="#">
            <div class="d-flex align-items-center">
                <div class="avatar mr-50"><img
                        src="{{ asset('public/app-assets/images/portrait/small/avatar-s-14.jpg') }}" alt="png"
                        height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Milena Gibson</p><small class="text-muted">Digital Marketing
                        Manager</small>
                </div>
            </div>
        </a></li>
    <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a
            class="d-flex align-items-center justify-content-between py-50 w-100" href="#">
            <div class="d-flex align-items-center">
                <div class="avatar mr-50"><img
                        src="{{ asset('public/app-assets/images/portrait/small/avatar-s-6.jpg') }}" alt="png"
                        height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Anna Strong</p><small class="text-muted">Web Designer</small>
                </div>
            </div>
        </a></li>
</ul>
<ul class="main-search-list-defaultlist-other-list d-none">
    <li class="auto-suggestion d-flex align-items-center justify-content-between cursor-pointer"><a
            class="d-flex align-items-center justify-content-between w-100 py-50">
            <div class="d-flex justify-content-start"><span class="mr-75 feather icon-alert-circle"></span><span>No
                    results found.</span></div>
        </a></li>
</ul>
<!-- END: Header-->
@yield('content')
    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light navbar-shadow">
        <p class="clearfix blue-grey lighten-2 mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2020<a class="text-bold-800 grey darken-2" href="https://1.envato.market/pixinvent_portfolio" target="_blank">Pixinvent,</a>All rights Reserved</span><span class="float-md-right d-none d-md-block">Hand-crafted & Made with<i class="feather icon-heart pink"></i></span>
            <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="feather icon-arrow-up"></i></button>
        </p>
    </footer>
    <!-- END: Footer-->
    <script src="<?php echo asset('public/app-assets/vendors/js/vendors.min.js'); ?> "></script>

    @yield('vendor-script')
    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('public/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('public/app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('public/app-assets/js/scripts/components.js') }}"></script>
    <!-- END: Theme JS-->
    @yield('page-script')









<script>
        var body = $("body");
          function layoutChange(element) {
            var $this = $(element);
            var currentLayout = $this.data("layout");
            body.removeClass("dark-layout semi-dark-layout").addClass(currentLayout);
            if (currentLayout === "") {
            //   mainMenu.removeClass("menu-dark").addClass("menu-light");
            //   navbar.removeClass("navbar-dark").addClass("navbar-light");
            }
          }
</script>
</body>
<!-- END: Body-->

</html>