@extends('layout/AdminMain')

@section('title', 'Edit Foods')

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
                    <li class="breadcrumb-item active" aria-current="page">Edit Foods</li>
                </ol>
            </nav>

@endsection

@section('konten')
    <h1 class="h3 mb-4 text-gray-800">Edit Foods Management</h1>

    <form method="POST" action="/agoods/update/{{ $makanan->id }}" enctype="multipart/form-data">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit Foods</h6>
                <span>please complete this form</span>
            </div>
            <div class="card-body">

                @csrf
                @method('PATCH')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="namamasakan" class="col-form-label">Food Name</label>
                                <input type="text" class="form-control" id="namamasakan" name="namamasakan" placeholder="Input Food Name" value="{{ $makanan->nama_masakan }}">
                                @if($errors->has('namamasakan'))
                                    <div class="text-danger">
                                        <small>{{ $errors->first('namamasakan')}}</small>
                                    </div>
                                @endif
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
                                @if($errors->has('tipemasakan'))
                                    <div class="text-danger">
                                        <small>{{ $errors->first('tipemasakan')}}</small>
                                    </div>
                                @endif
                        </div>
                        <div class="form-group">
                            <label for="gambarmasakan" class="col-form-label">Food image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="gambarmasakan" name="gambarmasakan" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="gambarmasakan">Choose file</label>
                                </div>
                                @if($errors->has('gambarmasakan'))
                                    <div class="text-danger">
                                        <small>{{ $errors->first('gambarmasakan')}}</small>
                                    </div>
                                @endif
                        </div>
                        <div class="form-group">
                            <label for="hargamasakan" class="col-form-label">Food Price</label>
                                <div class="input-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                                    </div>
                                    <input type="number" class="form-control" id="hargamasakan" name="hargamasakan" placeholder="Input Food Price" value="{{ $makanan->harga }}">
                                </div>
                                @if($errors->has('hargamasakan'))
                                    <div class="text-danger">
                                        <small>{{ $errors->first('hargamasakan')}}</small>
                                    </div>
                                @endif
                        </div>
                        <div class="form-group">
                            <label for="stokmasakan" class="col-form-label">Food Stock</label>
                                <input type="number" class="form-control" id="stokmasakan" name="stokmasakan" placeholder="Enter Food Stock" value="{{ $makanan->stok }}" min="0">
                                @if($errors->has('stokmasakan'))
                                    <div class="text-danger">
                                        <small>{{ $errors->first('stokmasakan')}}</small>
                                    </div>
                                @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ URL::asset('storage/'.$makanan->gambar) }}" class="img-fluid img-thumbnail">
                    </div>
                </div>

                <div class="form-group">
                    <label for="infomasakan" class="col-form-label">Food Information</label>
                        <textarea name="infomasakan" id="infomasakan" cols="30" rows="5" class="form-control" placeholder="Enter food information">{{ $makanan->keterangan }}</textarea>
                        @if($errors->has('infomasakan'))
                            <div class="text-danger">
                                <small>{{ $errors->first('infomasakan')}}</small>
                            </div>
                        @endif
                </div>

                <div class="form-group">
                    <a href="{{ url('/adashboard/goods') }}" class="btn btn-danger">Cancel</a>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </div>
        </div>
    </form>
@endsection
