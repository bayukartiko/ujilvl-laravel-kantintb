<?php

namespace App\Http\Controllers;

use App\User;
use App\Seat;
use App\Food;
use App\Level;
use App\Rules\CurrentPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminBridgeControl extends Controller
{
    public function main(){
        $data = [
            'user' => Auth::user()
        ];
        return view('homeweb', $data);
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

    public function profil(){
        $data = [
            'profil' => Auth::user(),
            'level' => Level::all()
        ];

        if (Auth::user()->id_level == 1) {
            return view('admin/e_profil', $data);
        }else{
            return redirect()->back();
        }
    }
    public function password(){
        $data = [
            'profil' => Auth::user()
        ];

        if (Auth::user()->id_level == 1) {
            return view('admin/e_password', $data);
        }else{
            return redirect()->back();
        }
    }

    public function updateprofil(Request $request, User $user){
        if (Auth::user()->id_level == 1) {
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
        if (Auth::user()->id_level == 1) {
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
}
