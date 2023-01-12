<div>
    @include('layouts.includes.table-header')


    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">System /</span> Users</h4>

            <!-- Basic Bootstrap Table -->

            <button class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#newUserModal">Create User</button>

            <!-- Hoverable Table rows -->
            <div class="card">
                @include('layouts.includes.message')
                <h5 class="card-header">{{$results->count()}} Users</h5>

                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Access Level</th>
                            <th>Status</th>

                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @foreach($results as $result)

                                <tr>
                                    <td>{{$result->name}}</td>
                                    <td>{{$result->email}}</td>
                                    <td>{{strtoupper($result->access=='admin'?'Administrator':'user')}}</td>
                                    <td>
                                        @if ($result->status == 'active')
                                            <span class="rounded-pill bg-success p-1">{{strtoupper($result->status)}}</span>
                                        @else
                                            <span class="rounded-pill bg-danger p-1">{{strtoupper($result->status)}}</span>
                                        @endif
                                        </td>

                                    <td>
                                        @if ($result->status == 'active')
                                            <button class="btn btn-danger" wire:click="deactivate('{{$result->id}}')">Deactivate</button>
                                        @else
                                            <button class="btn btn-primary" wire:click="activate('{{$result->id}}')">Activate</button>
                                        @endif

                                        @if ($result->access == 'admin')
                                            <button class="btn btn-danger" wire:click="demote('{{$result->id}}')">Demote</button>
                                        @else
                                            <button class="btn btn-primary" wire:click="promote('{{$result->id}}')">Promote</button>
                                        @endif





                                    </td>

                                </tr>

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
