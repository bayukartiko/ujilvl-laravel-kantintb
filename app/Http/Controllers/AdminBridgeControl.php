<?php

namespace App\Http\Controllers;

use App\User;
use App\Seat;
use App\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminBridgeControl extends Controller
{
    public function main(){
        return view('homeweb');
    }
    public function index(){
        $hitung_meja = Seat::withTrashed()->count();
        $hitung_meja_aktif = Seat::all()->count();
        $hitung_meja_notaktif = Seat::onlyTrashed()->count();

        $hitung_makanan_tersedia = Food::where('jenis_masakan', 'food')->where('status_masakan', 'available')->count();
        $hitung_makanan_habis = Food::where('jenis_masakan', 'food')->where('status_masakan', 'run out')->count();
        $hitung_minuman_tersedia = Food::where('jenis_masakan', 'drink')->where('status_masakan', 'available')->count();
        $hitung_minuman_habis = Food::where('jenis_masakan', 'drink')->where('status_masakan', 'run out')->count();

        $admin = User::where('id_level', 1)->count();
        $waiter = User::where('id_level', 2)->count();
        $kasir = User::where('id_level', 3)->count();
        $owner = User::where('id_level', 4)->count();

        $data = [
            'hitung_meja' => $hitung_meja,
            'hitung_meja_aktif' => $hitung_meja_aktif,
            'hitung_meja_notaktif' => $hitung_meja_notaktif,
            'hitung_makanan_tersedia' => $hitung_makanan_tersedia,
            'hitung_makanan_habis' => $hitung_makanan_habis,
            'hitung_minuman_tersedia' => $hitung_minuman_tersedia,
            'hitung_minuman_habis' => $hitung_minuman_habis,
            'hitung_admin' => $admin,
            'hitung_waiter' => $waiter,
            'hitung_kasir' => $kasir,
            'hitung_owner' => $owner
        ];

        if (Auth::user()->id_level == 1) {
            return view('admin/admin_dashboard', $data);
        }else{
            return redirect()->back();
        }
    }
}
