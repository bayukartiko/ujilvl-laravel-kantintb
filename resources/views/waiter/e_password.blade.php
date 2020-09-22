@extends('layout/WaiterMain')

@section('title', 'Change Password')

@section('topbar')

    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

        <!-- Topbar Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mt-3">
                    <li class="breadcrumb-item"><a href="{{ url('/wdashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                </ol>
            </nav>

@endsection

@section('konten')
    <h1 class="h3 mb-4 text-gray-800">Change Pasword Management</h1>

    <form method="POST" action="/wpassword/update/{{ $profil->id }}" enctype="multipart/form-data">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Change Password</h6>
                <span>please complete this form</span>
            </div>
            <div class="card-body">

                @if (session()->has('success'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session()->get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session()->has('fail'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session()->get('fail') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif


                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="cur_pass" class="col-form-label">Current Password</label>
                        <div class="input-group" id="show_hide_cur_pass">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <a href=""><i class="far fa-fw fa-eye-slash" aria-hidden="true"></i></a>
                                </span>
                            </div>
                            <input type="password" class="form-control" placeholder="Enter current password" id="cur_pass" name="cur_pass" required>
                        </div>
                    @if($errors->has('cur_pass'))
                        <div class="text-danger">
                            <small>{{ $errors->first('cur_pass')}}</small>
                        </div>
                    @endif
                </div>

                <br>
                <hr>
                <br>

                <div class="form-group">
                    <label for="new_pass" class="col-form-label">New Password</label>
                        <div class="input-group" id="show_hide_new_pass">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <a href=""><i class="far fa-fw fa-eye-slash" aria-hidden="true"></i></a>
                                </span>
                            </div>
                            <input type="password" class="form-control" placeholder="Enter new password" id="new_pass" name="new_pass" required>
                        </div>
                    @if($errors->has('new_pass'))
                        <div class="text-danger">
                            <small>{{ $errors->first('new_pass')}}</small>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="confirm_new_pass" class="col-form-label">Confirm New Password</label>
                        <div class="input-group" id="show_hide_confirm_new_pass">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <a href=""><i class="far fa-fw fa-eye-slash" aria-hidden="true"></i></a>
                                </span>
                            </div>
                            <input type="password" class="form-control" placeholder="confirm new password" id="confirm_new_pass" name="confirm_new_pass" required>
                        </div>
                    @if($errors->has('confirm_new_pass'))
                        <div class="text-danger">
                            <small>{{ $errors->first('confirm_new_pass')}}</small>
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <a href="{{ url('/wdashboard') }}" class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to change your password?')">Update Password</button>
                </div>
            </div>
        </div>
    </form>
@endsection
