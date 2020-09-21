@extends('layout/AdminMain')

@section('title', 'Detail Foods')

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
                    <li class="breadcrumb-item"><a href="{{ url('/adashboard/goods') }}">Foods</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Foods</li>
                </ol>
            </nav>

@endsection

@section('konten')
    <h1 class="h3 mb-4 text-gray-800">Detail Foods Management</h1>

    <form method="POST" action="#">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Detail Foods</h6>
            </div>
            <div class="card-body">
                <fieldset disabled="disabled">

                    @csrf

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="namamasakan" class="col-form-label">Food Name</label>
                                    <input type="text" class="form-control" id="namamasakan" name="namamasakan" placeholder="Input Food Name" value="{{ $makanan->nama_masakan }}">
                            </div>
                            <div class="form-group">
                                <label for="tipemasakan" class="col-form-label">Type of Food</label>
                                    <select name="tipemasakan" id="tipemasakan" class="form-control">
                                        @foreach ($tipemasakan as $type)
                                            @if ($type == $makanan->jenis_masakan)
                                                <option value="{{ $type }}" selected>{{ $type }}</option>
                                            @else
                                                <option value="{{ $type }}">{{ $type }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="hargamasakan" class="col-form-label">Food Price</label>
                                    <div class="input-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                                        </div>
                                        <input type="number" class="form-control" id="hargamasakan" name="hargamasakan" placeholder="Input Food Price" value="{{ $makanan->harga }}">
                                    </div>
                            </div>
                            <div class="form-group">
                                <label for="stokmasakan" class="col-form-label">Food Stock</label>
                                    <input type="number" class="form-control" id="stokmasakan" name="stokmasakan" placeholder="Enter Food Stock" value="{{ $makanan->stok }}">
                            </div>
                            <div class="form-group">
                                <label for="statusmasakan" class="col-form-label">Food Status</label>
                                    <select name="statusmasakan" id="statusmasakan" class="form-control">
                                        @foreach ($statusmasakan as $status)
                                            @if ($status == $makanan->status_masakan)
                                                <option value="{{ $status }}" selected>{{ $status }}</option>
                                            @else
                                                <option value="{{ $status }}">{{ $status }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="col-sm-6 text-center">
                            <img src="{{ URL::asset('storage/'.$makanan->gambar) }}" class="img-fluid img-thumbnail" style="display: inline-block;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="infomasakan" class="col-form-label">Food Information</label>
                        <textarea name="infomasakan" id="infomasakan" cols="30" rows="5" class="form-control" placeholder="Enter food information">{{ $makanan->keterangan }}</textarea>
                    </div>

                </fieldset>
                    <div class="form-group">
                        <a href="{{ url('/adashboard/goods') }}" class="btn btn-primary">Understand</a>
                    </div>
                </div>
            </div>
    </form>
@endsection
