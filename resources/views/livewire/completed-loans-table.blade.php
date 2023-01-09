<div>
    @include('layouts.includes.table-header')


    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Completed /</span> Loans</h4>

            <!-- Basic Bootstrap Table -->



            <!-- Hoverable Table rows -->
            <div class="card">
                <h5 class="card-header">{{$results->where('status','paid')->count()}} Loans </h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Loan Amount</th>
                            <th>Paid</th>
                            <th>Action</th>




                        </tr>
                        </thead>
                        <tbody>
{{--                        {{dd($results)}}--}}
                        @foreach($results as $result)
                            @if($result->status == 'paid')
                                <tr>
                                    <td>{{$result->owner->name}}</td>
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


                                    <td><a href="#" wire:click="viewLoan('{{$result->id}}')" data-bs-toggle="modal" data-bs-target="#viewPaymentModal" class="btn btn-sm btn-primary">View</a></td>


                                </tr>
                            @endif
                        @endforeach
                        </tbody>


                    </table>


                </div>
            </div>

            <!--/ Hoverable Table rows -->

            <hr class="my-5" />
            {{$results->links()}}


            <!--/ Responsive Table -->
        </div>
        <!-- / Content -->



        <div class="content-backdrop fade"></div>
    </div>
    <div wire:ignore.self class="modal fade" id="viewPaymentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div wire:loading.remove wire:target="viewLoan">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Amount</th>
                                <th>Note</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paymentHistory as $payment)
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




</div>
