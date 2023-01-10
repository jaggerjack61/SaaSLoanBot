<div>
    @include('layouts.includes.table-header')


    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Reports /</span> Loans</h4>

            <!-- Basic Bootstrap Table -->

            @include('layouts.includes.time-period-loans')

            <!-- Hoverable Table rows -->
            <div class="card">
                <h5 class="card-header">{{$results->count()}} Loans </h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Loan Amount</th>
                            <th>Paid</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Last Updated</th>





                        </tr>
                        </thead>
                        <tbody>
                        {{--                        {{dd($results)}}--}}
                        @foreach($results as $result)

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

                                    <td>
                                        @if($result->status=='approved')
                                            In Progress
                                        @elseif($result->status=='paid')
                                            Complete
                                        @else
                                            {{$result->status}}
                                        @endif
                                    </td>
                                    <td>{{$result->created_at}}</td>
                                    <td>{{$result->updated_at}}</td>


                                </tr>

                        @endforeach
                        </tbody>


                    </table>


                </div>
            </div>

            <!--/ Hoverable Table rows -->

            <hr class="my-5" />



            <!--/ Responsive Table -->
        </div>
        <!-- / Content -->



        <div class="content-backdrop fade"></div>
    </div>





</div>
