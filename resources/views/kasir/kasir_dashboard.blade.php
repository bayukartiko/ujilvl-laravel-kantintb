@extends('layout/KasirMain')

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
    <a href="{{ url('/kdashboard/transactions') }}">
        <h2 class="text-center">- Transactions Data -</h2>
    </a>
    <div class="row justify-content-center">

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
@endsection
