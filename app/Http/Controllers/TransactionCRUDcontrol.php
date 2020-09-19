<?php

namespace App\Http\Controllers;

use App\User;
use App\Seat;
use App\Food;
use App\Order;
use App\Orderdetail;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionCRUDcontrol extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = User::all();
        $order = Order::all();
        $meja = Seat::all();
        $detail_order = Orderdetail::all();
        $hitung_order = Order::all()->count();
        $order_detail = Orderdetail::all();
        $hitung_order_selesai = Order::where('status_order', 'done')->count();
        $hitung_order_belumselesai = Order::where('status_order', 'unfinished')->count();
        $hitung_order_masuk = Order::where('status_order', 'unfinished')->count();
        $hitung_order_selesai = Order::where('status_order', 'done')->count();

        $data = [
            'user' => $user,
            'hitung_order_masuk' => $hitung_order_masuk,
            'hitung_order_selesai' => $hitung_order_selesai,
            'order' => $order,
            'meja' => $meja,
            'detail_order' => $detail_order,
            'hitung_order' => $hitung_order,
            'order_selesai' => $hitung_order_selesai,
            'order_belumselesai' => $hitung_order_belumselesai,
            'makanan' => Food::all()
        ];
        return view('kasir/m_transaksi', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $meja = Seat::all();
        $user = User::all();
        $orderdetail = Orderdetail::where('id_order', $order->id)->first();
        $makanan = Food::where('status_masakan', 'available')->get();
        $data = [
            'meja' => $meja,
            'user' => $user,
            'order' => $order,
            'makanan' => $makanan,
            'orderdetail' => $orderdetail,
        ];

        return view('kasir/d_transaksi', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        // validation
            $rule_message = [
                'tunai.required'=>'You cant leave cash money field empty'
            ];
            $rules = [
                    'tunai' => 'required'
                ];

            $this->validate($request, $rules, $rule_message);

        Order::where('id', $order->id)->update([
            'status_order' => 'done'
        ]);

        Transaction::create([
            'id_user' => Auth::user()->id,
            'id_order' => $order->id,
            'tanggal' => date("Y/m/d"),
            'total_bayar' => $request->tunai
        ]);

        return redirect('/kdashboard/transactions')->with('success', "Order ->{$request->namamasakan}<- has been successfully paid !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
