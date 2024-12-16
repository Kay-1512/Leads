<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" data-bs-theme="light"
  data-color-theme="Blue_Theme" data-layout="horizontal">

<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Favicon icon-->
  <link rel="shortcut icon" type="image/png" href="" />

  <!-- Core Css -->
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />

  <title>SP Portal</title>

  <style>
    .card {
      border-radius: 15px;
    }
  </style>
</head>

<body>
  <!-- Preloader -->
  <div class="preloader">
    <img src="" alt="loader" class="lds-ripple img-fluid" />
  </div>
  <div id="main-wrapper" class="auth-customizer-none">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 w-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <a href="{{ route('/') }}" class="text-nowrap logo-img text-center d-block mb-5 w-100">
            <img src="{{ asset('assets/images/logo-dark.png') }}" class="dark-logo" height="80" alt="SP Portal" />
            <img src="{{ asset('assets/images/logo-ligh.png') }}" class="light-logo" height="80" alt="SP Portal" />
          </a>
          <div class="col-md-8 col-lg-6 col-xxl-3 auth-card">
            <div class="card mb-0">
              <div class="card-body">
                <div class="position-relative text-center my-4">
                  @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                  @endif
                  {{-- <p class="mb-0 fs-4 px-3 d-inline-block bg-body text-dark z-index-5 position-relative">or sign in
                    with
                  </p>
                  <span class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span> --}}
                </div>

                <form action="{{ route('login') }}" method="POST">
                  @csrf
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                  </div>
                  <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Remeber this Device
                      </label>
                    </div>
                    <a class="text-primary fw-medium" href="#">Forgot
                      Password?</a>
                  </div>

                  <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign In</button>
                  {{-- <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-medium">New to SP Portal?</p>
                    <a class="text-primary fw-medium ms-2" href="#">Create an
                      account</a>
                  </div> --}}
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="dark-transparent sidebartoggler"></div>
  <!-- Import Js Files -->
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
  <script src="{{ asset('assets/js/theme/app.horizontal.init.js') }}"></script>
  <script src="{{ asset('assets/js/theme/theme.js') }}"></script>
  <script src="{{ asset('assets/js/theme/app.min.js') }}"></script>

  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>