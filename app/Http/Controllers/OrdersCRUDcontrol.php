<?php

namespace App\Http\Controllers;

use App\Order;
use App\Orderdetail;
use App\Food;
use App\Seat;
use App\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Support\Facades\Auth;

use function GuzzleHttp\Promise\all;

class OrdersCRUDcontrol extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if (Auth::user()->id_level == 2) {
            $order = Order::all();
            $meja = Seat::all();
            $detail_order = Orderdetail::all();
            $hitung_order = Order::all()->count();
            $order_detail = Orderdetail::all();
            $hitung_order_selesai = Order::where('status_order', 'received and has been paid')->count();
            $hitung_order_belumselesai = Order::where('status_order', 'received and not yet paid')->count();

            $data = [
                'order' => $order,
                'meja' => $meja,
                'detail_order' => $detail_order,
                'hitung_order' => $hitung_order,
                'order_selesai' => $hitung_order_selesai,
                'order_belumselesai' => $hitung_order_belumselesai,
                'makanan' => Food::all()
            ];

            return view('waiter/m_order', $data);
        }else{
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        if (Auth::user()->id_level == 2) {
            $meja = Seat::all();
            $makanan = Food::where('status_masakan', 'available')->get();
            $mentah = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $mentah_acak = substr(str_shuffle($mentah), 0, 5);
            $data = [
                'meja' => $meja,
                'makanan' => $makanan,
                'kode_nuklir' => "KTB".$mentah_acak."OR"
            ];
            return view('waiter/t_order', $data);
        }else{
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        if (Auth::user()->id_level == 2) {
            // validation
                $rule_message = [
                    // 'kodenuklir.required'=>'You cant leave oder code field empty',
                    'tanggal.required'=>'Please fill out this field',
                    'nomeja.required'=>'Please fill out this field',
                    'jumlah.required'=>'Please fill out this field',
                    'keterangan.required'=>'Please fill out this field'
                ];
                $rules = [
                    // 'kodenuklir' => 'required',
                    'tanggal' => 'required',
                    'nomeja' => 'required',
                    'jumlah' => 'required',
                    'keterangan' => 'required'
                ];

                $this->validate($request, $rules, $rule_message);

                $stok = Food::where('id', $request->namamasakan)->first();
                $kurangin = $stok->stok - $request->jumlah;
                // dd($kurangin);
                if($request->jumlah > $stok->stok){
                    return redirect()->back()->with('fail', "the number of quantity must not exceed the food stock, the current food stock amount is $stok->stok");
                }else{

                    $order = Order::create([
                        'kode_order' => $request->kode_order,
                        'id_meja' => $request->nomeja,
                        'tanggal' => $request->tanggal,
                        'id_user' => $request->id_petugas,
                        'id_user' => $request->id_petugas,
                        'keterangan' => $request->keterangan,
                        'status_order' => 'received and not yet paid'
                    ]);

                    Orderdetail::create([
                        'id_order' => $order->id,
                        'id_masakan' => $request->namamasakan,
                        'harga' => $request->hargamasakan,
                        'jumlah' => $request->jumlah
                        ]);

                        $datastok = [
                        'stok' => $kurangin
                    ];

                    Food::where('id', $request->namamasakan)->update($datastok);

                    return redirect('/wdashboard/orders')->with('success', "Order ->{$request->kode_order}<- has been successfully send !");
                }
        }else{
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order){
        if (Auth::user()->id_level == 2) {
            $user = User::all();
            $meja = Seat::all();
            $makanan = Food::all();
            // dd($orderdetail = Orderdetail::where('id_order', $order->id)->first());
            $orderdetail = Orderdetail::where('id_order', $order->id)->first();
            $data = [
                'user' => $user,
                'order' => $order,
                'meja' => $meja,
                'makanan' => $makanan,
                'orderdetail' => $orderdetail,
            ];
            return view('waiter/d_order', $data);
        }else{
            return redirect()->back();
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
