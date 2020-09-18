<?php

namespace App\Http\Controllers;

use App\User;
use App\Seat;
use App\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class WaiterBridgeControl extends Controller
{

    public function main(){
        return view('homeweb');
    }
    public function index(){
        $hitung_meja = Seat::withTrashed()->count();
        $hitung_meja_aktif = Seat::all()->count();
        $hitung_meja_notaktif = Seat::onlyTrashed()->count();

        $hitung_makanan = Food::where('jenis_masakan', 'food')->count();
        $hitung_minuman = Food::where('jenis_masakan', 'drink')->count();

        $admin = User::where('id_level', 1)->count();
        $waiter = User::where('id_level', 2)->count();
        $kasir = User::where('id_level', 3)->count();
        $owner = User::where('id_level', 4)->count();

        $food = Food::all();

        $data = [
            'hitung_meja' => $hitung_meja,
            'hitung_meja_aktif' => $hitung_meja_aktif,
            'hitung_meja_notaktif' => $hitung_meja_notaktif,
            'hitung_makanan' => $hitung_makanan,
            'hitung_minuman' => $hitung_minuman,
            'hitung_admin' => $admin,
            'hitung_waiter' => $waiter,
            'hitung_kasir' => $kasir,
            'hitung_owner' => $owner,
            'food' => $food
        ];

        if (Auth::user()->id_level == 2) {
            return view('waiter/waiter_dashboard', $data);
        }else{
            return redirect()->back();
        }

    }
    
}
