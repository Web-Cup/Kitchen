<body
class="horizontal-layout horizontal-menu test 2-columns navbar-floating footer-static  menu-expanded pace-done" data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
  {{-- Include Sidebar --}}
  @include('admin.panels.sidebar')
    {{-- Include Navbar --}}
    @include('admin.panels.navbar')
  <!-- BEGIN: Content-->
  <div class="app-content content">
    <!-- BEGIN: Header-->
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>



    @if(($configData['contentLayout']!=='default') && isset($configData['contentLayout']))
    
    @else
    <div class="content-wrapper">
      <div class="content-body">
        {{-- Include Page Content --}}
        @yield('content')
      </div>
    </div>
    @endif

  </div>
  <!-- End: Content-->


  <div class="sidenav-overlay"></div>
  <div class="drag-target"></div>

  {{-- include footer --}}
  @include('admin/panels/footer')

  {{-- include default scripts --}}
  @include('admin/panels/scripts')

</body>

</html>
