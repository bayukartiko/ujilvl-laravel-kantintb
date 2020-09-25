@extends('layout/KasirMain')

@section('title', 'Generate Report - Cashier')

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
                    <li class="breadcrumb-item active" aria-current="page">Report data</li>
                </ol>
            </nav>

@endsection

@section('konten')
    <div class="row d-flex justify-content-center align-items-center" style="height:500px;">
        <div class="w-90" style="width: 50%">
            <div class="card border-left-primary shadow h-100">
                <form method="POST" action="/kreport/print" enctype="multipart/form-data">

                    @csrf

                    <div class="card-header">
                        Report data management
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="pilihan_report" class="col-form-label">Select data</label>
                                <select name="pilihan_report" id="pilihan_report" class="form-control" required>
                                    <option value="" selected disabled>> Select Data <</option>
                                    <option value="transaksi">Transaction data</option>
                                </select>
                                @if($errors->has('pilihan_report'))
                                    <div class="text-danger">
                                        <small>{{ $errors->first('pilihan_report')}}</small>
                                    </div>
                                @endif

                            <div id="chain1"></div>
                            <div id="chain2"></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Print data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
