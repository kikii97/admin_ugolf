<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>UGOLF</title>
    <!-- Custom CSS -->
    <link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="../assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Kufam:wght@400;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet">
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
                    <a class="nav-toggler waves-effect waves-light d-block d-lg-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- Logo -->
                    <div class="navbar-brand">
                        <!-- Logo icon -->
                        <a href="#">
                            <img src="../assets/images/freedashDark.svg" alt="" class="img-fluid">
                        </a>
                    </div>
                    <a class="topbartoggler d-block d-lg-none waves-effect waves-light" href="javascript:void(0)"
                        data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- toggle and nav items -->
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
                    <!-- Right side toggle and nav items -->
                    <ul class="navbar-nav float-end">
                        <!-- ============================================================== -->
                        <!-- User profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img src="../assets/images/users/profile-pic.jpg" alt="user" class="rounded-circle"
                                    width="40">
                                <span class="ms-2 d-none d-lg-inline-block"><span>Hello,</span> <span
                                        class="text-dark">Jason Doe</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left Sidebar  -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link sidebar-link" href="/dashboard" aria-expanded="false">
                                {{-- <i data-feather="home" ></i> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="feather-icon" style="margin-top:-4px;" viewBox="0 0 23 23" fill="currentColor"><path d="M21 20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V9.48907C3 9.18048 3.14247 8.88917 3.38606 8.69972L11.3861 2.47749C11.7472 2.19663 12.2528 2.19663 12.6139 2.47749L20.6139 8.69972C20.8575 8.88917 21 9.18048 21 9.48907V20ZM19 19V9.97815L12 4.53371L5 9.97815V19H19Z"></path></svg>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Applications</span></li>

                        <li class="sidebar-item"> 
                            <a class="sidebar-link" href="/tiket" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" class="feather-icon" viewBox="0 0 24 24" fill="currentColor"><path d="M21.0049 2.99979C21.5572 2.99979 22.0049 3.4475 22.0049 3.99979V9.49979C20.6242 9.49979 19.5049 10.6191 19.5049 11.9998C19.5049 13.3805 20.6242 14.4998 22.0049 14.4998V19.9998C22.0049 20.5521 21.5572 20.9998 21.0049 20.9998H3.00488C2.4526 20.9998 2.00488 20.5521 2.00488 19.9998V14.4998C3.38559 14.4998 4.50488 13.3805 4.50488 11.9998C4.50488 10.6191 3.38559 9.49979 2.00488 9.49979V3.99979C2.00488 3.4475 2.4526 2.99979 3.00488 2.99979H21.0049ZM20.0049 4.99979H4.00488V7.96779L4.16077 8.04886C5.49935 8.78084 6.42516 10.1733 6.49998 11.788L6.50488 11.9998C6.50488 13.704 5.55755 15.1869 4.16077 15.9507L4.00488 16.0308V18.9998H20.0049V16.0308L19.849 15.9507C18.5104 15.2187 17.5846 13.8263 17.5098 12.2116L17.5049 11.9998C17.5049 10.2956 18.4522 8.81266 19.849 8.04886L20.0049 7.96779V4.99979Z"></path></svg>
                                <span class="hide-menu">Ticket Price</span>
                            </a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="/lokasi"
                                aria-expanded="false"><i data-feather="map-pin" class="feather-icon"></i><span
                                    class="hide-menu">Location</span></a></li>

                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Logout</span></li>

                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                                href="authentication-login1.html" aria-expanded="false"><i data-feather="log-out"
                                    class="feather-icon"></i><span class="hide-menu">Logout</span></a></li>

                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            @yield('content')
        </div>
        <!-- End Page wrapper  -->
    </div>

    <!-- All Jquery -->
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- apps -->
    <script src="../dist/js/app-style-switcher.js"></script>
    <script src="../dist/js/feather.min.js"></script>
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="../assets/extra-libs/c3/d3.min.js"></script>
    <script src="../assets/extra-libs/c3/c3.min.js"></script>
    <script src="../assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="../assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="../assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../dist/js/pages/dashboards/dashboard1.min.js"></script>
</body>

</html>
