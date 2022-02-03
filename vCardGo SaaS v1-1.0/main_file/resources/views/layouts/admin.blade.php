<!DOCTYPE html>
<html lang="en">
<meta name="csrf-token" content="{{ csrf_token() }}">
@include('partials.admin.header')
<body class="application application-offset">
<div class="container-fluid container-application">
  <!-- Sidenav -->
  @include('partials.admin.sidemenu')
  <!-- Content -->
  <div class="main-content position-relative">
    <!-- Main nav -->
   @include('partials.admin.menu')
    <!-- Page content -->
    <div class="page-content">
      @yield('content')
      <!-- Page title -->
      
    </div>
    <!-- Footer -->
    <!-- <div class="footer pt-5 pb-4 footer-light" id="footer-main">
      <div class="row text-center text-sm-left align-items-sm-center">
        <div class="col-sm-6">
          <p class="text-sm mb-0">&copy; 2019 <a href="https://webpixels.io" class="h6 text-sm" target="_blank">Webpixels</a>. All rights reserved.</p>
        </div>
      </div>
    </div> -->
  </div>
</div>

<div class="modal fade" id="commonModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div>
        <h4 class="h4 font-weight-400 float-left modal-title"></h4>
        <a href="#" class="more-text widget-text float-right close-icon" data-dismiss="modal" aria-label="close">{{__('Close')}}</a>
      </div>
      <div class="modal-body">
        
      </div>
    </div>
  </div>
</div>
<!-- Scripts -->
@include('partials.admin.footer')

</body>

</html>