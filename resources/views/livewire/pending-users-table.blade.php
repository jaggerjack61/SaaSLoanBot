<div>
    @include('layouts.includes.table-header')


    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pending /</span> Users</h4>

            <!-- Basic Bootstrap Table -->



            <!-- Hoverable Table rows -->
            <div class="card">
                <h5 class="card-header">{{$results->where('status','pending')->count()}} Users</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>EC Number</th>
                            <th>Bank</th>
                            <th>Account</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @foreach($results as $result)
                            @if($result->status=='pending')
                                <tr>
                                    <td>{{$result->name}}</td>
                                    <td>{{$result->phone_no}}</td>
                                    <td>{{$result->EC}}</td>
                                    <td>{{$result->bank}}</td>
                                    <td>{{$result->account_number}}</td>
                                    <td><button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewCustomerModal" onclick="
                                        loadImages('{{$result->phone_no}}')">View</button>
                                        <button class="btn btn-primary" wire:click="register('{{$result->id}}')">Approve</button>
                                        <button class="btn btn-danger" wire:click="deny('{{$result->id}}')">Deny</button>
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
