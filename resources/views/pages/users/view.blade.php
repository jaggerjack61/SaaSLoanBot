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

    <title>View User</title>

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

            @include('layouts.includes.table-header-basic')


            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">View /</span> User</h4>

            <!-- Content -->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$customer->name}}</h5>
                                        <div class="card-subtitle text-muted mb-3">Phone:+{{$customer->phone_no}}</div>
                                        <p class="card-text">
                                            Bank:{{$customer->bank}}
                                        </p>
                                        <p class="card-text">
                                            Account Number:{{$customer->account_number}}
                                        </p>
                                        <p class="card-text">
                                            EC Number:{{$customer->EC}}
                                        </p>
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#viewCustomerModal" onclick="
                                        loadImages('{{$customer->phone_no}}')" class="card-link">View ID and Payslip</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card">
                                    <h5 class="card-header">{{$results->count()}} Loans </h5>
                                    <div class="table-responsive text-nowrap">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>

                                                <th>Loan Amount</th>
                                                <th>Paid</th>
                                                <th>Status</th>
                                                <th>Handled By</th>
                                                <th>Action</th>




                                            </tr>
                                            </thead>
                                            <tbody>
                                            {{--                        {{dd($results)}}--}}
                                            @foreach($results as $result)

                                                    <tr>

                                                        <td>{{$result->amount.' '.$result->currency}}</td>
                                                        <td>
                                                            @php
                                                                $total=0;
                                                            @endphp
                                                            @for($i = 1; $i <= 1; $i++)
                                                                @foreach($payments as $payment)
                                                                    @if($result->id==$payment->loan_id)
                                                                        @php
                                                                            $total+=$payment->amount;
                                                                        @endphp
                                                                    @endif
                                                                @endforeach
                                                            @endfor
                                                            {{$total.' '.$result->currency}}
                                                        </td>
                                                        <td>@if($result->status=='approved')
                                                                In Progress
                                                            @elseif($result->status=='paid')
                                                                Complete
                                                            @else
                                                                {{$result->status}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{$result->handler->name}}
                                                        </td>


                                                        <td><a href="#" data-bs-toggle="modal" data-bs-target="#viewPaymentModal{{$result->id}}" class="btn btn-sm btn-primary">View</a></td>


                                                    </tr>

                                            @endforeach
                                            </tbody>


                                        </table>


                                    </div>
                                </div>

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

@foreach($results as $result)
    <div class="modal fade" id="viewPaymentModal{{$result->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Amount</th>
                                <th>Note</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payments->where('loan_id',$result->id) as $payment)
                                <tr>
                                    <td>{{$payment->amount}}</td>
                                    <td>{{$payment->notes}}
                                    <td>{{$payment->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div wire:loading wire:target="viewLoan">
                        <h3>Please wait....</h3>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endforeach

<div class="modal fade" id="viewCustomerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4>Identification</h4>
                <div class="row">
                    <img id="identification" />
                    <h4>Payslip</h4>
                </div>
                <div class="row">
                    <img id="payslip" />
                </div>
            </div>

        </div>
    </div>
</div>
<!-- / Layout wrapper -->

<script>
    function loadImages(number){
        document.getElementById('identification').src='/customers/'+number+'/id.jpg';
        document.getElementById('payslip').src='/customers/'+number+'/payslip.jpg';
    }
</script>

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
