<?php

namespace App\Http\Controllers;

use Dompdf\Adapter\PDFLib;
use PDF;
use App\User;
use App\Seat;
use App\Food;
use App\Level;
use App\Order;
use App\Orderdetail;
use App\Rules\CurrentPassword;
use App\Transaction;
// use Barryvdh\DomPDF\PDF;
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
    public function password(){
        $data = [
            'profil' => Auth::user()
        ];

        if (Auth::user()->id_level == 3) {
            return view('kasir/e_password', $data);
        }else{
            return redirect()->back();
        }
    }

    public function updateprofil(Request $request, User $user){
        if (Auth::user()->id_level == 3) {
            // validation
                $rule_message = [
                    'username.required'=>'Please fill out this field',
                    'name.required'=>'Please fill out this field',
                    'genderRadios.required'=>'Please fill out this field',
                    'alamat.required'=>'Please fill out this field',
                    'nohp.required'=>'Please fill out this field'
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
    public function updatepassword(Request $request, User $user){
        if (Auth::user()->id_level == 3) {
            // validation
                $rule_message = [
                    'cur_pass.required'=>'Please fill out this field',
                    'new_pass.required'=>'Please fill out this field',
                    'confirm_new_pass.required'=>'Please fill out this field',
                    'confirm_new_pass.same'=>'New password confirmation doesn\'t not match with new password'
                ];
                $rules = [
                        'cur_pass' => ['required', new CurrentPassword],
                        'new_pass' => 'required',
                        'confirm_new_pass' => 'required|same:new_pass'
                    ];

                $this->validate($request, $rules, $rule_message);

            $data = [
                'password' => bcrypt($request->new_pass)
            ];

            User::where('id', Auth::user()->id)->update($data);

            return redirect()->back()->with('success', "Your password has been changed !");
        }else{
            return redirect()->back();
        }
    }

    public function kcetak(Request $request){
        if (Auth::user()->id_level == 3) {
            return view('kasir/kprint');
        }else{
            return redirect()->back();
        }
    }
    public function kcetak_pdf(Request $request){
        if (Auth::user()->id_level == 3) {
            if($request->pilihan_report == "transaksi"){
                $transaction = Transaction::where('kode_transaksi', $request->kode_transaksi)->first();
                $user = User::all();
                $meja = Seat::all();
                $transaksi = Transaction::all();
                $order = Order::where('id', $transaction->id_order)->first();
                $orderdetail = Orderdetail::where('id_order', $transaction->id_order)->first();

                $data = [
                    'panggilan' => "kasir",
                    'tipe' => "transaksi",
                    'transaksi' => $transaction,
                    'user' => $user,
                    'meja' => $meja,
                    'order' => $order,
                    'detail_order' => $orderdetail,
                    'orderdetail' => $orderdetail,
                    'makanan' => Food::all()
                ];

                // return view('cetak_print', $data);
                $pdf = PDF::loadView('cetak_print', $data);
                return $pdf->download('laporan-transaksi');
            }
        }else{
            return redirect()->back();
        }
    }
}
