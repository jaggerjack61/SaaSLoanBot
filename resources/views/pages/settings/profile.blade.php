@extends('layouts.base')

@section('content')
    <div class="content-wrapper">

        @include('layouts.includes.table-header-basic')

        <!-- Content -->
        <div class="col-xl m-5">
            <div class="card mb-4">

                @include('layouts.includes.message')

                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Edit Profile</h5>
                    <small class="text-muted float-end">Some fields cannot be changed.</small>
                </div>
                <div class="card-body">
                    <form action="{{route('save-profile')}}" method="post">
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
                                        value="{{auth()->user()->name}}"
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
                                        value="{{auth()->user()->email}}"
                                        aria-describedby="basic-icon-default-email2"
                                        disabled
                                    />

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
                                        name="pass"
                                        placeholder="Leave blank to indicate no chnange to your password"

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
