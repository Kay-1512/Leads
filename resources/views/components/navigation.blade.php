<div class="bg-primary-darker">
          <div class="bg-black-10">
            <div class="content py-3">
              <!-- Toggle Main Navigation -->
              <div class="d-lg-none">
                <!-- Class Toggle, functionality initialized in Helpers.oneToggleClass() -->
                <button type="button" class="btn w-100 btn-alt-secondary d-flex justify-content-between align-items-center" data-toggle="class-toggle" data-target="#main-navigation" data-class="d-none">
                  Menu
                  <i class="fa fa-bars"></i>
                </button>
              </div>
              <!-- END Toggle Main Navigation -->

              <!-- Main Navigation -->
              <div id="main-navigation" class="d-none d-lg-block mt-2 mt-lg-0">
                <ul class="nav-main nav-main-dark nav-main-horizontal nav-main-hover">
                  <li class="nav-main-item">
                    <a class="nav-main-link active" href="{{route("leads")}}">
                      <i class="nav-main-link-icon si si-compass"></i>
                      <span class="nav-main-link-name">Leads</span>
                    </a>
                  </li>

                  <li class="nav-main-item">
                    <a class="nav-main-link active" href="bd_dashboard.html">
                      <i class="nav-main-link-icon si si-compass"></i>
                      <span class="nav-main-link-name">New Lead</span>
                    </a>
                  </li>

                  @role('Admin')
                  <li class="nav-main-item">
                    <a class="nav-main-link active" href="{{ route('user.create')}}">
                      <i class="nav-main-link-icon si si-compass"></i>
                      <span class="nav-main-link-name">New User</span>
                    </a>
                  </li>
                  @endrole
                </ul>
              </div>
              <!-- END Main Navigation -->
            </div>
          </div>
        </div>