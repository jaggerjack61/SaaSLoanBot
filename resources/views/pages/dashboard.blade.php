@extends('layouts.base')

@section('content')
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
                            <a href="https://developers.facebook.com/docs/whatsapp/cloud-api/overview/data-privacy-and-security" class="btn btn-outline-primary">Read More</a>
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
@endsection
