@extends('layout/AdminMain')

@section('title', 'Seats')

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
                    <li class="breadcrumb-item active" aria-current="page">Seats</li>
                </ol>
            </nav>

@endsection

@section('konten')
    <h1 class="h3 mb-4 text-gray-800">Seats Management</h1>

     <!-- Content Row -->
    <div class="row">

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

      <!-- Content Row -->

    <div class="card shadow mb-4">
         <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Seats Data</h6>
                <a href="{{ url('/adashboard/addnewseats') }}" class="btn btn-primary">Add New Seats</a>
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
                        <th>Seat Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($meja as $seats)
                        <tr>
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>{{ $seats->no_meja }}</td>
                            <td>
                                <a href="{{ url('/adashboard/seats/delete/'.$seats->id) }}" class="btn btn-danger" onclick="return confirm('sure? you will delete data permanently.');">Delete</a>
                                @if ($seats->trashed())
                                    <a href="{{ url('/adashboard/seats/activate/'.$seats->id) }}" class="btn btn-primary" onclick="return confirm('sure? you will activate this data ?');">Activate</a>
                                @else
                                    <a href="{{ url('/adashboard/seats/deactivate/'.$seats->id) }}" class="btn btn-secondary" onclick="return confirm('sure? you will disable this data for temporary ?');">Disable</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Seat Number</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
