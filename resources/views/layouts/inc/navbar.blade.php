 <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Judul Sistem -->
                    <div class="d-none d-sm-inline-block mr-auto">
                        <span class="font-weight-bold text-gray-800">
                            Kunjungan Perpustakaan
                        </span>
                    </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('img/undraw_profile.svg') }}">
                                <span class="ml-2 d-none d-lg-inline text-gray-600 small">
                                    {{Auth::user()->name }}
                                </span>
                            </a>
                            
                        </li>

                    </ul>

                </nav>