@extends('layout/AdminMain')

@section('title', 'Add New Goods')

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
                    <li class="breadcrumb-item"><a href="{{ url('/adashboard/seats') }}">Seats</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Seats</li>
                </ol>
            </nav>

@endsection

@section('konten')
    <h1 class="h3 mb-4 text-gray-800">Add Seats Management</h1>

    <form method="POST" action="/seats/add">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Add New Seats</h6>
                <span>please complete this form</span>
            </div>
            <div class="card-body">

               @csrf

                <div class="form-group row">
                    <label for="nomeja" class="col-sm-2 col-form-label">Seat Number</label>
                    <div class="col-sm-10">
                        <div class="input-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">S-</span>
                            </div>
                            <input type="number" class="form-control" id="nomeja" name="nomeja" placeholder="Enter Seat Number" value="{{ old('nomeja') }}">
                        </div>
                        @if($errors->has('nomeja'))
                            <div class="text-danger">
                                <small>{{ $errors->first('nomeja')}}</small>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <a href="{{ url('/adashboard/seats') }}" class="btn btn-danger float-right">Cancel</a>
                    </div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
