<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="UGOLF Dashboard">
    <meta name="author" content="UGOLF">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Kufam:wght@400;700&display=swap" rel="stylesheet">
    <link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="../assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet">
    <link href="../dist/css/style.min.css" rel="stylesheet">
    <title>UGOLF</title>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <!-- Main wrapper -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <!-- Topbar header -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-lg">
                <div class="navbar-header" data-logobg="skin6">
                    <a class="nav-toggler d-block d-lg-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <div class="navbar-brand">
                        <a href="#">
                            <img src="../assets/images/freedashDark.svg" alt="UGOLF Logo" class="img-fluid">
                        </a>
                    </div>
                    <a class="topbartoggler d-block d-lg-none" href="javascript:void(0)" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- Left-aligned dropdown menu -->
                    <ul class="navbar-nav float-left me-auto ms-3 ps-1">
                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link" href="javascript:void(0)">
                                <div class="customize-input">
                                    <select
                                        class="custom-select form-control bg-white custom-radius custom-shadow border-0">
                                        <option selected>EN</option>
                                        <option value="1">IN</option>
                                    </select>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav float-end">
                        <li class="nav-item dropdown">
                            <!-- Gunakan gambar profil dari pengguna yang sedang login -->
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown">
                                <!-- Cek apakah pengguna memiliki gambar profil -->
                                <img src="" alt="user" class="rounded-circle" width="40">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('profile') }}">Edit Profile</a>
                                <!-- Jika ada menu logout, tambahkan di sini -->
                                <a class="dropdown-item" href="{{ route('profile.logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                    <!-- Form Logout (jika ada) -->
                    <form id="logout-form" action="{{ route('profile.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>


                </div>
            </nav>
        </header>

        <!-- Left Sidebar -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/dashboard" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" class="feather-icon" viewBox="0 0 23 23"
                                    fill="currentColor">
                                    <path
                                        d="M21 20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V9.48907C3 9.18048 3.14247 8.88917 3.38606 8.69972L11.3861 2.47749C11.7472 2.19663 12.2528 2.19663 12.6139 2.47749L20.6139 8.69972C20.8575 8.88917 21 9.18048 21 9.48907V20ZM19 19V9.97815L12 4.53371L5 9.97815V19H19Z">
                                    </path>
                                </svg>
                                <span style="font-family: 'Kufam', sans-serif;" class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu text-muted">Applications</span></li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/merchant/index" aria-expanded="false">
                                <i data-feather="shopping-bag" class="feather-icon"></i>
                                <span style="font-family: 'Kufam', sans-serif;" class="hide-menu">Merchant</span>
                            </a>
                        </li>

                        {{-- Terminal --}}
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/terminal" aria-expanded="false">
                                <i data-feather="tablet" class="feather-icon"></i>
                                <span style="font-family: 'Kufam', sans-serif;" class="hide-menu">Terminal</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/payment-type" aria-expanded="false">
                                <i data-feather="credit-card" class="feather-icon"></i>
                                <span style="font-family: 'Kufam', sans-serif;" class="hide-menu">Payment Type</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/cms" aria-expanded="false">
                                <i data-feather="file-text" class="feather-icon"></i>
                                <span style="font-family: 'Kufam', sans-serif;" class="hide-menu">Content
                                    System</span>
                            </a>
                        </li>

                        {{-- Lokasi --}}
                        {{-- <li class="sidebar-item">
                            <a class="sidebar-link" href="/lokasi" aria-expanded="false">
                                <i data-feather="map-pin" class="feather-icon" style="margin-top:-4px;"></i>
                                <span style="font-family: 'Kufam', sans-serif;" class="hide-menu">Location</span>
                            </a>
                        </li> --}}

                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu text-muted">Logout</span></li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="javascript:void(0)" data-bs-toggle="modal"
                                data-bs-target="#logoutModal" aria-expanded="false">
                                <i data-feather="log-out" class="feather-icon"></i>
                                <span style="font-family: 'Kufam', sans-serif;" class="hide-menu">Logout</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Page Wrapper for content -->
        <div class="page-wrapper">
            @yield('content')
        </div>
    </div>

    <!-- All Jquery -->
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../dist/js/app-style-switcher.js"></script>
    <script src="../dist/js/feather.min.js"></script>
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../dist/js/sidebarmenu.js"></script>
    <script src="../dist/js/custom.min.js"></script>
    <script src="../assets/extra-libs/c3/d3.min.js"></script>
    <script src="../assets/extra-libs/c3/c3.min.js"></script>
    <script src="../assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="../assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="../assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../dist/js/pages/dashboards/dashboard1.min.js"></script>
</body>

</html>
