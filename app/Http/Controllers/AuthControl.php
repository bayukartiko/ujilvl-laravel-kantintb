<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthControl extends Controller
{
    public function getLogin(){
        return view('auth/login');
    }
    public function postLogin(Request $request){
        // dd('login ok');
        // dd(Auth::attempt(['username' => $request->username, 'password' => $request->password]));

        // validation
            $rules = [
                    'username' => 'required',
                    'password' => 'required',
                ];

            $this->validate($request, $rules);

        if (!Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->back()->with('fail', "Wrong username or password !");
        }

        if (Auth::user()->id_level == 1) {
            return redirect('/adashboard');
        } elseif(Auth::user()->id_level == 2) {
            return redirect('/wdashboard');
        } elseif(Auth::user()->id_level == 3) {
            return redirect('/kdashboard');
        } elseif(Auth::user()->id_level == 4){
            return redirect('/odashboard');
        }else{
            return "role tidak dikenali";
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/login')->with('success', "you has been logout !");
    }
}
