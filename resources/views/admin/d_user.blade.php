@extends('layout/AdminMain')

@section('title', 'Detail Users')

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
                    <li class="breadcrumb-item active" aria-current="page">Detail Users</li>
                </ol>
            </nav>

@endsection

@section('konten')
    <h1 class="h3 mb-4 text-gray-800">Detail Users Management</h1>

    <form method="POST" action="#">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Detail Users</h6>
            </div>
            <div class="card-body">
                <fieldset disabled="disabled">

                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username" class="col-form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" value="{{ $user->username }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-form-label">User Fullname</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Fullname" value="{{ $user->nama_user }}">
                            </div>
                            <div class="form-group">
                                <label for="genderRadiosMale" class="col-form-label">Gender</label>
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
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="col-form-label">Address</label>
                                    <textarea class="form-control" id="alamat" name="alamat" cols="10" rows="5" placeholder="Enter user address">{{ $user->alamat }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="nohp" class="col-form-label">Phone number</label>
                                    <input type="number" class="form-control" id="nohp" name="nohp" cols="10" rows="5" placeholder="Enter phone number" value="{{ $user->nohp }}">
                            </div>
                            <div class="form-group">
                                <label for="pp" class="col-form-label">Profile Picture</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="pp" name="pp" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="pp">Choose file</label>
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <img src="{{ URL::asset('storage/'.$user->avatar) }}" class="center-bloock img-fluid img-thumbnail" style="display: inline-block;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="role" class="col-form-label">Role</label>
                            <select name="role" id="role" class="form-control">
                                @foreach ($level as $levels)
                                    @if ($levels->id == $user->id_level)
                                        <option value="{{ $levels->id }}" selected disabled>{{ $levels->nama_level }}</option>
                                    @endif
                                @endforeach
                            </select>
                    </div>
                </fieldset>
                <div class="form-group">
                    <a href="{{ url('/adashboard/users') }}" class="btn btn-primary">Understand</a>
                </div>
            </div>
        </div>
    </form>
@endsection
