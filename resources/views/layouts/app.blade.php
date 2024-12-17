<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="dark" data-color-theme="Blue_Theme" data-layout="horizontal">

<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>

  <link rel="shortcut icon" type="image/png" href="" />
  <!-- Core Css -->
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />

  <!-- Owl Carousel  -->
  <link rel="stylesheet" href="{{ asset('assets/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
</head>

<body>
  {{-- <div class="toast toast-onload align-items-center text-bg-primary border-0" role="alert" aria-live="assertive"
    aria-atomic="true">
    <div class="toast-body hstack align-items-start gap-6">
      <i class="ti ti-alert-circle fs-6"></i>
      <div>
        <h5 class="text-white fs-3 mb-1">Welcome to SP Portal</h5>
        <h6 class="text-white fs-2 mb-0">Simple Leads and Project Management</h6>
      </div>
      <button type="button" class="btn-close btn-close-white fs-2 m-0 ms-auto shadow-none" data-bs-dismiss="toast"
        aria-label="Close"></button>
    </div>
  </div> --}}
  <!-- Preloader -->
  <div class="preloader">
    <img src="" alt="loader" class="lds-ripple img-fluid" />
  </div>
  <div id="main-wrapper">
    <!-- Mobile Menu -->
    {{-- @include('components.aside') --}}

    <div class="page-wrapper">
      @include('components.header')

      <div class="body-wrapper">
        <div class="container-fluid">
          @yield('content')
        </div>
      </div>
      <script>
        function handleColorTheme(e) {
          document.documentElement.setAttribute("data-color-theme", e);
        }
      </script>


    </div>

    <!--  Search Bar -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content rounded-1">
          <div class="modal-header border-bottom">
            <input type="search" class="form-control fs-3" placeholder="Search here" id="search" />
            <a href="javascript:void(0)" data-bs-dismiss="modal" class="lh-1">
              <i class="ti ti-x fs-5 ms-3"></i>
            </a>
          </div>
          <div class="modal-body message-body" data-simplebar="">
            <h5 class="mb-0 fs-5 p-1">Quick Page Links</h5>
            <ul class="list mb-0 py-2">
              <li class="p-1 mb-1 bg-hover-light-black">
                <a href="javascript:void(0)">
                  <span class="d-block">Modern</span>
                  <span class="text-muted d-block">/dashboards/dashboard1</span>
                </a>
              </li>
              <li class="p-1 mb-1 bg-hover-light-black">
                <a href="javascript:void(0)">
                  <span class="d-block">Dashboard</span>
                  <span class="text-muted d-block">/dashboards/dashboard2</span>
                </a>
              </li>
              <li class="p-1 mb-1 bg-hover-light-black">
                <a href="javascript:void(0)">
                  <span class="d-block">Contacts</span>
                  <span class="text-muted d-block">/apps/contacts</span>
                </a>
              </li>
              <li class="p-1 mb-1 bg-hover-light-black">
                <a href="javascript:void(0)">
                  <span class="d-block">Posts</span>
                  <span class="text-muted d-block">/apps/blog/posts</span>
                </a>
              </li>
              <li class="p-1 mb-1 bg-hover-light-black">
                <a href="javascript:void(0)">
                  <span class="d-block">Detail</span>
                  <span
                    class="text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
                </a>
              </li>
              <li class="p-1 mb-1 bg-hover-light-black">
                <a href="javascript:void(0)">
                  <span class="d-block">Shop</span>
                  <span class="text-muted d-block">/apps/ecommerce/shop</span>
                </a>
              </li>
              <li class="p-1 mb-1 bg-hover-light-black">
                <a href="javascript:void(0)">
                  <span class="d-block">Modern</span>
                  <span class="text-muted d-block">/dashboards/dashboard1</span>
                </a>
              </li>
              <li class="p-1 mb-1 bg-hover-light-black">
                <a href="javascript:void(0)">
                  <span class="d-block">Dashboard</span>
                  <span class="text-muted d-block">/dashboards/dashboard2</span>
                </a>
              </li>
              <li class="p-1 mb-1 bg-hover-light-black">
                <a href="javascript:void(0)">
                  <span class="d-block">Contacts</span>
                  <span class="text-muted d-block">/apps/contacts</span>
                </a>
              </li>
              <li class="p-1 mb-1 bg-hover-light-black">
                <a href="javascript:void(0)">
                  <span class="d-block">Posts</span>
                  <span class="text-muted d-block">/apps/blog/posts</span>
                </a>
              </li>
              <li class="p-1 mb-1 bg-hover-light-black">
                <a href="javascript:void(0)">
                  <span class="d-block">Detail</span>
                  <span
                    class="text-muted d-block">/apps/blog/detail/streaming-video-way-before-it-was-cool-go-dark-tomorrow</span>
                </a>
              </li>
              <li class="p-1 mb-1 bg-hover-light-black">
                <a href="javascript:void(0)">
                  <span class="d-block">Shop</span>
                  <span class="text-muted d-block">/apps/ecommerce/shop</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="dark-transparent sidebartoggler"></div>

  <div class="container-fluid footer p-0 mt-4 mb-4">
    <footer class="pt-4 pb-4">
      &copy; 2025 Skills Panda. All rights reserved
    </footer>
  </div>
  <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
  <!-- Import Js Files -->
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
  <script src="{{ asset('assets/js/theme/app.horizontal.init.js') }}"></script>
  <script src="{{ asset('assets/js/theme/theme.js') }}"></script>
  <script src="{{ asset('assets/js/theme/app.min.js') }}"></script>
  <script src="{{ asset('assets/js/theme/sidebarmenu.js') }}"></script>

  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
  <script src="{{ asset('assets/libs/owl.carousel/dist/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/js/dashboards/dashboard.js') }}"></script>

</body>

</html>