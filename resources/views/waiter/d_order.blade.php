@extends('layout/WaiterMain')

@section('title', 'Detail Orders')

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
                    <li class="breadcrumb-item active" aria-current="page">Detail orders</li>
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
                <h6 class="float-right m-0 font-weight-bold">Order Date : {{ $order->tanggal }}</h6>
            </div>
            <div class="card-body">
                <fieldset disabled="disabled">

                    @csrf

                    <div class="form-group">
                        <label for="waiter" class="col-form-label">Waiter's name</label>
                            @foreach ($user as $users)
                                @if ($users->id == $order->id_user)
                                    @php
                                        $namauser = $users->nama_user;
                                    @endphp
                                @endif
                            @endforeach
                            <input type="text" class="form-control" id="waiter" name="waiter" placeholder="Input Food Name" value="<?= $namauser ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="nomeja" class="col-form-label">Seat Number</label>
                            <select name="nomeja" id="nomeja" class="form-control" disabled>
                                @foreach ($meja as $seats)
                                    @if ($seats->id == $order->id_meja)
                                        <option value="{{$seats->id}}" selected disabled>{{$seats->no_meja}}</option>
                                    @endif
                                @endforeach
                            </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="namamasakan" class="col-form-label">Food Name</label>
                                    <select name="namamasakan" id="namamasakan" class="form-control" disabled>
                                        {{-- @foreach ($orderdetail as $orderdetails) --}}
                                            @foreach ($makanan as $foods)
                                                @if ($foods->id == $orderdetail->id_masakan)
                                                    <option value="{{$foods->id}}" selected disabled>{{$foods->nama_masakan}}</option>
                                                @endif
                                            @endforeach
                                        {{-- @endforeach --}}
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="hargamasakan" class="col-form-label">Food Price</label>
                                    <div class="input-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                                        </div>
                                        @foreach ($makanan as $foods)
                                            @if ($foods->id == $orderdetail->id_masakan)
                                                @php
                                                    $harga = $foods->harga;
                                                @endphp
                                            @endif
                                        @endforeach
                                        <input type="number" class="form-control" id="hargamasakan" name="hargamasakan" value="<?= $harga ?>" disabled>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label for="jumlah" class="col-form-label">Order Quantity</label>
                                    <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Enter order quantity" value="{{ $orderdetail->jumlah }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="totalharga" class="col-form-label">Total price</label>
                                    <div class="input-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">Rp</span>
                                        </div>
                                        @foreach ($makanan as $foods)
                                            @if ($foods->id == $orderdetail->id_masakan)
                                                @php
                                                    $totalharga = $foods->harga*$orderdetail->jumlah ;
                                                @endphp
                                            @endif
                                        @endforeach
                                        <input type="number" class="form-control" id="totalharga" name="totalharga" value="<?= $totalharga ?>" disabled>
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <img src="
                            @foreach ($makanan as $foods)
                                @if ($foods->id == $orderdetail->id_masakan)
                                    {{ URL::asset('storage/'.$foods->gambar) }}
                                @endif
                            @endforeach" class="img-fluid img-thumbnail" style="display: inline-block;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="keterangan" class="col-form-label">Order information</label>
                            <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control" placeholder="Enter order information to cashier" disabled>{{ $order->keterangan }}</textarea>
                    </div>
                </fieldset>
                    <div class="form-group">
                        <a href="{{ url('/wdashboard/orders') }}" class="btn btn-primary">Understand</a>
                    </div>
                </div>
            </div>
    </form>
@endsection
