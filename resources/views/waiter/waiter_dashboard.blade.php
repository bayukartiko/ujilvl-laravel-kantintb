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
    <div class="row row-cols-1 row-cols-md-4 justify-content-center" style="margin: auto;">
        @foreach ($food as $foods)
            <div class="col mb-4">
                <div class="card h-100 text-center" style="width: 14rem;">
                    <img src="{{ URL::asset('storage/'.$foods->gambar) }}" class="card-img-top" style="display: inline-block;" height="200px" width="200px">
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
