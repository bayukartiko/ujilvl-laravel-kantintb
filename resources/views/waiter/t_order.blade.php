@extends('layout/WaiterMain')

@section('title', 'Add New Orders')

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
                    <li class="breadcrumb-item"><a href="{{ url('/wdashboard/orders') }}">Orders</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Order</li>
                </ol>
            </nav>

@endsection

@section('konten')
    <h1 class="h3 mb-4 text-gray-800">Add New Order Management</h1>

    <form method="POST" action="/orders/add">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Add New Order</h6>
                <h6 class="m-0 font-weight-bold text-primary float-right">{{ $kode_nuklir }}</h6>
                <input type="hidden" id="kode_order" name="kode_order" value="{{ $kode_nuklir }}">
            </div>
            <div class="card-body">

                @if (session()->has('fail'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session()->get('fail') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

               @csrf

                {{-- <div class="form-group row">
                    <label for="kodenuklir" class="col-sm-2 col-form-label">Order code</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kodenuklir" name="kodenuklir" placeholder="Input Food Name" value="ORD{{ $kode_nuklir }}KTB" readonly>
                        @if($errors->has('kodenuklir'))
                            <div class="text-danger">
                                <small>{{ $errors->first('kodenuklir')}}</small>
                            </div>
                        @endif
                    </div>
                </div> --}}
                <div class="form-group row">
                    <label for="waiter" class="col-sm-2 col-form-label">Waiter's name</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="id_petugas" value="{{ Auth::user()->id ?? '' }}">
                        <input type="text" class="form-control" id="waiter" name="waiter" placeholder="Input Food Name" value="{{ Auth::user()->nama_user ?? '' }}" readonly>
                        @if($errors->has('waiter'))
                            <div class="text-danger">
                                <small>{{ $errors->first('waiter')}}</small>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tanggal" class="col-sm-2 col-form-label">Order date</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="tanggal" name="tanggal" placeholder="Input Food Name" value="<?= date('Y/m/d') ?>" readonly>
                        @if($errors->has('tanggal'))
                            <div class="text-danger">
                                <small>{{ $errors->first('tanggal')}}</small>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nomeja" class="col-sm-2 col-form-label">Seat Number</label>
                    <div class="col-sm-10">
                        <select name="nomeja" id="nomeja" class="form-control" required>
                            <option value="" selected disabled>> select seats number <</option>
                            @foreach ($meja as $seats)
                                <option value="{{$seats->id}}">{{$seats->no_meja}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('nomeja'))
                            <div class="text-danger">
                                <small>{{ $errors->first('nomeja')}}</small>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="namamasakan" class="col-sm-2 col-form-label">Food Name</label>
                    <div class="col-sm-10">
                        <select name="namamasakan" id="namamasakan" class="form-control">
                            <option value="" selected disabled>> select food name <</option>
                            @foreach ($makanan as $foods)
                                @if ($foods->stok == 0)
                                    <option value="{{$foods->id}}" disabled>{{$foods->nama_masakan}} | run out</option>
                                @else
                                    <option value="{{$foods->id}}">{{$foods->nama_masakan}}</option>
                                @endif
                            @endforeach
                        </select>
                        @if($errors->has('namamasakan'))
                            <div class="text-danger">
                                <small>{{ $errors->first('namamasakan')}}</small>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jumlah" class="col-sm-2 col-form-label">Order Quantity</label>
                    <div class="col-sm-10">
                        <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Enter order quantity" value="{{ old('jumlah') }}">
                        @if($errors->has('jumlah'))
                            <div class="text-danger">
                                <small>{{ $errors->first('jumlah')}}</small>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-2 col-form-label">Order information</label>
                    <div class="col-sm-10">
                        <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control" placeholder="Enter order information to cashier">{{ old('keterangan') }}</textarea>
                        @if($errors->has('keterangan'))
                            <div class="text-danger">
                                <small>{{ $errors->first('keterangan')}}</small>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <a href="{{ url('/wdashboard/orders') }}" class="btn btn-danger float-right">Cancel</a>
                    </div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
