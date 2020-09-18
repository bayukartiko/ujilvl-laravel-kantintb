@extends('layout/WaiterMain')

@section('title', 'Add New Foods')

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
                    <li class="breadcrumb-item"><a href="{{ url('/wdashboard/goods') }}">Foods</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Foods</li>
                </ol>
            </nav>

@endsection

@section('konten')
    <h1 class="h3 mb-4 text-gray-800">Add Foods Management</h1>

    <form method="POST" action="/goods/add">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Add New Foods</h6>
                <span>please complete this form</span>
            </div>
            <div class="card-body">

               @csrf

                <div class="form-group row">
                    <label for="namamasakan" class="col-sm-2 col-form-label">Food Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="namamasakan" name="namamasakan" placeholder="Input Food Name" value="{{ old('namamasakan') }}">
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
                            <option value="" selected disabled>> Select type this food <</option>
                            <option value="food">food</option>
                            <option value="drink">drink</option>
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
                            <input type="number" class="form-control" id="hargamasakan" name="hargamasakan" placeholder="Input Food Price" value="{{ old('hargamasakan') }}">
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
                            <option value="" selected disabled>> Select food status <</option>
                            <option value="available">available</option>
                            <option value="run out">run out</option>
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
                        <a href="{{ url('/wdashboard/goods') }}" class="btn btn-danger float-right">Cancel</a>
                    </div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
