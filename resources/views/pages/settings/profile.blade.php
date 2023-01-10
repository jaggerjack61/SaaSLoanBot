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

    <title>Profile</title>

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
                <li class="menu-item">
                    <a href="{{route('dashboard')}}" class="menu-link">
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

            <div class="content-wrapper">

                @include('layouts.includes.table-header-basic')

            <!-- Content -->
            <div class="col-xl m-5">
                <div class="card mb-4">
                    @if(session()->has('error'))

                        <div class="alert alert-danger alert-dismissible" role="alert">
                            {{ session()->get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>


                    @elseif(session()->has('success'))


                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ session()->get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                    @endif
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Edit Profile</h5>
                        <small class="text-muted float-end">Some fields cannot be changed.</small>
                    </div>
                    <div class="card-body">
                        <form action="{{route('save-profile')}}" method="post">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Name</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                              <span id="basic-icon-default-fullname2" class="input-group-text"
                              ><i class="bx bx-user"></i
                                  ></span>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="basic-icon-default-fullname"
                                            name="name"
                                            value="{{auth()->user()->name}}"
                                            aria-describedby="basic-icon-default-fullname2"
                                            required
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Email</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                        <input
                                            type="text"
                                            id="basic-icon-default-email"
                                            class="form-control"
                                            name="email"
                                            value="{{auth()->user()->email}}"
                                            aria-describedby="basic-icon-default-email2"
                                            disabled
                                        />

                                    </div>

                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 form-label" for="basic-icon-default-phone">Password</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                              <span id="basic-icon-default-phone2" class="input-group-text"
                              ><i class="bx bx-lock"></i
                                  ></span>
                                        <input
                                            type="text"
                                            id="basic-icon-default-phone"
                                            class="form-control phone-mask"
                                            name="pass"
                                            placeholder="Leave blank to indicate no chnange to your password"

                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            </div>
                <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
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
