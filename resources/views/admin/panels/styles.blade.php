<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600">
<link rel="stylesheet" href="{{ asset('public/vendors/css/vendors.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/vendors/css/ui/prism.min.css') }}">
{{-- Vendor Styles --}}
@yield('vendor-style')
{{-- Theme Styles --}}
<link rel="stylesheet" href="{{ asset('public/css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/bootstrap-extended.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/colors.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/components.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/themes/dark-layout.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/themes/semi-dark-layout.css') }}">
{{-- {!! Helper::applClasses() !!} --}}
@php
$configData = Helper::applClasses();
@endphp

{{-- Layout Styles works when don't use customizer --}}

{{-- @if($configData['theme'] == 'dark-layout')
        <link rel="stylesheet" href="{{ asset('public/css/themes/dark-layout.css') }}">
@endif
@if($configData['theme'] == 'semi-dark-layout')
<link rel="stylesheet" href="{{ asset('public/css/themes/semi-dark-layout.css') }}">
@endif --}}
{{-- Page Styles --}}
@if($configData['mainLayoutType'] === 'horizontal')
<link rel="stylesheet" href="{{ asset('public/css/core/menu/menu-types/horizontal-menu.css') }}">
@endif
<!-- <link rel="stylesheet" href="{{ asset('public/css/core/menu/menu-types/vertical-menu.css') }}"> -->
<link rel="stylesheet" href="{{ asset('public/css/core/colors/palette-gradient.css') }}">
{{-- Page Styles --}}
@yield('page-style')
{{-- Laravel Style --}}
<link rel="stylesheet" href="{{ asset('public/css/custom-laravel.css') }}">
{{-- Custom RTL Styles --}}
@if($configData['direction'] === 'rtl' && isset($configData['direction']))
<link rel="stylesheet" href="{{ asset('public/css/custom-rtl.css') }}">
@endif
