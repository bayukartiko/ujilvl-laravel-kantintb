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
                        <button type="button" class="btn btn-outline-primary">Waiter</button>
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
    <div class="row">
        <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
    </div>
    <div class="row row-cols-1 row-cols-md-4 justify-content-center" style="margin: auto;">
        @foreach ($food as $foods)
            <div class="col mb-4">
                <div class="card h-100 text-center" style="width: 14rem;">
                    <img src="{{asset('img/bg/image.png')}}" class="card-img-top mt-3 mb-3" style="width: 50px; height: 50px; margin:auto;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $foods->nama_masakan }}</h5>
                        <p class="card-text">Rp. <?= number_format( $foods->harga ,2,',','.') ?></p>
                        <a href="/wdashboard/addneworders" class="btn btn-primary main_btn">Order</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
