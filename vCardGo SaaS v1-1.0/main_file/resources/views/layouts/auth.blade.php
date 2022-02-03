<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Purpose Application UI is the following chapter we've finished in order to create a complete and robust solution next to the already known Purpose Website UI.">
  <meta name="author" content="Webpixels">
  <title>@yield('page-title')</title>
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('assets/img/brand/favicon.png')}}" type="image/png">
  <!-- Font Awesome 5 -->
  <link rel="stylesheet" href="{{ asset('assets/libs/@fortawesome/fontawesome-free/css/all.min.css')}}"><!-- Purpose CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/purpose.css')}}" id="stylesheet">
</head>

<body class="application application-offset">
  <!-- Chat modal -->
  <!-- Customizer modal -->
  <!-- Application container -->
  <div class="container-fluid container-application">
    <!-- Sidenav -->
    <!-- Content -->
    <div class="main-content position-relative">
      <!-- Main nav -->
      <!-- Omnisearch -->
      <div id="omnisearch" class="omnisearch">
        <div class="container">
          <!-- Search form -->
          <form class="omnisearch-form">
            <div class="form-group">
              <div class="input-group input-group-merge input-group-flush">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Type and hit enter ...">
              </div>
            </div>
          </form>
          <div class="omnisearch-suggestions">
            <h6 class="heading">Search Suggestions</h6>
            <div class="row">
              <div class="col-sm-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a class="list-link" href="#">
                      <i class="fas fa-search"></i>
                      <span>macbook pro</span> in Laptops
                    </a>
                  </li>
                  <li>
                    <a class="list-link" href="#">
                      <i class="fas fa-search"></i>
                      <span>iphone 8</span> in Smartphones
                    </a>
                  </li>
                  <li>
                    <a class="list-link" href="#">
                      <i class="fas fa-search"></i>
                      <span>macbook pro</span> in Laptops
                    </a>
                  </li>
                  <li>
                    <a class="list-link" href="#">
                      <i class="fas fa-search"></i>
                      <span>beats pro solo 3</span> in Headphones
                    </a>
                  </li>
                  <li>
                    <a class="list-link" href="#">
                      <i class="fas fa-search"></i>
                      <span>smasung galaxy 10</span> in Phones
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Page content -->
      <div class="page-content">
        <div class="min-vh-100 py-5 d-flex align-items-center">
          @yield('content')
        </div>
      </div>
      <!-- Footer -->
    </div>
  </div>
  <!-- Scripts -->
  <!-- Core JS - includes jquery, bootstrap, popper, in-view and sticky-kit -->
  <script src="{{ asset('assets/js/purpose.core.js')}}"></script>
  <!-- Purpose JS -->
  <script src="{{ asset('assets/js/purpose.js')}}"></script>
  <!-- Demo JS - remove it when starting your project -->
  <script src="{{ asset('assets/js/demo.js')}}"></script>

</body>

</html>