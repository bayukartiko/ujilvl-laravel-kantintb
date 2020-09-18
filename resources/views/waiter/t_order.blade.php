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
    <h1 class="h3 mb-4 text-gray-800">Add New Order Management</h1>

    <form method="POST" action="/orders/add">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Add New Order</h6>
                <span>please complete this form</span>
            </div>
            <div class="card-body">

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
                                <option value="{{$foods->id}}">{{$foods->nama_masakan}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('namamasakan'))
                            <div class="text-danger">
                                <small>{{ $errors->first('namamasakan')}}</small>
                            </div>
                        @endif
                    </div>
                </div>
                {{-- <div class="form-group row">
                    <label for="hargamasakan" class="col-sm-2 col-form-label">Food Price</label>
                    <div class="col-sm-10">
                        <div class="input-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                            </div>
                            <input type="number" class="form-control" id="hargamasakan" name="hargamasakan" value="{{ old('hargamasakan') }}" readonly>
                        </div>
                        @if($errors->has('hargamasakan'))
                            <div class="text-danger">
                                <small>{{ $errors->first('hargamasakan')}}</small>
                            </div>
                        @endif
                    </div>
                </div> --}}
                <div class="form-group row">
                    <label for="jumlah" class="col-sm-2 col-form-label">Order Quantity</label>
                    <div class="col-sm-10">
                        <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Enter order quantity">
                        @if($errors->has('jumlah'))
                            <div class="text-danger">
                                <small>{{ $errors->first('jumlah')}}</small>
                            </div>
                        @endif
                    </div>
                </div>
                {{-- <div class="form-group row">
                    <label for="totalharga" class="col-sm-2 col-form-label">Total price</label>
                    <div class="col-sm-10">
                        <div class="input-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                            </div>
                            <input type="number" class="form-control" id="totalharga" name="totalharga" value="{{ old('totalharga') }}" readonly>
                        </div>
                        @if($errors->has('totalharga'))
                            <div class="text-danger">
                                <small>{{ $errors->first('totalharga')}}</small>
                            </div>
                        @endif
                    </div>
                </div> --}}
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-2 col-form-label">Order information</label>
                    <div class="col-sm-10">
                        <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control" placeholder="Enter order information to cashier"></textarea>
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
