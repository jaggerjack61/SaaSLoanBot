<div>
    @include('layouts.includes.table-header')


    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pending /</span> Loans</h4>

            <!-- Basic Bootstrap Table -->



            <!-- Hoverable Table rows -->
            <div class="card">
                <h5 class="card-header">{{$results->where('status','pending')->count()}} Loans</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Duration</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @foreach($results as $result)
                            @if($result->status=='pending')
                                        <tr>
                                            <td>{{$result->owner->name}}</td>
                                            <td>{{$result->amount.' '.$result->currency}}</td>
                                            <td>{{$result->due_date.' Months'}}</td>
                                            <td>
                                    <span wire:loading.remove wire:target="approveLoan">
                                     <a href="#" class="btn btn-success" wire:click="approveLoan('{{$result->id}}')">Approve</a>
                                    </span>
                                                <span wire:loading wire:target="approveLoan">
                                        <a href="#" class="btn btn-success">Please Wait...</a>
                                    </span>
                                                <span wire:loading.remove wire:target="denyLoan">
                                     <a href="#" class="btn btn-danger" wire:click="denyLoan('{{$result->id}}')">Deny</a>
                                    </span>
                                                <span wire:loading wire:target="denyLoan">
                                        <a href="#" class="btn btn-danger">Please Wait...</a>
                                    </span>

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
</div>
