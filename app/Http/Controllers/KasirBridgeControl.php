<?php

namespace App\Http\Controllers;

use App\User;
use App\Seat;
use App\Food;
use App\Order;
use App\Level;
use App\Orderdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function profil(){
        $data = [
            'profil' => Auth::user(),
            'level' => Level::all()
        ];

        if (Auth::user()->id_level == 3) {
            return view('kasir/e_profil', $data);
        }else{
            return redirect()->back();
        }
    }

    public function updateprofil(Request $request, User $user){
        if (Auth::user()->id_level == 3) {
            // validation
                $rule_message = [
                    'username.required'=>'You cant leave Username field empty',
                    'name.required'=>'You cant leave Fullname field empty',
                    'genderRadios.required'=>'You cant leave Gender field empty',
                    'alamat.required'=>'You cant leave addres field empty',
                    'nohp.required'=>'You cant leave phone number field empty'
                ];
                $rules = [
                        'username' => 'required',
                        'name' => 'required',
                        'genderRadios' => 'required',
                        'alamat' => 'required',
                        'nohp' => 'required'
                    ];

                $this->validate($request, $rules, $rule_message);

                if($request->file('pp')){
                    if (Auth::user()->avatar) {
                        Storage::delete(Auth::user()->avatar);
                        $gambar = $request->file('pp')->store('avatars');
                    }
                }else{
                    $gambar = Auth::user()->avatar;
                }

            $data = [
                'username' => Auth::user()->username,
                'nama_user' => $request->name,
                'jenis_kelamin' => $request->genderRadios,
                'alamat' => $request->alamat,
                'avatar' => $gambar,
                'nohp' => $request->nohp,
                'id_level' => Auth::user()->id_level
            ];

            User::where('id', Auth::user()->id)->update($data);

            return redirect()->back()->with('success', "Your profile was successfully updated !");
        }else{
            return redirect()->back();
        }
    }

    public function kcetak_pdf(Request $request){

    }
}
