<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    @if ($panggilan == "waiter")
        @if ($tipe == "order")
            <h2 class="text-center">Order Data</h2>
            <p class="text-center text-muted">{{ $order->kode_order }}</p>

            <table class="table table-striped table-bordered table-hover table-sm" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Order Code</th>
                        <th>Seat Number</th>
                        <th>Food Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">1</td>
                        <td>
                            {{$order->kode_order}}
                        </td>
                        <td>
                            @foreach ($meja as $seats)
                                @if ($order->id_meja == $seats->id)
                                    {{$seats->no_meja}}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($detail_order as $orderdetails)
                                @if ($order->id == $orderdetails->id_order)
                                    @foreach ($makanan as $foods)
                                        @if ($orderdetails->id_masakan == $foods->id)
                                            {{$foods->nama_masakan}}
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <button class="btn btn-outline-success">
                                {{$order->status_order}}
                            </button>
                        </td>
                    </tr>
                </tbody>
                <tfoot class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Order Code</th>
                        <th>Seat Number</th>
                        <th>Food Name</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
            </table>
        @elseif($tipe == "makanan")

            @if ($jenis == "all")
                <h2 class="text-center">All Foods Data</h2>
            @elseif($jenis == "food")
                <h2 class="text-center">Foods Data</h2>
            @else
                <h2 class="text-center">Drinks Data</h2>
            @endif
            <table class="table table-striped table-bordered table-hover table-sm" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Food Name</th>
                        <th>Type of Food</th>
                        <th>Food Stock</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($makanan as $foods)
                    <tr style="text-align: center; padding:10px;">
                        <td scope="row" class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $foods->nama_masakan }}</td>
                        <td class="align-middle">{{ $foods->jenis_masakan }}</td>
                        <td class="align-middle">{{ $foods->stok }}</td>
                        <td class="align-middle">{{ $foods->harga }}</td>
                        <td class="align-middle">
                            <button class="btn btn-outline-success">{{$foods->status_masakan}}</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Food Name</th>
                        <th>Type of Food</th>
                        <th>Food Stock</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
            </table>

        @endif
    @elseif($panggilan == "kasir")
        <h2 class="text-center">Transaction Data</h2>
        <p class="text-center text-muted">{{ $transaksi->kode_transaksi }}</p>

        <table class="table table-striped table-bordered table-hover table-sm" id="table">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Transaction Code</th>
                    <th>Waiter's Name</th>
                    <th>Seat Number</th>
                    <th>Food Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row">1</td>
                    <td>
                        {{$transaksi->kode_transaksi}}
                    </td>
                    <td>
                        @foreach ($user as $users)
                            @if ($transaksi->id_user == $users->id)
                                {{$users->nama_user}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($meja as $seats)
                            @if ($order->id_meja == $seats->id)
                                {{$seats->no_meja}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        {{-- @foreach ($detail_order as $orderdetails) --}}
                            @foreach ($makanan as $foods)
                                @if ($transaksi->id_order == $orderdetail->id_order)
                                    @if ($orderdetail->id_masakan == $foods->id)
                                        {{$foods->nama_masakan}}
                                    @endif
                                @endif
                            @endforeach
                        {{-- @endforeach --}}
                    </td>
                    <td>
                        <button class="btn btn-outline-success">
                            {{$order->status_order}}
                        </button>
                    </td>
                </tr>
            </tbody>
            <tfoot class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Transaction Code</th>
                    <th>Waiter's Name</th>
                    <th>Seat Number</th>
                    <th>Food Name</th>
                    <th>Status</th>
                </tr>
            </tfoot>
        </table>
    @elseif($panggilan == "owner")
        @if ($tipe == "order")
            <h2 class="text-center">Order Data</h2>
            <p class="text-center text-muted">{{ $order->kode_order }}</p>

            <table class="table table-striped table-bordered table-hover table-sm" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Order Code</th>
                        <th>Seat Number</th>
                        <th>Food Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">1</td>
                        <td>
                            {{$order->kode_order}}
                        </td>
                        <td>
                            @foreach ($meja as $seats)
                                @if ($order->id_meja == $seats->id)
                                    {{$seats->no_meja}}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($detail_order as $orderdetails)
                                @if ($order->id == $orderdetails->id_order)
                                    @foreach ($makanan as $foods)
                                        @if ($orderdetails->id_masakan == $foods->id)
                                            {{$foods->nama_masakan}}
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <button class="btn btn-outline-success">
                                {{$order->status_order}}
                            </button>
                        </td>
                    </tr>
                </tbody>
                <tfoot class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Order Code</th>
                        <th>Seat Number</th>
                        <th>Food Name</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
            </table>
        @elseif($tipe == "makanan")

            @if ($jenis == "all")
                <h2 class="text-center">All Foods Data</h2>
            @elseif($jenis == "food")
                <h2 class="text-center">Foods Data</h2>
            @else
                <h2 class="text-center">Drinks Data</h2>
            @endif
            <table class="table table-striped table-bordered table-hover table-sm" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Food Name</th>
                        <th>Type of Food</th>
                        <th>Food Stock</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($makanan as $foods)
                    <tr style="text-align: center; padding:10px;">
                        <td scope="row" class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $foods->nama_masakan }}</td>
                        <td class="align-middle">{{ $foods->jenis_masakan }}</td>
                        <td class="align-middle">{{ $foods->stok }}</td>
                        <td class="align-middle">{{ $foods->harga }}</td>
                        <td class="align-middle">
                            <button class="btn btn-outline-success">{{$foods->status_masakan}}</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Food Name</th>
                        <th>Type of Food</th>
                        <th>Food Stock</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
            </table>

        @elseif($tipe == "transaksi")

            <h2 class="text-center">Transaction Data</h2>
            <p class="text-center text-muted">{{ $transaksi->kode_transaksi }}</p>

            <table class="table table-striped table-bordered table-hover table-sm" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Transaction Code</th>
                        <th>Waiter's Name</th>
                        <th>Seat Number</th>
                        <th>Food Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">1</td>
                        <td>
                            {{$transaksi->kode_transaksi}}
                        </td>
                        <td>
                            @foreach ($user as $users)
                                @if ($transaksi->id_user == $users->id)
                                    {{$users->nama_user}}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach ($meja as $seats)
                                @if ($order->id_meja == $seats->id)
                                    {{$seats->no_meja}}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            {{-- @foreach ($detail_order as $orderdetails) --}}
                                @foreach ($makanan as $foods)
                                    @if ($transaksi->id_order == $orderdetail->id_order)
                                        @if ($orderdetail->id_masakan == $foods->id)
                                            {{$foods->nama_masakan}}
                                        @endif
                                    @endif
                                @endforeach
                            {{-- @endforeach --}}
                        </td>
                        <td>
                            <button class="btn btn-outline-success">
                                {{$order->status_order}}
                            </button>
                        </td>
                    </tr>
                </tbody>
                <tfoot class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Transaction Code</th>
                        <th>Waiter's Name</th>
                        <th>Seat Number</th>
                        <th>Food Name</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
            </table>

        @elseif($tipe == "user")
            <h2 class="text-center">Users Data</h2>
            @if ($jenis == "all")
                <p class="text-center text-muted">All role</p>
            @elseif($jenis == "admin")
                <p class="text-center text-muted">Admin role</p>
            @elseif($jenis == "waiter")
                <p class="text-center text-muted">Waiter role</p>
            @elseif($jenis == "kasir")
                <p class="text-center text-muted">Cashier role</p>
            @else
                <p class="text-center text-muted">Owner role</p>
            @endif

            <table class="table table-striped table-bordered table-hover table-sm" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>User Fullname</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $users)
                        <tr>
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>{{ $users->username }}</td>
                            <td>{{ $users->nama_user }}</td>
                            <td>
                                @foreach ($level as $levels)
                                    @if ($users->id_level == $levels->id)
                                        {{ $levels->nama_level }}
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>User Fullname</th>
                        <th>Role</th>
                    </tr>
                </tfoot>
            </table>

        @else
            <h2 class="text-center">Seats Data</h2>
            @if ($jenis == "all")
                <p class="text-center text-muted">All seats</p>
            @elseif($jenis == "digunakan")
                <p class="text-center text-muted">Seats used</p>
            @else
                <p class="text-center text-muted">Seats unused</p>
            @endif

            <table class="table table-striped table-bordered table-hover table-sm" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Seat Number</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($meja as $seats)
                        <tr>
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>{{ $seats->no_meja }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Seat Number</th>
                    </tr>
                </tfoot>
            </table>
        @endif
    @endif

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>
