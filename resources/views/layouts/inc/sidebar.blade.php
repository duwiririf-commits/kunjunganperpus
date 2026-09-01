<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
       href="{{ route('admin.dashboard') }}">

        <div class="sidebar-brand-icon">
            <i class="fas fa-book-open"></i>
        </div>

        <div class="sidebar-brand-text mx-2">
            Kunjungan<br>Perpustakaan
        </div>

    </a>


    <!-- Divider -->
    <hr class="sidebar-divider my-4">


    <!-- =========================
         DASHBOARD
    ========================== -->

    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

        <a class="nav-link"
           href="{{ route('admin.dashboard') }}">

            <i class="fas fa-fw fa-home"></i>

            <span>Dashboard</span>

        </a>

    </li>


    <!-- =========================
         DATA KUNJUNGAN
    ========================== -->

    <li class="nav-item {{ request()->routeIs('admin.kunjungan.*') ? 'active' : '' }}">

        <a class="nav-link"
           href="{{ route('admin.kunjungan.index') }}">

            <i class="fas fa-fw fa-book"></i>

            <span>Data Kunjungan</span>

        </a>

    </li>


    <!-- =========================
         ARSIP KUNJUNGAN
    ========================== -->

    <li class="nav-item {{ request()->routeIs('admin.arsip.*') ? 'active' : '' }}">

        <a class="nav-link"
           href="{{ route('admin.arsip.index') }}">

            <i class="fas fa-fw fa-archive"></i>

            <span>Arsip Kunjungan</span>

        </a>

    </li>


    <!-- =========================
         LOGOUT
    ========================== -->

    <li class="nav-item">

        <a class="nav-link"
           href="javascript:void(0)"
           onclick="confirmLogout()">

            <i class="fas fa-fw fa-sign-out-alt"></i>

            <span>Logout</span>

        </a>

    </li>


    <!-- =========================
         FORM LOGOUT
    ========================== -->

    <form id="logout-form"
          action="{{ route('logout') }}"
          method="POST"
          class="d-none">

        @csrf

    </form>

</ul>


<!-- =========================
     SWEETALERT LOGOUT
========================= -->

<script>

    function confirmLogout() {

        Swal.fire({

            title: 'Logout',

            text: 'Apakah anda yakin ingin keluar?',

            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#d9534f',

            cancelButtonColor: '#bdbdbd',

            confirmButtonText: 'Ya, Logout',

            cancelButtonText: 'Batal',

            reverseButtons: true

        }).then((result) => {

            if (result.isConfirmed) {

                document.getElementById('logout-form').submit();

            }

        });

    }

</script>


<!-- =========================
     CSS SIDEBAR
========================= -->

<style>

    /* =========================
       BACKGROUND SIDEBAR
    ========================== */

    .sidebar {
        background-color: #dfb4c8 !important;
        background-image: none !important;
    }


    /* =========================
       TULISAN MENU
    ========================== */

    .sidebar .nav-link span {
        font-size: 16px !important;
        font-weight: 600;
    }


    /* =========================
       JARAK ANTAR MENU
    ========================== */

    .sidebar .nav-item {
        margin-bottom: 8px;
    }


    /* =========================
       ICON
    ========================== */

    .sidebar .nav-link i {
        margin-right: 8px;
        font-size: 18px;
    }


    /* =========================
       BRAND
    ========================== */

    .sidebar .sidebar-brand-text {
    color: #000 !important;
    font-size: 17px !important;
    padding-top: 12px;
    line-height: 1.4;
    font-weight: 700;
    }


    /* =========================
       MENU BIASA
    ========================== */

    .sidebar .nav-item .nav-link {
        color: #000 !important;
        border-radius: 0 !important;
        padding: 12px 15px !important;
    }


    /* =========================
       ICON MENU BIASA
    ========================== */

    .sidebar .nav-item .nav-link i {
        color: #000 !important;
    }


    /* =========================
       MENU AKTIF
       WARNA PINK LEBIH TUA
    ========================== */

    .sidebar .nav-item.active > .nav-link {
        background-color: #e888b7 !important;
        color: #000 !important;
        border-radius: 0 !important;
    }


    /* =========================
       ICON MENU AKTIF
    ========================== */

    .sidebar .nav-item.active > .nav-link i {
        color: #000 !important;
    }


    /* =========================
       HOVER
    ========================== */

    .sidebar .nav-item:not(.active) > .nav-link:hover {
        background-color: rgba(232, 136, 183, 0.45) !important;
        color: #000 !important;
    }


    .sidebar .nav-item:not(.active) > .nav-link:hover i {
        color: #000 !important;
    }

</style>