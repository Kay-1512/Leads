<header class="topbar">
  {{-- Mobile Header --}}
  <div class="with-vertical">
    <!-- ---------------------------------- -->
    <!-- Start Vertical Layout Header -->
    <!-- ---------------------------------- -->
    <nav class="navbar navbar-expand-lg p-0">
      <ul class="navbar-nav">
        <li class="nav-item nav-icon-hover-bg rounded-circle ms-n2">
          <a class="nav-link sidebartoggler" id="headerCollapse" href="javascript:void(0)">
            <i class="ti ti-menu-2"></i>
          </a>
        </li>
        <li class="nav-item nav-icon-hover-bg rounded-circle d-none d-lg-flex">
          <a class="nav-link" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="ti ti-search"></i>
          </a>
        </li>
      </ul>

      <ul class="navbar-nav quick-links d-none d-lg-flex align-items-center">
        <li class="nav-item dropdown-hover d-none d-lg-block">
          <a class="nav-link" href="{{ route('/') }}">Home</a>
        </li>
      </ul>

      <div class="d-block d-lg-none py-4">
        <a href="{{ route('/') }}" class="text-nowrap logo-img">
          {{-- <img src="../assets/images/logos/dark-logo.svg" class="dark-logo" alt="Logo-Dark" />
          <img src="../assets/images/logos/light-logo.svg" class="light-logo" alt="Logo-light" /> --}}
        </a>
      </div>
      <a class="navbar-toggler nav-icon-hover-bg rounded-circle p-0 mx-0 border-0" href="javascript:void(0)"
        data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
        aria-label="Toggle navigation">
        <i class="ti ti-dots fs-7"></i>
      </a>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <div class="d-flex align-items-center justify-content-between">
          <a href="javascript:void(0)"
            class="nav-link nav-icon-hover-bg rounded-circle mx-0 ms-n1 d-flex d-lg-none align-items-center justify-content-center"
            type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar"
            aria-controls="offcanvasWithBothOptions">
            <i class="ti ti-align-justified fs-7"></i>
          </a>
          <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
            <li class="nav-item nav-icon-hover-bg rounded-circle">
              <a class="nav-link moon dark-layout" href="javascript:void(0)">
                <i class="ti ti-moon moon"></i>
              </a>
              <a class="nav-link sun light-layout" href="javascript:void(0)">
                <i class="ti ti-sun sun"></i>
              </a>
            </li>

            <!-- ------------------------------- -->
            <!-- start profile Dropdown -->
            <!-- ------------------------------- -->
            <li class="nav-item dropdown">
              <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" aria-expanded="false">
                <div class="d-flex align-items-center">
                  <div class="user-profile-img">
                    <img src="../assets/images/profile/user-1.jpg" class="rounded-circle" width="35" height="35"
                      alt="modernize-img" />
                  </div>
                </div>
              </a>
              <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
                <div class="profile-dropdown position-relative" data-simplebar>
                  <div class="py-3 px-7 pb-0">
                    <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                  </div>
                  <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                    <img src="../assets/images/profile/user-1.jpg" class="rounded-circle" width="80" height="80"
                      alt="modernize-img" />
                    <div class="ms-3">
                      <h5 class="mb-1 fs-3">{{ auth()->user()->first_name }}</h5>
                      <span class="mb-1 d-block">Designer</span>
                      <p class="mb-0 d-flex align-items-center gap-2">
                        <i class="ti ti-mail fs-4"></i> info@modernize.com
                      </p>
                    </div>
                  </div>
                  <div class="message-body">
                    <a href="../horizontal/page-user-profile.html" class="py-8 px-7 mt-8 d-flex align-items-center">
                      <span class="d-flex align-items-center justify-content-center text-bg-light rounded-1 p-6">
                        <img src="../assets/images/svgs/icon-account.svg" alt="modernize-img" width="24" height="24" />
                      </span>
                      <div class="w-100 ps-3">
                        <h6 class="mb-1 fs-3 fw-semibold lh-base">My Profile</h6>
                        <span class="fs-2 d-block text-body-secondary">Account Settings</span>
                      </div>
                    </a>
                    <a href="../horizontal/app-email.html" class="py-8 px-7 d-flex align-items-center">
                      <span class="d-flex align-items-center justify-content-center text-bg-light rounded-1 p-6">
                        <img src="../assets/images/svgs/icon-inbox.svg" alt="modernize-img" width="24" height="24" />
                      </span>
                      <div class="w-100 ps-3">
                        <h6 class="mb-1 fs-3 fw-semibold lh-base">My Inbox</h6>
                        <span class="fs-2 d-block text-body-secondary">Messages & Emails</span>
                      </div>
                    </a>
                    <a href="../horizontal/app-notes.html" class="py-8 px-7 d-flex align-items-center">
                      <span class="d-flex align-items-center justify-content-center text-bg-light rounded-1 p-6">
                        <img src="../assets/images/svgs/icon-tasks.svg" alt="modernize-img" width="24" height="24" />
                      </span>
                      <div class="w-100 ps-3">
                        <h6 class="mb-1 fs-3 fw-semibold lh-base">My Task</h6>
                        <span class="fs-2 d-block text-body-secondary">To-do and Daily Tasks</span>
                      </div>
                    </a>
                  </div>
                  <div class="d-grid py-4 px-7 pt-8">
                    <div class="upgrade-plan bg-primary-subtle position-relative overflow-hidden rounded-4 p-4 mb-9">
                      <div class="row">
                        <div class="col-6">
                          <h5 class="fs-4 mb-3 fw-semibold">Unlimited Access</h5>
                          <button class="btn btn-primary">Upgrade</button>
                        </div>
                        <div class="col-6">
                          <div class="m-n4 unlimited-img">
                            <img src="../assets/images/backgrounds/unlimited-bg.png" alt="modernize-img"
                              class="w-100" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <a href="javascript:void();" onclick="document.getElementById('logout-form').submit();"
                      class="btn btn-outline-primary">Log Out</a>
                  </div>
                </div>
              </div>
            </li>
            <!-- ------------------------------- -->
            <!-- end profile Dropdown -->
            <!-- ------------------------------- -->
          </ul>
        </div>
      </div>
    </nav>
    <!-- ---------------------------------- -->
    <!-- End Vertical Layout Header -->
    <!-- ---------------------------------- -->

    <!-- ------------------------------- -->
    <!-- apps Dropdown in Small screen -->
    <!-- ------------------------------- -->
    <!--  Mobilenavbar -->
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="mobilenavbar"
      aria-labelledby="offcanvasWithBothOptionsLabel">
      <nav class="sidebar-nav scroll-sidebar">
        <div class="offcanvas-header justify-content-between">
          <img src="../assets/images/logos/favicon.ico" alt="modernize-img" class="img-fluid" />
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body h-n80" data-simplebar="" data-simplebar>
          <ul id="sidebarnav">
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                <span>
                  <i class="ti ti-apps"></i>
                </span>
                <span class="hide-menu">Apps</span>
              </a>
              <ul aria-expanded="false" class="collapse first-level my-3">
                <li class="sidebar-item py-2">
                  <a href="../horizontal/app-chat.html" class="d-flex align-items-center">
                    <div class="text-bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                      <img src="../assets/images/svgs/icon-dd-chat.svg" alt="modernize-img" class="img-fluid" width="24"
                        height="24" />
                    </div>
                    <div>
                      <h6 class="mb-1 bg-hover-primary">Chat Application</h6>
                      <span class="fs-2 d-block text-muted">New messages arrived</span>
                    </div>
                  </a>
                </li>
                <li class="sidebar-item py-2">
                  <a href="../horizontal/app-invoice.html" class="d-flex align-items-center">
                    <div class="text-bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                      <img src="../assets/images/svgs/icon-dd-invoice.svg" alt="modernize-img" class="img-fluid"
                        width="24" height="24" />
                    </div>
                    <div>
                      <h6 class="mb-1 bg-hover-primary">Invoice App</h6>
                      <span class="fs-2 d-block text-muted">Get latest invoice</span>
                    </div>
                  </a>
                </li>
                <li class="sidebar-item py-2">
                  <a href="../horizontal/app-cotact.html" class="d-flex align-items-center">
                    <div class="text-bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                      <img src="../assets/images/svgs/icon-dd-mobile.svg" alt="modernize-img" class="img-fluid"
                        width="24" height="24" />
                    </div>
                    <div>
                      <h6 class="mb-1 bg-hover-primary">Contact Application</h6>
                      <span class="fs-2 d-block text-muted">2 Unsaved Contacts</span>
                    </div>
                  </a>
                </li>
                <li class="sidebar-item py-2">
                  <a href="../horizontal/app-email.html" class="d-flex align-items-center">
                    <div class="text-bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                      <img src="../assets/images/svgs/icon-dd-message-box.svg" alt="modernize-img" class="img-fluid"
                        width="24" height="24" />
                    </div>
                    <div>
                      <h6 class="mb-1 bg-hover-primary">Email App</h6>
                      <span class="fs-2 d-block text-muted">Get new emails</span>
                    </div>
                  </a>
                </li>
                <li class="sidebar-item py-2">
                  <a href="../horizontal/page-user-profile.html" class="d-flex align-items-center">
                    <div class="text-bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                      <img src="../assets/images/svgs/icon-dd-cart.svg" alt="modernize-img" class="img-fluid" width="24"
                        height="24" />
                    </div>
                    <div>
                      <h6 class="mb-1 bg-hover-primary">User Profile</h6>
                      <span class="fs-2 d-block text-muted">learn more information</span>
                    </div>
                  </a>
                </li>
                <li class="sidebar-item py-2">
                  <a href="../horizontal/app-calendar.html" class="d-flex align-items-center">
                    <div class="text-bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                      <img src="../assets/images/svgs/icon-dd-date.svg" alt="modernize-img" class="img-fluid" width="24"
                        height="24" />
                    </div>
                    <div>
                      <h6 class="mb-1 bg-hover-primary">Calendar App</h6>
                      <span class="fs-2 d-block text-muted">Get dates</span>
                    </div>
                  </a>
                </li>
                <li class="sidebar-item py-2">
                  <a href="../horizontal/app-contact2.html" class="d-flex align-items-center">
                    <div class="text-bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                      <img src="../assets/images/svgs/icon-dd-lifebuoy.svg" alt="modernize-img" class="img-fluid"
                        width="24" height="24" />
                    </div>
                    <div>
                      <h6 class="mb-1 bg-hover-primary">Contact List Table</h6>
                      <span class="fs-2 d-block text-muted">Add new contact</span>
                    </div>
                  </a>
                </li>
                <li class="sidebar-item py-2">
                  <a href="../horizontal/app-notes.html" class="d-flex align-items-center">
                    <div class="text-bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                      <img src="../assets/images/svgs/icon-dd-application.svg" alt="modernize-img" class="img-fluid"
                        width="24" height="24" />
                    </div>
                    <div>
                      <h6 class="mb-1 bg-hover-primary">Notes Application</h6>
                      <span class="fs-2 d-block text-muted">To-do and Daily tasks</span>
                    </div>
                  </a>
                </li>
                <ul class="px-8 mt-7 mb-4">
                  <li class="sidebar-item mb-3">
                    <h5 class="fs-5 fw-semibold">Quick Links</h5>
                  </li>
                  <li class="sidebar-item py-2">
                    <a class="fw-semibold text-dark" href="../horizontal/page-pricing.html">Pricing Page</a>
                  </li>
                  <li class="sidebar-item py-2">
                    <a class="fw-semibold text-dark" href="../horizontal/authentication-login.html">Authentication
                      Design</a>
                  </li>
                  <li class="sidebar-item py-2">
                    <a class="fw-semibold text-dark" href="../horizontal/authentication-register.html">Register
                      Now</a>
                  </li>
                  <li class="sidebar-item py-2">
                    <a class="fw-semibold text-dark" href="../horizontal/authentication-error.html">404 Error
                      Page</a>
                  </li>
                  <li class="sidebar-item py-2">
                    <a class="fw-semibold text-dark" href="../horizontal/app-notes.html">Notes App</a>
                  </li>
                  <li class="sidebar-item py-2">
                    <a class="fw-semibold text-dark" href="../horizontal/page-user-profile.html">User
                      Application</a>
                  </li>
                  <li class="sidebar-item py-2">
                    <a class="fw-semibold text-dark" href="../horizontal/page-account-settings.html">Account
                      Settings</a>
                  </li>
                </ul>
              </ul>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../horizontal/app-chat.html" aria-expanded="false">
                <span>
                  <i class="ti ti-message-dots"></i>
                </span>
                <span class="hide-menu">Chat</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../horizontal/app-calendar.html" aria-expanded="false">
                <span>
                  <i class="ti ti-calendar"></i>
                </span>
                <span class="hide-menu">Calendar</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../horizontal/app-email.html" aria-expanded="false">
                <span>
                  <i class="ti ti-mail"></i>
                </span>
                <span class="hide-menu">Email</span>
              </a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>


  {{-- Main Header --}}
  <div class="app-header with-horizontal">
    <nav class="navbar navbar-expand-xl container-fluid p-0">
      <ul class="navbar-nav align-items-center">
        <li class="nav-item nav-icon-hover-bg rounded-circle d-flex d-xl-none ms-n2">
          <a class="nav-link sidebartoggler" id="sidebarCollapse" href="javascript:void(0)">
            <i class="ti ti-menu-2"></i>
          </a>
        </li>
        <li class="nav-item d-none d-xl-block">
          <a href="{{ route('/') }}" class="text-nowrap nav-link">
            <img src="{{ asset('assets/images/logo-dark.png') }}" class="dark-logo" height="80" alt="SP Portal" />
            <img src="{{ asset('assets/images/logo-ligh.png') }}" class="light-logo" height="80" alt="SP Portal" />
          </a>
        </li>
        <li class="nav-item nav-icon-hover-bg rounded-circle d-none d-xl-flex">
          <a class="nav-link" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="ti ti-search"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav quick-links d-none d-xl-flex align-items-center">
        <li class="nav-item dropdown-hover d-none d-lg-block">
          <a class="nav-link" href="{{ route('/') }}">Home</a>
        </li>

        <li class="nav-item dropdown-hover d-none d-lg-block">
          <a class="nav-link" href="{{ route('clients') }}">Clients</a>
        </li>
      </ul>
      <div class="d-block d-xl-none">
        <a href="{{ route('/') }}" class="text-nowrap nav-link">
          <img src="{{ asset('assets/images/logo-dark.svg') }}" class="dark-logo" height="80" alt="SP Portal" />
          <img src="{{ asset('assets/images/logo-ligh.svg') }}" class="light-logo" height="80" alt="SP Portal" />
        </a>
      </div>
      <a class="navbar-toggler nav-icon-hover-bg rounded-circle p-0 mx-0 border-0" href="javascript:void(0)"
        data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="p-2">
          <i class="ti ti-dots fs-7"></i>
        </span>
      </a>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <div class="d-flex align-items-center justify-content-between px-0 px-xl-8">
          <a href="javascript:void(0)"
            class="nav-link round-40 p-1 ps-0 d-flex d-xl-none align-items-center justify-content-center" type="button"
            data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar" aria-controls="offcanvasWithBothOptions">
            <i class="ti ti-align-justified fs-7"></i>
          </a>
          <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">

            <!-- ------------------------------- -->
            <!-- start profile Dropdown -->
            <!-- ------------------------------- -->
            <li class="nav-item dropdown">
              <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" aria-expanded="false">
                <div class="d-flex align-items-center">
                  <div class="user-profile-img">
                    <img src="{{ asset('assets/images/profile/user-1.jpg') }}" class="rounded-circle" width="35"
                      height="35" alt="SP Portal" />
                  </div>
                </div>
              </a>
              <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
                <div class="profile-dropdown position-relative" data-simplebar>
                  <div class="py-3 px-7 pb-0">
                    <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                  </div>
                  <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                    <img src="{{ asset('assets/images/profile/user-1.jpg') }}" class="rounded-circle" width="80"
                      height="80" alt="modernize-img" />
                    <div class="ms-3">
                      <h5 class="mb-1 fs-3">{{ auth()->user()->first_name}}</h5>
                      <span class="mb-1 d-block">{{ auth()->user()->getRoleNames()->first() }}</span>
                      <p class="mb-0 d-flex align-items-center gap-2">
                        <i class="ti ti-mail fs-4"></i> {{ auth()->user()->email}}
                      </p>
                    </div>
                  </div>
                  <div class="message-body">
                    <a href="../horizontal/page-user-profile.html" class="py-8 px-7 mt-8 d-flex align-items-center">
                      <span class="d-flex align-items-center justify-content-center text-bg-light rounded-1 p-6">
                        <img src="../assets/images/svgs/icon-account.svg" alt="modernize-img" width="24" height="24" />
                      </span>
                      <div class="w-100 ps-3">
                        <h6 class="mb-1 fs-3 fw-semibold lh-base">My Profile</h6>
                        <span class="fs-2 d-block text-body-secondary">Account Settings</span>
                      </div>
                    </a>
                    <a href="../horizontal/app-email.html" class="py-8 px-7 d-flex align-items-center">
                      <span class="d-flex align-items-center justify-content-center text-bg-light rounded-1 p-6">
                        <img src="../assets/images/svgs/icon-inbox.svg" alt="modernize-img" width="24" height="24" />
                      </span>
                      <div class="w-100 ps-3">
                        <h6 class="mb-1 fs-3 fw-semibold lh-base">My Inbox</h6>
                        <span class="fs-2 d-block text-body-secondary">Messages & Emails</span>
                      </div>
                    </a>
                    <a href="../horizontal/app-notes.html" class="py-8 px-7 d-flex align-items-center">
                      <span class="d-flex align-items-center justify-content-center text-bg-light rounded-1 p-6">
                        <img src="../assets/images/svgs/icon-tasks.svg" alt="modernize-img" width="24" height="24" />
                      </span>
                      <div class="w-100 ps-3">
                        <h6 class="mb-1 fs-3 fw-semibold lh-base">My Task</h6>
                        <span class="fs-2 d-block text-body-secondary">To-do and Daily Tasks</span>
                      </div>
                    </a>
                  </div>
                  <div class="d-grid py-4 px-7 pt-8">

                    <a href="javascript:void();" onclick="document.getElementById('logout-form').submit();"
                      class="btn btn-outline-primary">Log Out</a>
                  </div>
                </div>
              </div>
            </li>
            <!-- ------------------------------- -->
            <!-- end profile Dropdown -->
            <!-- ------------------------------- -->
          </ul>
        </div>
      </div>
    </nav>
  </div>

  <form method="post" action="{{ route('logout') }}" id="logout-form" style="display: none">
    @csrf
  </form>
</header>