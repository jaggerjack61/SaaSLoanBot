@extends('layouts.base')

@section('content')


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
                                            {{optional($result->handler)->name}}
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
                                <tr><th>Amount</th>
                                    <th>Note</th>
                                    <th>Handled By</th>
                                    <th>Date</th></tr>
                                </thead>
                                <tbody>
                                @foreach($payments->where('loan_id',$result->id) as $payment)
                                    <tr>
                                        <td>{{$payment->amount}}{{$payment->loan->currency}}</td>
                                        <td>{{$payment->notes}}</td>
                                        <td>{{$payment->handler->name}}</td>
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

    <!-- / Layout wrapper -->

    <script>
        function loadImages(number){
            document.getElementById('identification').src='/customers/'+number+'/id.jpg';
            document.getElementById('payslip').src='/customers/'+number+'/payslip.jpg';
        }
    </script>
@endsection
