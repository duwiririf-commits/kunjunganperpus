<ul class="navbar-nav sidebar-pink sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
       href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-book-open"></i>
        </div>
        <div class="sidebar-brand-text mx-3">
            Kunjungan<br>Perpustakaan
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Data Kunjungan -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.kunjungan.index') }}">
            <i class="fas fa-fw fa-book"></i>
            <span>Data Pengunjung</span>
        </a>
    </li>


    <!-- Logout -->
    <li class="nav-item">
        <a class="nav-link"
           href="{{ route('logout') }}"
           onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

</ul>