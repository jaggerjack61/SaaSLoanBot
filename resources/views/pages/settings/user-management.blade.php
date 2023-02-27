@extends('layouts.base')

@section('content')
    <livewire:system-users-table />


    <!-- Content wrapper -->


    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>


    <div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('new-user')}}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Name</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                              <span id="basic-icon-default-fullname2" class="input-group-text"
                              ><i class="bx bx-user"></i
                                  ></span>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="basic-icon-default-fullname"
                                        name="name"
                                        aria-describedby="basic-icon-default-fullname2"
                                        required
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Email</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                    <input
                                        type="text"
                                        id="basic-icon-default-email"
                                        class="form-control"
                                        name="email"
                                        aria-describedby="basic-icon-default-email2"
                                        required
                                    />

                                </div>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 form-label" for="basic-icon-default-phone">Access Level</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                              <span id="basic-icon-default-phone2" class="input-group-text"
                              ><i class="bx bx-lock"></i
                                  ></span>
                                    <select class="form-control" name="access" required>
                                        <option value="user">User</option>
                                        <option value="admin">Administrator</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 form-label" for="basic-icon-default-phone">Password</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                              <span id="basic-icon-default-phone2" class="input-group-text"
                              ><i class="bx bx-lock"></i
                                  ></span>
                                    <input
                                        type="text"
                                        id="basic-icon-default-phone"
                                        class="form-control phone-mask"
                                        name="password"
                                        required
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 form-label" for="basic-icon-default-phone">Confirm Password</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                              <span id="basic-icon-default-phone2" class="input-group-text"
                              ><i class="bx bx-lock"></i
                                  ></span>
                                    <input
                                        type="text"
                                        id="basic-icon-default-phone"
                                        class="form-control phone-mask"
                                        name="password_confirmation"
                                        placeholder="Password again"
                                        required
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
