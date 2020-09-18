@extends('layout/WaiterMain')

@section('title', 'Orders')

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
                    <li class="breadcrumb-item active" aria-current="page">Orders</li>
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
                        <button type="button" class="btn btn-outline-primary">Waiter</button>
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
    <h1 class="h3 mb-4 text-gray-800">Orders Management</h1>

     <!-- Content Row -->
    <div class="row">

        <!-- order -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Orders</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{$hitung_order}}
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-fw fa-2x text-gray-300 fa-cash-register"></i>
                </div>
                </div>
            </div>
            </div>
        </div>

        {{-- order belum selesai --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Orders Are Being Processed</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{$order_belumselesai}}
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-fw fa-2x text-gray-300 fa-cash-register"></i>
                </div>
                </div>
            </div>
            </div>
        </div>

        {{-- order diterima --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">orders has been received</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{$order_selesai}}
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-fw fa-2x text-gray-300 fa-cash-register"></i>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>

      <!-- Content Row -->

    <div class="card shadow mb-4">
         <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Orders Data</h6>
                <a href="{{ url('/wdashboard/addneworders') }}" class="btn btn-primary float-right">Add New Order</a>
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

            <table class="table table-striped table-bordered table-hover table-sm" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Order date</th>
                        <th>Seat Number</th>
                        <th>Status</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order as $orders)
                        <tr>
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>
                                {{$orders->tanggal}}
                            </td>
                            <td>
                                @foreach ($meja as $seats)
                                    @if ($orders->id_meja == $seats->id)
                                        {{$seats->no_meja}}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <button class="btn btn-outline-success">
                                    {{$orders->status_order}}
                                </button>
                            </td>
                            <td>
                                @foreach ($detail_order as $orderdetails)
                                    @if ($orders->id == $orderdetails->id_order)
                                        {{$orderdetails->jumlah}}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ url('/wdashboard/orders/detail/'.$orders->id) }}" class="btn btn-primary">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Order date</th>
                        <th>Seat Number</th>
                        <th>Status</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
