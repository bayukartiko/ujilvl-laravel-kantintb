@extends('layout/AdminMain')

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
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
    <!-- Content Row user -->
        <a href="{{ url('/dashboard/users') }}">
            <h2 class="text-center">- User Data -</h2>
        </a>
        <div class="row justify-content-center">

            <!-- semua admin -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Available Admin</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{$hitung_admin}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fw fa-2x text-gray-300 fa-user-tie"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

            <!-- semua waiter -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Available Waiter</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{$hitung_waiter}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fw fa-2x text-gray-300 fa-user-tie"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

            <!-- semua kasir -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Available Cashier</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{$hitung_kasir}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fw fa-2x text-gray-300 fa-user-tie"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

            <!-- semua owner -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Available Owner</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{$hitung_owner}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fw fa-2x text-gray-300 fa-user-tie"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
        </div>
    <hr>
    <!-- Content Row meja -->
        <a href="{{ url('/dashboard/seats') }}">
            <h2 class="text-center">- Seats Data -</h2>
        </a>
        <div class="row justify-content-center">

            <!-- semua meja -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Available Seats</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{$hitung_meja}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fw fa-2x text-gray-300 fa-chair"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

            <!-- semua meja aktif -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Seats Activated</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{$hitung_meja_aktif}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fw fa-2x text-gray-300 fa-chair"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

            <!-- semua meja tidak aktif -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Seats Disabled</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{$hitung_meja_notaktif}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fw fa-2x text-gray-300 fa-chair"></i>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
        </div>
    <hr>
    {{-- content row barang --}}
        <a href="{{ url('/dashboard/goods') }}">
            <h2 class="text-center">- Foods Data -</h2>
        </a>
        <div class="row justify-content-center">

            <!-- food -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Available Foods</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{$hitung_makanan}}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-2x text-gray-300 fa-hamburger"></i>
                    </div>
                    </div>
                </div>
                </div>
            </div>

            {{-- drink --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Available Drinks</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{$hitung_minuman}}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-fw fa-2x text-gray-300 fa-coffee"></i>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
@endsection
