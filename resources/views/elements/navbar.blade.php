  <!-- Nav Bar -->
  <div class="iq-top-navbar">
      <div class="iq-navbar-custom">
          <nav class="navbar navbar-expand-lg navbar-light p-0">
              <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                  <i class="ri-menu-line wrapper-menu"></i>
                  <a href="/logistic-backend/index.html" class="header-logo">
                      <img src="/logistic-assets/images/logo2.png" class="img-fluid " alt="logo">
                      <h5 class="logo-title2 text-osave ml-1 font-weight-900">save</h5>

                  </a>
              </div>
              <div class="iq-search-bar device-search">
              </div>
              <div class="d-flex align-items-center">
                  <button class="navbar-toggler" type="button" data-toggle="collapse"
                      data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                      aria-label="Toggle navigation">
                      <i class="ri-menu-3-line"></i>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav ml-auto navbar-list align-items-center">
                          <li class="nav-item nav-icon dropdown">
                              <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton2"
                                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <span class="bg-primary"></span>
                              </a>

                          </li>
                          <!-- Notification -->
                          <li class="nav-item nav-icon dropdown">
                              <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton"
                                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                      viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                      stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                                      <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                      <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                  </svg>
                                  <span class="bg-primary "></span>
                              </a>
                              <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <div class="card shadow-none m-0">
                                      <div class="card-body p-0 ">
                                          <div class="cust-title p-3">
                                              <div class="d-flex align-items-center justify-content-between">
                                                  <h5 class="mb-0">Notifications</h5>
                                                  <a class="badge badge-primary badge-card" href="#">3</a>
                                              </div>
                                          </div>
                                          <div class="px-3 pt-0 pb-0 sub-card">
                                              <a href="#" class="iq-sub-card">
                                                  <div class="media align-items-center cust-card py-3 border-bottom">
                                                      <div class="media-body ml-3">
                                                          <div
                                                              class="d-flex align-items-center justify-content-between">
                                                              <h6 class="mb-0">Shipment Recieved</h6>
                                                              <small class="text-dark"><b>12 : 47 pm</b></small>
                                                          </div>
                                                          <small class="mb-0">Nestle Supplier</small>
                                                      </div>
                                                  </div>
                                              </a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li class="nav-item nav-icon dropdown caption-content">
                              <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton4"
                                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <img src="/logistic-assets/images/user/1.png" class="img-fluid rounded"
                                      alt="user">
                              </a>
                              <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <div class="card shadow-none m-0">
                                      <div class="card-body p-0 text-center">
                                          <div class="media-body profile-detail text-center">
                                              <img src="/logistic-assets/images/page-img/profile-bg.jpg"
                                                  alt="profile-bg" class="rounded-top img-fluid mb-4">
                                              <img src="/logistic-assets/images/user/1.png" alt="profile-img"
                                                  class="rounded profile-img img-fluid avatar-70">
                                          </div>
                                          <div class="p-3">
                                              <h5 class="mb-1">{{ Auth::user()->email }}</h5>
                                              <div class="d-flex align-items-center justify-content-center mt-3">
                                                  <a class="nav-link" class="btn border" href="{{ route('logout') }}"
                                                      onclick="event.preventDefault();
                                                        Swal.fire({
                                                                title: 'Logout',
                                                                text: 'Are you sure you want to logout?',
                                                                icon: 'warning',
                                                                showCancelButton: true,
                                                                confirmButtonColor: '#3085d6',
                                                                cancelButtonColor: '#d33',
                                                                confirmButtonText: 'Yes, logout'
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                
                                                                    document.getElementById('logout-form').submit();
                                                                }
                                                            });">
                                                      Sign Out
                                                  </a>

                                                  <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                      class="d-none">
                                                      @csrf
                                                  </form>

                                                  </a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                      </ul>
                  </div>
              </div>
          </nav>
      </div>
  </div>
