<!DOCTYPE html>


<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="/assets/"
    data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="/assets/js/config.js"></script>
    @livewireStyles
</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="#" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="/assets/img/elements/logo.png" class="menu-icon">
              </span>
                    <span class="app-brand-text demo menu-text fw-bolder ms-2">Loanbot</span>
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
                <!-- Dashboard -->
                <li class="menu-item active">
                    <a href="#" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Analytics">Dashboard</div>
                    </a>
                </li>
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Users</span>
                </li>
                <li class="menu-item">
                    <a href="{{route('pending-users')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-user"></i>
                        <div data-i18n="Tables">Pending Users</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('registered-users')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-user-check"></i>
                        <div data-i18n="Tables">Registered Users</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('denied-users')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-user-x"></i>
                        <div data-i18n="Tables">Denied Users</div>
                    </a>
                </li>
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Loans</span>
                </li>
                <li class="menu-item">
                    <a href="{{route('pending-loans')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-table"></i>
                        <div data-i18n="Tables">Pending Loans</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('approved-loans')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-table"></i>
                        <div data-i18n="Tables">Approved Loans</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('denied-loans')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-table"></i>
                        <div data-i18n="Tables">Denied Loans</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('completed-loans')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-table"></i>
                        <div data-i18n="Tables">Completed Loans</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('defaulted-loans')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-table"></i>
                        <div data-i18n="Tables">Defaulted Loans</div>
                    </a>
                </li>

                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Reports</span>
                </li>
                <li class="menu-item">
                    <a href="{{route('show-payments-report')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-abacus"></i>
                        <div data-i18n="Tables">Payments Report</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{route('show-loans-report')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-abacus"></i>
                        <div data-i18n="Tables">Loans Report</div>
                    </a>
                </li>




            </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">



            <!-- Content -->

            <div class="content-wrapper">
                <!-- Content -->
                @include('layouts.includes.table-header-basic')

                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        <div class="col-lg-8 mb-4 order-0">
                            <div class="card">
                                <div class="d-flex align-items-end row">
                                    <div class="col-sm-7">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary">Welcome {{auth()->user()->name}}! 🎉</h5>
                                            <p class="mb-4">
                                                This is the loanbot admin dashboard where you can manage all your clients
                                                and their loans as well as view detailed reports.
                                            </p>

                                            <a href="{{route('show-payments-report')}}" class="btn btn-sm btn-outline-primary">View Reports</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 text-center text-sm-left">
                                        <div class="card-body pb-0 px-0 px-md-4">
                                            <img
                                                src="../assets/img/illustrations/man-with-laptop-light.png"
                                                height="140"
                                                alt="View Badge User"
                                                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                                data-app-light-img="illustrations/man-with-laptop-light.png"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 order-1">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-6 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <img
                                                        src="../assets/img/icons/unicons/chart.png"
                                                        alt="Credit Card"
                                                        class="rounded"
                                                    />
                                                </div>
                                                <div class="dropdown">
                                                    <button
                                                        class="btn p-0"
                                                        type="button"
                                                        id="cardOpt3"
                                                        data-bs-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false"
                                                    >
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                                        <a class="dropdown-item" href="{{route('registered-users')}}">View More</a>

                                                    </div>
                                                </div>
                                            </div>
                                            <span>Registered Clients</span>
                                            <h3 class="card-title mb-2">{{$customers->where('status','registered')->count()}}</h3>
                                            <small class="text-success fw-semibold">{{$customers->where('status','registered')->count()/$customers->count()*100}}%</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-6 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <img
                                                        src="../assets/img/icons/unicons/chart.png"
                                                        alt="Credit Card"
                                                        class="rounded"
                                                    />
                                                </div>
                                                <div class="dropdown">
                                                    <button
                                                        class="btn p-0"
                                                        type="button"
                                                        id="cardOpt6"
                                                        data-bs-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false"
                                                    >
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                                        <a class="dropdown-item" href="{{route('denied-users')}}">View More</a>

                                                    </div>
                                                </div>
                                            </div>
                                            <span>Denied Clients</span>

                                            <h3 class="card-title mb-2">{{$customers->where('status','denied')->count()}}</h3>
                                            <small class="text-danger fw-semibold">{{$customers->where('status','denied')->count()/$customers->count()*100}}%</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Total Revenue -->
                        <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">



                                    <div class="card h-100">
                                        <img class="card-img-top" src="../assets/img/elements/whatsapp.png" alt="Card image cap" />
                                        <div class="card-body">
                                            <h5 class="card-title">Powered by Whatsapp</h5>
                                            <p class="card-text">
                                                This chatbot utilizes whatsapp's powerful end to end encryption to ensure that all data passed from your clients
                                                to you and vice versa remains secure. To read more on the security features implemented click below.
                                            </p>
                                            <a href="javascript:void(0)" class="btn btn-outline-primary">Read More</a>
                                        </div>
                                    </div>


                        </div>
                        <!--/ Total Revenue -->
                        <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                            <div class="row">
                                <div class="col-6 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <img src="../assets/img/icons/unicons/wallet.png" alt="Credit Card" class="rounded" />
                                                </div>
                                                <div class="dropdown">
                                                    <button
                                                        class="btn p-0"
                                                        type="button"
                                                        id="cardOpt4"
                                                        data-bs-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false"
                                                    >
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                                        <a class="dropdown-item" href="{{route('approved-loans')}}">View More</a>

                                                    </div>
                                                </div>
                                            </div>
                                            <span class="d-block mb-1">Total USD Loaned</span>
                                            <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i>Capital Out</small>
                                            <h5 class="card-title text-nowrap mb-2">USD{{$usdOut}}</h5>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <img src="../assets/img/icons/unicons/wallet.png" alt="Credit Card" class="rounded" />
                                                </div>
                                                <div class="dropdown">
                                                    <button
                                                        class="btn p-0"
                                                        type="button"
                                                        id="cardOpt1"
                                                        data-bs-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false"
                                                    >
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                        <a class="dropdown-item" href="{{route('approved-loans')}}">View More</a>

                                                    </div>
                                                </div>
                                            </div>
                                            <span class="fw-semibold d-block mb-1">Total ZWL Loaned</span>
                                            <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i>Capital Out</small>
                                            <h5 class="card-title text-nowrap mb-2">ZWL{{$zwlOut}}</h5>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-6 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                                                </div>
                                                <div class="dropdown">
                                                    <button
                                                        class="btn p-0"
                                                        type="button"
                                                        id="cardOpt1"
                                                        data-bs-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false"
                                                    >
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                        <a class="dropdown-item" href="{{route('approved-loans')}}">View More</a>

                                                    </div>
                                                </div>
                                            </div>
                                            <span class="fw-semibold d-block mb-1">Total USD Paid</span>
                                            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>Capital In</small>
                                            <h5 class="card-title text-nowrap mb-2">USD{{$usdIn}}</h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                                                </div>
                                                <div class="dropdown">
                                                    <button
                                                        class="btn p-0"
                                                        type="button"
                                                        id="cardOpt1"
                                                        data-bs-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false"
                                                    >
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                        <a class="dropdown-item" href="{{route('approved-loans')}}">View More</a>

                                                    </div>
                                                </div>
                                            </div>
                                            <span class="fw-semibold d-block mb-1">Total ZWL Paid</span>
                                            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>Capital In</small>
                                            <h5 class="card-title text-nowrap mb-2">ZWL{{$zwlIn}}</h5>
                                        </div>
                                    </div>
                                </div>
                                <!-- </div>
                <div class="row"> -->

                            </div>
                        </div>
                    </div>
                    </div>
                </div>



                <!-- Content wrapper -->
            </div>
        <!-- / Layout page -->
    </div>
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>



<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="/assets/vendor/libs/jquery/jquery.js"></script>
<script src="/assets/vendor/libs/popper/popper.js"></script>
<script src="/assets/vendor/js/bootstrap.js"></script>
<script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="/assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->

<!-- Main JS -->
<script src="/assets/js/main.js"></script>

<!-- Page JS -->

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>


</body>
</html>
