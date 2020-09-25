@extends('layout/OwnerMain')

@section('title', 'Edit Profile')

@section('topbar')

    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

        <!-- Topbar Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mt-3">
                    <li class="breadcrumb-item"><a href="{{ url('/odashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
                </ol>
            </nav>

@endsection

@section('konten')
    <h1 class="h3 mb-4 text-gray-800">Edit Profile Management</h1>

    <form method="POST" action="/oprofil/update/{{ $profil->id }}" enctype="multipart/form-data">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit Profile</h6>
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

                @csrf
                @method('PATCH')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username" class="col-form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" value="{{ $profil->username }}" readonly>
                                @if($errors->has('username'))
                                    <div class="text-danger">
                                        <small>{{ $errors->first('username')}}</small>
                                    </div>
                                @endif
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-form-label">User Fullname</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Fullname" value="{{ $profil->nama_user }}" required>
                                @if($errors->has('name'))
                                    <div class="text-danger">
                                        <small>{{ $errors->first('name')}}</small>
                                    </div>
                                @endif
                        </div>
                        <div class="form-group">
                            <label for="genderRadiosMale" class="col-form-label">Gender</label>
                                @if ($profil->jenis_kelamin == "male")
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
                        <div class="form-group">
                            <label for="alamat" class="col-form-label">Address</label>
                                <textarea class="form-control" id="alamat" name="alamat" cols="10" rows="5" placeholder="Enter user address" required>{{ $profil->alamat }}</textarea>
                                @if($errors->has('alamat'))
                                    <div class="text-danger">
                                        <small>{{ $errors->first('alamat')}}</small>
                                    </div>
                                @endif
                        </div>
                        <div class="form-group">
                            <label for="nohp" class="col-form-label">Phone number</label>
                                <input type="number" class="form-control" id="nohp" name="nohp" cols="10" rows="5" placeholder="Enter phone number" value="{{ $profil->nohp }}" required>
                                @if($errors->has('nohp'))
                                    <div class="text-danger">
                                        <small>{{ $errors->first('nohp')}}</small>
                                    </div>
                                @endif
                        </div>
                        <div class="form-group">
                            <label for="pp" class="col-form-label">Profile Picture</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="pp" name="pp" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="pp">Choose file</label>
                                </div>
                                @if($errors->has('pp'))
                                    <div class="text-danger">
                                        <small>{{ $errors->first('pp')}}</small>
                                    </div>
                                @endif
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <img src="{{ URL::asset('storage/'.$profil->avatar) }}" class="center-bloock img-fluid img-thumbnail" style="display: inline-block;">
                    </div>
                </div>

                <div class="form-group">
                    <label for="role" class="col-form-label">Role</label>
                        <select name="role" id="role" class="form-control">
                            @foreach ($level as $levels)
                                @if ($levels->id == $profil->id_level)
                                    <option value="{{ $levels->id }}" selected disabled>{{ $levels->nama_level }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if($errors->has('role'))
                            <div class="text-danger">
                                <small>{{ $errors->first('role')}}</small>
                            </div>
                        @endif
                </div>

                <div class="form-group">
                    <a href="{{ url('/odashboard') }}" class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </div>
        </div>
    </form>
@endsection
