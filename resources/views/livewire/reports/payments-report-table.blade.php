<div>
    @include('layouts.includes.table-header-basic')


    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Reports /</span> Payments</h4>

            <!-- Basic Bootstrap Table -->

            @include('layouts.includes.time-period-payments')

            <!-- Hoverable Table rows -->
            <div class="card">
                <h5 class="card-header">{{$results->count()}} Payments </h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Date</th>





                        </tr>
                        </thead>
                        <tbody>
                        {{--                        {{dd($results)}}--}}
                        @foreach($results as $result)
                            <tr>
                                <td>{{$result->loan->owner->name}}</td>
                                <td>${{$result->amount.' '.$result->loan->currency}}</td>
                                <td>{{$result->created_at}}</td>
                            </tr>
                        @endforeach
                        @if($currency)
                        <tr>
                            <td>Total:${{$results->sum('amount').' '.$currency}}</td>
                        </tr>
                        @endif
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
