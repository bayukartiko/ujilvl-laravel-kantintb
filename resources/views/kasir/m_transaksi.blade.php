@extends('layout/KasirMain')

@section('title', 'Transactions')

@section('topbar')

    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

        <!-- Topbar Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mt-3">
                    <li class="breadcrumb-item"><a href="{{ url('/kdashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Transactions</li>
                </ol>
            </nav>

@endsection

@section('konten')
    <h1 class="h3 mb-4 text-gray-800">Transactions Management</h1>

     <!-- Content Row -->
        <div class="row">

            <!-- order masuk -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Incoming Orders</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{$hitung_order_masuk}}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-fw fa-2x text-gray-300 fa-cash-register"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- order selesai --}}
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Order Complete</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{$hitung_order_selesai}}
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
                <h6 class="m-0 font-weight-bold text-primary">Transactions Data</h6>
                {{-- <a href="{{ url('/kdashboard/addnewgoods') }}" class="btn btn-primary">Add New Foods</a> --}}
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
                        <th>Transaction Code</th>
                        <th>Waiter's Name</th>
                        <th>Seat Number</th>
                        <th>Food Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order as $orders)
                        <tr>
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>
                                @foreach ($transaksi as $transactions)
                                    @if ($orders->id == $transactions->id_order)
                                        {{$transactions->kode_transaksi}}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($user as $users)
                                    @if ($orders->id_user == $users->id)
                                        {{$users->nama_user}}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($meja as $seats)
                                    @if ($orders->id_meja == $seats->id)
                                        {{$seats->no_meja}}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($detail_order as $orderdetails)
                                    @foreach ($makanan as $foods)
                                        @if ($orders->id == $orderdetails->id_order)
                                            @if ($orderdetails->id_masakan == $foods->id)
                                                {{$foods->nama_masakan}}
                                            @endif
                                        @endif
                                    @endforeach
                                @endforeach
                            </td>
                            <td>
                                <button class="btn btn-outline-success">
                                    {{$orders->status_order}}
                                </button>
                            </td>
                            <td>
                                @if ($orders->status_order == "received and has been paid")
                                    <a href="{{ url('/kdashboard/transactions/detail/'.$orders->id) }}" class="btn btn-primary">detail</a>
                                @else
                                    <a href="{{ url('/kdashboard/transactions/payment/'.$orders->id) }}" class="btn btn-primary">continue to payment</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Transaction Code</th>
                        <th>Waiter's Name</th>
                        <th>Seat Number</th>
                        <th>Food Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
