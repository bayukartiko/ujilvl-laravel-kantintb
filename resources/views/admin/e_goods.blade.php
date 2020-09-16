@extends('layout/AdminMain')

@section('title', 'Edit Foods')

@section('topbar')

    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

        <!-- Topbar Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mt-3">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard/goods') }}">Foods</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Foods</li>
                </ol>
            </nav>

        <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Bayu Kartiko</span>
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
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        Activity Log
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
    <h1 class="h3 mb-4 text-gray-800">Edit Foods Management</h1>

    <form method="POST" action="/goods/update/{{ $makanan->id }}">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit Foods</h6>
                <span>please complete this form</span>
            </div>
            <div class="card-body">

                @csrf
                @method('PATCH')

                <div class="form-group row">
                    <label for="namamasakan" class="col-sm-2 col-form-label">Food Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="namamasakan" name="namamasakan" placeholder="Input Food Name" value="{{ $makanan->nama_masakan }}">
                        @if($errors->has('namamasakan'))
                            <div class="text-danger">
                                <small>{{ $errors->first('namamasakan')}}</small>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tipemasakan" class="col-sm-2 col-form-label">Type of Food</label>
                    <div class="col-sm-10">
                        <select name="tipemasakan" id="tipemasakan" class="form-control">
                            @foreach ($tipemasakan as $type)
                                @if ($type == $makanan->jenis_masakan)
                                    <option value="{{ $type }}" selected>{{ $type }}</option>
                                @else
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if($errors->has('tipemasakan'))
                            <div class="text-danger">
                                <small>{{ $errors->first('tipemasakan')}}</small>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hargamasakan" class="col-sm-2 col-form-label">Food Price</label>
                    <div class="col-sm-10">
                        <div class="input-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                            </div>
                            <input type="number" class="form-control" id="hargamasakan" name="hargamasakan" placeholder="Input Food Price" value="{{ $makanan->harga }}">
                        </div>
                        @if($errors->has('hargamasakan'))
                            <div class="text-danger">
                                <small>{{ $errors->first('hargamasakan')}}</small>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="statusmasakan" class="col-sm-2 col-form-label">Food Status</label>
                    <div class="col-sm-10">
                        <select name="statusmasakan" id="statusmasakan" class="form-control">
                            @foreach ($statusmasakan as $status)
                                @if ($status == $makanan->status_masakan)
                                    <option value="{{ $status }}" selected>{{ $status }}</option>
                                @else
                                    <option value="{{ $status }}">{{ $status }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if($errors->has('statusmasakan'))
                            <div class="text-danger">
                                <small>{{ $errors->first('statusmasakan')}}</small>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <a href="{{ url('/dashboard/goods') }}" class="btn btn-danger float-right">Cancel</a>
                    </div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
