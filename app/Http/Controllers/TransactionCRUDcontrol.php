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
    public function index(){
        if (Auth::user()->id_level == 3) {
            $user = User::all();
            $order = Order::all();
            $meja = Seat::all();
            $detail_order = Orderdetail::all();
            $hitung_order = Order::all()->count();
            $order_detail = Orderdetail::all();
            $hitung_order_selesai = Order::where('status_order', 'received and has been paid')->count();
            $hitung_order_belumselesai = Order::where('status_order', 'received and not yet paid')->count();
            $hitung_order_masuk = Order::where('status_order', 'received and not yet paid')->count();
            $hitung_order_selesai = Order::where('status_order', 'received and has been paid')->count();

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
        }else{
            return redirect()->back();
        }
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
    public function show(Transaction $transaction, Order $order)
    {
        if (Auth::user()->id_level == 3) {
            $meja = Seat::all();
            $user = User::all();
            $orderdetail = Orderdetail::where('id_order', $order->id)->first();
            $transaksi = Transaction::where('id_order', $order->id)->first();
            $makanan = Food::all();
            $data = [
                'meja' => $meja,
                'user' => $user,
                'order' => $order,
                'transaksi' => $transaksi,
                'makanan' => $makanan,
                'orderdetail' => $orderdetail
            ];

            return view('kasir/s_transaksi', $data);
        }else{
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order){
        if (Auth::user()->id_level == 3) {
            $meja = Seat::all();
            $user = User::all();
            $orderdetail = Orderdetail::where('id_order', $order->id)->first();
            $makanan = Food::all();
            $mentah = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $mentah_acak = substr(str_shuffle($mentah), 0, 5);
            $data = [
                'meja' => $meja,
                'user' => $user,
                'order' => $order,
                'makanan' => $makanan,
                'orderdetail' => $orderdetail,
                'kode_nuklir' => "KTB".$mentah_acak."TR"
                // 'kode_nuklir' => "KTB".date('dmyhis')."TR"
            ];

            return view('kasir/d_transaksi', $data);
        }else{
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order){
        if (Auth::user()->id_level == 3) {
            // validation
                $rule_message = [
                    'tunai.required'=>'Please fill out this field',
                    'kembali.required'=>'Please fill out this field',
                    'kembali.min'=>'your cash is not enough'
                ];
                $rules = [
                        'tunai' => 'required',
                        'kembali' => 'required|min:0'
                    ];

                $this->validate($request, $rules, $rule_message);


                if($request->kembali < 0){
                    return redirect()->back()->with('fail', "your cash is not enough");
                }else{
                    Order::where('id', $order->id)->update([
                        'status_order' => 'received and has been paid'
                    ]);

                    Transaction::create([
                        'id_user' => Auth::user()->id,
                        'id_order' => $order->id,
                        'kode_transaksi' => $request->kode_transaksi,
                        'tanggal' => date("Y/m/d"),
                        'total_bayar' => $request->tunai,
                        'kembalian' => $request->kembali
                    ]);

                    return redirect('/kdashboard/transactions')->with('success', "Order ->{$request->kode_transaksi}<- has been successfully paid !");
                }
        }else{
            return redirect()->back();
        }
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
