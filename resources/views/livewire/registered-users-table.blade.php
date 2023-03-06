<div>
    @include('layouts.includes.table-header')


    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Registered /</span> Users</h4>

            <!-- Basic Bootstrap Table -->



            <!-- Hoverable Table rows -->
            <div class="card">
                <h5 class="card-header">{{$results->where('status','registered')->count()}} Users</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>EC Number</th>
                            <th>Bank</th>
                            <th>Account</th>
                            <th>Handle By</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @foreach($results as $result)
                            @if($result->status=='registered')
                                <tr>
                                    <td>{{$result->name}}</td>
                                    <td>{{$result->phone_no}}</td>
                                    <td>{{$result->EC}}</td>
                                    <td>{{$result->bank}}</td>
                                    <td>{{$result->account_number}}</td>
                                    <td>{{$result->handler->name}}</td>
                                    <td><button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewCustomerModal" onclick="
                                        loadImages('{{$result->phone_no}}')">View</button>
                                        <button class="btn btn-danger" wire:click="deny('{{$result->id}}')">Deny</button>
                                        <a href="{{route('view-user',[$result->id])}}" class="btn btn-success">Details</a>
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
</div>
