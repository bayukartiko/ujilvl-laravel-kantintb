@extends('layout/WaiterMain')

@section('title', 'Dashboard')

@section('topbar')

    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

        <!-- Topbar Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mt-3">
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>

@endsection

@section('konten')
    <div class="row">
        <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
    </div>
    <div class="row d-flex justify-content-center align-items-center" style="height:450px;">
        <div class="w-80">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ Auth::user()->nama_user }}</div>

                        </div>
                        <div class="col-auto">
                            {{-- <i class="fas fa-fw fa-2x text-gray-300 fa-cash-register"></i> --}}
                            <img src="{{ URL::asset('storage/'.Auth::user()->avatar) }}" class="img-thumbnail" height="100" width="100">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="h5 mb-0 font-weight-bold text-gray-800 d-flex">
                        <a href="{{ url('/wdashboard/profil') }}" class="btn btn-outline-primary">Change Profile</a>
                        &nbsp;|&nbsp;
                        <a href="{{ url('/wdashboard/password') }}" class="btn btn-outline-primary">Change Password</a>
                        &nbsp;|&nbsp;
                        <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#logoutModal">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        {{-- @foreach ($food as $foods)
            <div class="col mb-4">
                <div class="card h-100 text-center" style="width: 14rem;">
                    <img src="{{ URL::asset('storage/'.$foods->gambar) }}" class="card-img-top" style="display: inline-block;" height="200px" width="200px">
                    <div class="card-body">
                        <h5 class="card-title">{{ $foods->nama_masakan }}</h5>
                        <p class="card-text">Rp. </?= number_format( $foods->harga ,2,',','.') ?></p>
                        <a href="/wdashboard/addneworders" class="btn btn-primary main_btn">Order</a>
                    </div>
                </div>
            </div>
        @endforeach --}}
    </div>
@endsection
