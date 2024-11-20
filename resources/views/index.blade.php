<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="UGOLF Dashboard">
    <meta name="author" content="UGOLF">
    <link rel="icon" type="image/png" sizes="20x20" href="../assets/images/UGOLF.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Kufam:wght@400;700&display=swap" rel="stylesheet">
    <link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="../assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet">
    <link href="../dist/css/style.min.css" rel="stylesheet">
    <!-- Menambahkan Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

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
                            <img src="../assets/images/UGOLF.svg" alt="UGOLF Logo" class="img-fluid">
                        </a>
                    </div>
                    <a class="topbartoggler d-block d-lg-none" href="javascript:void(0)" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" style="height: 78px;">
                    <!-- Left-aligned dropdown menu -->
                    <ul class="navbar-nav float-left me-auto ms-3 ps-1">
                        {{-- <li class="nav-item d-none d-md-block">
                            <a class="nav-link" href="javascript:void(0)">
                                <div class="customize-input">
                                    <select
                                        class="custom-select form-control bg-white custom-radius custom-shadow border-0">
                                        <option selected>EN</option>
                                        <option value="1">IN</option>
                                    </select>
                                </div>
                            </a>
                        </li> --}}
                    </ul>
                    <ul class="navbar-nav float-end">
                        <li class="nav-item dropdown">
                            <!-- Gunakan gambar profil dari pengguna yang sedang login -->
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                <!-- Cek apakah pengguna memiliki gambar profil atau menggunakan ikon -->
                                <i class="fas fa-user-circle" style="font-size: 28px; color: #ac2daa; border: 1px padding: 2px; border-radius: 50%;"></i>                                
                                {{-- <span class="ms-2" style="color: #ac2daa;">{{ Auth::user()->name }}</span> <!-- Menampilkan nama pengguna --> --}}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- Menu Edit Profile -->
                                <a class="dropdown-item" href="{{ route('profile') }}">Edit Profile</a>
                                <!-- Menu Logout -->
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
                                <i data-feather="bar-chart-2" class="feather-icon" style="margin-left:-2px; margin-top:-8px; width: 23px; height: 24px;"></i>
                                <span style="font-family: 'Kufam', sans-serif;" class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu text-muted">Management</span></li>
                        {{-- Merchant --}}
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/merchant/index" aria-expanded="false">
                                <i data-feather="shopping-bag" class="feather-icon" style="margin-top:-4px;"></i>
                                <span style="font-family: 'Kufam', sans-serif;" class="hide-menu">Merchant</span>
                            </a>
                        </li>
                        {{-- Terminal --}}
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/terminal" aria-expanded="false">
                                {{-- <i data-feather="tablet" ></i> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="feather-icon"
                                    style="margin-left:-2px; margin-top:-4px; width: 23px; height: 24px;"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-device-ipad">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M18 3a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2z" />
                                    <path d="M9 18h6" />
                                </svg>
                                <span style="font-family: 'Kufam', sans-serif;" class="hide-menu">Terminal</span>
                            </a>
                        </li>
                        {{-- Payment --}}
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/payment-type" aria-expanded="false">
                                {{-- <i data-feather="credit-card" ></i> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="feather-icon"
                                    style="margin-left:-2px; margin-top:-4px; width: 24px; height: 24px;"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-credit-card">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M3 5m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" />
                                    <path d="M3 10l18 0" />
                                    <path d="M7 15l.01 0" />
                                    <path d="M11 15l2 0" />
                                </svg>
                                <span style="font-family: 'Kufam', sans-serif;" class="hide-menu">Payment Type</span>
                            </a>
                        </li>
                        {{-- Trx --}}
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/trx" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" class="feather-icon" style="margin-left:-2px; margin-top:-4px; width: 24px; height: 24px;"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-credit-card-pay">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 19h-6a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4.5" />
                                    <path d="M3 10h18" />
                                    <path d="M16 19h6" />
                                    <path d="M19 16l3 3l-3 3" />
                                    <path d="M7.005 15h.005" />
                                    <path d="M11 15h2" />
                                </svg>
                                <span style="font-family: 'Kufam', sans-serif;" class="hide-menu">Transaction</span>
                            </a>
                        </li>
                        {{-- Cms --}}
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/cms" aria-expanded="false">
                                {{-- <i data-feather="file-text" class="feather-icon" style="margin-top:-4px;"></i> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="feather-icon"
                                    style="margin-left:-2px; margin-top:-4px; width: 22px; height: 22px;"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-table">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                                    <path d="M3 10h18" />
                                    <path d="M10 3v18" />
                                </svg>
                                <span style="font-family: 'Kufam', sans-serif;" class="hide-menu">Content
                                    System</span>
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

    <!-- Tambahkan link CDN Iconify di dalam head -->
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
</body>

</html>
