<div>
    @include('layouts.includes.table-header')


    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Approved /</span> Loans</h4>

            <!-- Basic Bootstrap Table -->



            <!-- Hoverable Table rows -->
            <div class="card">
                <h5 class="card-header">{{$results->where('status','approved')->count()}} Loans</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Loan Amount</th>
                            <th>Paid Amount</th>
                            <th>Due Date</th>
                            <th>Approved By</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @foreach($results as $result)
                            @if($result->status=='approved')

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
                                            <td>{{date('Y-m-d', strtotime("+".$result->due_date." months", strtotime($result->updated_at)))}}</td>
                                            <td>{{strtoupper($result->handler->name)}}</td>
                                            <td><a href="#" wire:click.stop="setLoanId('{{$result->id}}')" data-bs-toggle="modal" data-bs-target="#addPaymentModal" class="btn btn-sm btn-success">Pay</a>
                                                <span wire:loading.remove wire:target="defaultLoan">
                                     <a href="#" wire:click="defaultLoan('{{$result->id}}')" class="btn btn-sm btn-danger">Default</a>
                                    </span>
                                                <span wire:loading wire:target="defaultLoan">
                                        <a href="#"  class="btn btn-sm btn-danger">Please Wait...</a>
                                    </span>

                                                <span wire:loading.remove wire:target="completeLoan">
                                     <a href="#" wire:click="completeLoan('{{$result->id}}')" class="btn btn-sm btn-primary">Complete</a>
                                    </span>
                                                <span wire:loading wire:target="completeLoan">
                                        <a href="#"  class="btn btn-sm btn-primary">Please Wait...</a>
                                    </span>
                                                <a href="#" wire:click="viewLoan('{{$result->id}}')" data-bs-toggle="modal" data-bs-target="#viewPaymentModal" class="btn btn-sm btn-primary">View</a>
                                            </td>

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


    <div wire:ignore class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <div class="form-group">
                        <label for="inputEmail">Amount</label>
                        <input type="number" step="0.01" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1').replace('.','.');" wire:model.lazy="amount"  name="email" class="form-control" id="inputEmail" placeholder="Amount">
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Notes</label>
                        <input type="text" name="name" wire:model.lazy="notes" class="form-control" id="inputEmail" placeholder="Notes">
                    </div>


                    <span wire:loading.remove wire:target="payLoan">
                                     <button wire:click="payLoan" class="btn btn-primary m-1">Pay</button>
                                    </span>
                    <span wire:loading wire:target="payLoan">
                                        <button class="btn btn-primary m-1">Please Wait...</button>
                                    </span>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>

            </div>
        </div>
    </div>

</div>
