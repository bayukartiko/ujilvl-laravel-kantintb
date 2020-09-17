@extends('layout/AdminMain')

@section('title', 'Edit Users')

@section('topbar')

    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

        <!-- Topbar Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mt-3">
                    <li class="breadcrumb-item"><a href="{{ url('/adashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/adashboard/users') }}">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Users</li>
                </ol>
            </nav>

        <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nama_user ?? '' }}</span>
                        <img class="img-profile rounded-circle" src="{{URL::asset('/img/profile_img/foto_diri.jpg')}}">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item text-center" href="#">
                        <button type="button" class="btn btn-outline-primary">Admin</button>
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>

        </ul>

    </nav>

@endsection

@section('konten')
    <h1 class="h3 mb-4 text-gray-800">Edit Users Management</h1>

    <form method="POST" action="/users/update/{{ $user->id }}">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit Users</h6>
                <span>please complete this form</span>
            </div>
            <div class="card-body">

                @csrf
                @method('PATCH')

                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" value="{{ $user->username }}">
                        @if($errors->has('username'))
                            <div class="text-danger">
                                <small>{{ $errors->first('username')}}</small>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <div class="input-group" id="show_hide_password">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <a href=""><i class="far fa-fw fa-eye-slash" aria-hidden="true"></i></a>
                                </span>
                            </div>
                            <input type="password" class="form-control" placeholder="Enter Password" id="password" name="password" aria-label="Username" aria-describedby="basic-addon1" value="{{ $user->password }}">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">User Fullname</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Fullname" value="{{ $user->nama_user }}">
                        @if($errors->has('name'))
                            <div class="text-danger">
                                <small>{{ $errors->first('name')}}</small>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="genderRadiosMale" class="col-sm-2 col-form-label">Gender</label>
                    <div class="col-sm-10">
                        @if ($user->jenis_kelamin == "male")
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="genderRadios" id="genderRadiosMale" value="male" checked>
                                <label class="form-check-label" for="genderRadiosMale">
                                Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="genderRadios" id="genderRadiosFemale" value="female">
                                <label class="form-check-label" for="genderRadiosFemale">
                                Female
                                </label>
                            </div>
                        @else
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="genderRadios" id="genderRadiosMale" value="male">
                                <label class="form-check-label" for="genderRadiosMale">
                                Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="genderRadios" id="genderRadiosFemale" value="female" checked>
                                <label class="form-check-label" for="genderRadiosFemale">
                                Female
                                </label>
                            </div>
                        @endif
                        @if($errors->has('genderRadios'))
                            <div class="text-danger">
                                <small>{{ $errors->first('genderRadios')}}</small>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="role" class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <select name="role" id="role" class="form-control">
                            <option value="" selected disabled>> Select user role <</option>
                            @foreach ($level as $levels)
                                @if ($levels->id == $user->id_level)
                                    <option value="{{ $levels->id }}" selected>{{ $levels->nama_level }}</option>
                                @else
                                    <option value="{{ $levels->id }}">{{ $levels->nama_level }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if($errors->has('role'))
                            <div class="text-danger">
                                <small>{{ $errors->first('role')}}</small>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <a href="{{ url('/adashboard/users') }}" class="btn btn-danger float-right">Cancel</a>
                    </div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
