<?php

namespace App\Http\Controllers;

use App\User;
use App\Seat;
use App\Food;
use App\Order;
use App\Orderdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KasirBridgeControl extends Controller
{
    public function main(){
        return view('homeweb');
    }
    public function index(){
        $hitung_meja = Seat::withTrashed()->count();
        $hitung_meja_aktif = Seat::all()->count();
        $hitung_meja_notaktif = Seat::onlyTrashed()->count();

        $hitung_order_masuk = Order::where('status_order', 'unfinished')->count();
        $hitung_order_selesai = Order::where('status_order', 'done')->count();

        $admin = User::where('id_level', 1)->count();
        $waiter = User::where('id_level', 2)->count();
        $kasir = User::where('id_level', 3)->count();
        $owner = User::where('id_level', 4)->count();

        $data = [
            'hitung_meja' => $hitung_meja,
            'hitung_meja_aktif' => $hitung_meja_aktif,
            'hitung_meja_notaktif' => $hitung_meja_notaktif,
            'hitung_order_masuk' => $hitung_order_masuk,
            'hitung_order_selesai' => $hitung_order_selesai,
            'hitung_admin' => $admin,
            'hitung_waiter' => $waiter,
            'hitung_kasir' => $kasir,
            'hitung_owner' => $owner
        ];

        if (Auth::user()->id_level == 3) {
            return view('kasir/kasir_dashboard', $data);
        }else{
            return redirect()->back();
        }
    }
}
