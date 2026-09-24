<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
       href="{{ route('admin.dashboard') }}">

        <div class="sidebar-brand-icon">
            <i class="fas fa-book-open"></i>
        </div>

        <div class="sidebar-brand-text">
            Kunjungan<br>Perpustakaan
        </div>

    </a>


    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Dashboard -->
    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

        <a class="nav-link"
           href="{{ route('admin.dashboard') }}">

            <i class="fas fa-fw fa-home"></i>

            <span>Dashboard</span>

        </a>

    </li>


    <!-- Data Kunjungan -->
    <li class="nav-item {{ request()->routeIs('admin.kunjungan.*') ? 'active' : '' }}">

        <a class="nav-link"
           href="{{ route('admin.kunjungan.index') }}">

            <i class="fas fa-fw fa-book"></i>

            <span>Data Kunjungan</span>

        </a>

    </li>


    <!-- Arsip Kunjungan -->
    <li class="nav-item {{ request()->routeIs('admin.arsip.*') ? 'active' : '' }}">

        <a class="nav-link"
           href="{{ route('admin.arsip.index') }}">

            <i class="fas fa-fw fa-table"></i>

            <span>Arsip Kunjungan</span>

        </a>

    </li>


    <!-- Ubah Profile -->
    <li class="nav-item {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">

        <a class="nav-link"
           href="{{ route('admin.profile.edit') }}">

            <i class="fas fa-user"></i>

            <span>Ubah Profile</span>

        </a>

    </li>


    <!-- Logout -->
    <li class="nav-item">

        <a class="nav-link"
           href="javascript:void(0)"
           onclick="confirmLogout()">

            <i class="fas fa-fw fa-sign-out-alt"></i>

            <span>Logout</span>

        </a>

    </li>


    <!-- Form Logout -->
    <form id="logout-form"
          action="{{ route('logout') }}"
          method="POST"
          style="display: none;">

        @csrf

    </form>

</ul>


<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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


<style>

    /* SIDEBAR */

    #accordionSidebar {

        background: #dfb4c8 !important;

        background-color: #dfb4c8 !important;

        background-image: none !important;

        width: 260px !important;

        min-width: 260px !important;

        max-width: 260px !important;

        min-height: 100vh !important;

        margin: 0 !important;

        padding: 0 !important;

        flex-shrink: 0 !important;

    }


    /* SEMUA BAGIAN SIDEBAR */

    #accordionSidebar,
    #accordionSidebar * {

        box-sizing: border-box;

    }


    /* BRAND */

    #accordionSidebar .sidebar-brand {

        width: 100% !important;

        height: 140px !important;

        margin: 0 !important;

        padding: 15px 10px !important;

        background: #dfb4c8 !important;

        color: #000 !important;

        display: flex !important;

        align-items: center !important;

        justify-content: center !important;

        text-decoration: none !important;

    }


    /* ICON BUKU */

    #accordionSidebar .sidebar-brand-icon {

        color: #000 !important;

        font-size: 38px !important;

        width: 45px !important;

        min-width: 45px !important;

        margin-right: 10px !important;

        display: flex !important;

        align-items: center !important;

        justify-content: center !important;

    }


    /* NAMA PERPUSTAKAAN */

    #accordionSidebar .sidebar-brand-text {

        color: #000 !important;

        font-size: 19px !important;

        font-weight: 700 !important;

        line-height: 1.25 !important;

        text-align: center !important;

        margin: 0 !important;

        padding: 0 !important;

        white-space: nowrap !important;

    }


    /* GARIS PEMBATAS */

    #accordionSidebar .sidebar-divider {

        width: 100% !important;

        height: 1px !important;

        margin: 0 0 18px 0 !important;

        padding: 0 !important;

        border: 0 !important;

        border-top: 2px solid rgba(255, 255, 255, 0.9) !important;

        background: transparent !important;

    }


    /* MENU */

    #accordionSidebar .nav-item {

        width: 100% !important;

        margin: 0 0 8px 0 !important;

        padding: 0 !important;

    }


    /* LINK MENU */

    #accordionSidebar .nav-link {

        width: 100% !important;

        height: 58px !important;

        margin: 0 !important;

        padding: 0 25px !important;

        display: flex !important;

        align-items: center !important;

        background: #dfb4c8 !important;

        background-color: #dfb4c8 !important;

        color: #000 !important;

        border: none !important;

        border-radius: 0 !important;

        text-decoration: none !important;

        font-size: 16px !important;

        font-weight: 600 !important;

    }


    /* ICON MENU */

    #accordionSidebar .nav-link i {

        width: 32px !important;

        min-width: 32px !important;

        margin-right: 15px !important;

        color: #000 !important;

        font-size: 20px !important;

        text-align: center !important;

    }


    /* TULISAN MENU */

    #accordionSidebar .nav-link span {

        color: #000 !important;

        font-size: 16px !important;

        font-weight: 600 !important;

        white-space: nowrap !important;

    }


    /* MENU AKTIF */

    #accordionSidebar .nav-item.active > .nav-link {

        background: #d18eae !important;

        background-color: #d18eae !important;

        color: #000 !important;

        border-radius: 0 !important;

    }


    /* ICON MENU AKTIF */

    #accordionSidebar .nav-item.active > .nav-link i {

        color: #000 !important;

    }


    /* TULISAN MENU AKTIF */

    #accordionSidebar .nav-item.active > .nav-link span {

        color: #000 !important;

    }


    /* HOVER */

    #accordionSidebar .nav-item:not(.active) > .nav-link:hover {

        background: #d18eae !important;

        background-color: #d18eae !important;

        color: #000 !important;

    }


    /* ICON HOVER */

    #accordionSidebar .nav-item:not(.active) > .nav-link:hover i {

        color: #000 !important;

    }


    /* TULISAN HOVER */

    #accordionSidebar .nav-item:not(.active) > .nav-link:hover span {

        color: #000 !important;

    }


    /* HAPUS EFEK BAWAAN */

    #accordionSidebar .nav-link::before,
    #accordionSidebar .nav-link::after,
    #accordionSidebar .nav-item::before,
    #accordionSidebar .nav-item::after {

        display: none !important;

    }


    /* LOGOUT */

    #accordionSidebar .nav-item:last-child .nav-link {

        background: #dfb4c8 !important;

        background-color: #dfb4c8 !important;

        color: #000 !important;

    }


    /* LOGOUT HOVER */

    #accordionSidebar .nav-item:last-child .nav-link:hover {

        background: #d18eae !important;

        background-color: #d18eae !important;

        color: #000 !important;

    }


    /* RESPONSIVE */

    @media (max-width: 768px) {

        #accordionSidebar {

            width: 260px !important;

            min-width: 260px !important;

            max-width: 260px !important;

        }


        #accordionSidebar .sidebar-brand-text {

            font-size: 17px !important;

        }


        #accordionSidebar .sidebar-brand-icon {

            font-size: 34px !important;

        }

    }

</style>