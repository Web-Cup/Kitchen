{{-- Vendor Scripts --}}
<script src="{{ asset('public/vendors/js/vendors.min.js') }}"></script>
<script src="{{ asset('public/vendors/js/ui/prism.min.js') }}"></script>
@yield('vendor-script')
{{-- Theme Scripts --}}
<script src="{{ asset('public/js/core/app-menu.js') }}"></script>
<!-- <script src="{{ asset('public/js/core/app.js') }}"></script> -->
<script src="{{ asset('public/js/scripts/components.js') }}"></script>
@if($configData['blankPage'] == false)
<script src="{{ asset('public/js/scripts/customizer.js') }}"></script>
<script src="{{ asset('public/js/scripts/footer.js') }}"></script>
@endif
{{-- page script --}}
@yield('page-script')
{{-- page script --}}
