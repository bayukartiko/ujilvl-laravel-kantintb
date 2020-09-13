<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminBridgeControl extends Controller
{
    public function login(){
        return view('auth/login');
    }
    public function register(){
        return view('auth/register');
    }
    public function index(){
        return view('index');
    }
    public function forgot_password(){
        return view('auth/forgot-password');
    }
}
