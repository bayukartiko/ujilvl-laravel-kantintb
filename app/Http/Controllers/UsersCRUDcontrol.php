<?php

namespace App\Http\Controllers;

use App\User;
use App\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersCRUDcontrol extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if (Auth::user()->id_level == 1) {
            $user = User::all();
            $level = Level::all();
            $admin = User::where('id_level', 1)->count();
            $waiter = User::where('id_level', 2)->count();
            $kasir = User::where('id_level', 3)->count();
            $owner = User::where('id_level', 4)->count();

            $data = [
                'user' => $user,
                'level' => $level,
                'hitung_admin' => $admin,
                'hitung_waiter' => $waiter,
                'hitung_kasir' => $kasir,
                'hitung_owner' => $owner
            ];

            return view('admin/m_user', $data);
        }else{
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        if (Auth::user()->id_level == 1) {
            $level = Level::all();
            return view('admin/t_user', ['level' => $level]);
        }else{
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        if (Auth::user()->id_level == 1) {
            // validation
                $rule_message = [
                    'username.required'=>'You cant leave Username field empty',
                    'username.unique'=>'This username has been registered',
                    'password.required'=>'You cant leave Password field empty',
                    'name.required'=>'You cant leave Fullname field empty',
                    'genderRadios.required'=>'You cant leave Gender field empty',
                    'role.required' =>'You cant leave User Role field empty'
                ];
                $rules = [
                        'username' => 'required|unique:users,username',
                        'password' => 'required',
                        'name' => 'required',
                        'genderRadios' => 'required',
                        'role' => 'required',
                    ];

                $this->validate($request, $rules, $rule_message);

            User::create([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'nama_user' => $request->name,
                'jenis_kelamin' => $request->genderRadios,
                'id_level' => $request->role
            ]);

            return redirect('/adashboard/users')->with('success', "Data ->{$request->username}<- was successfully added !");
        }else{
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user){
        if (Auth::user()->id_level == 1) {
            $level = Level::all();
            return view('admin/d_user', ['user' => $user, 'level' => $level]);
        }else{
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user){
        if (Auth::user()->id_level == 1) {
            $level = Level::all();
            return view('admin/e_user', ['user' => $user, 'level' => $level]);
        }else{
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user){
        if (Auth::user()->id_level == 1) {
            // validation
                $rule_message = [
                    'username.required'=>'You cant leave Username field empty',
                    'username.unique'=>'This username has been registered',
                    'password.required'=>'You cant leave Password field empty',
                    'name.required'=>'You cant leave Fullname field empty',
                    'genderRadios.required'=>'You cant leave Gender field empty',
                    'role.required' =>'You cant leave User Role field empty'
                ];
                $rules = [
                        'username' => 'required|unique:users,username',
                        'password' => 'required',
                        'name' => 'required',
                        'genderRadios' => 'required',
                        'role' => 'required',
                    ];

                $this->validate($request, $rules, $rule_message);

            $data = [
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'nama_user' => $request->name,
                'jenis_kelamin' => $request->genderRadios,
                'id_level' => $request->role
            ];

            User::where('id', $user->id)->update($data);

            return redirect('/adashboard/users')->with('success', "Data ->{$request->username}<- was successfully edited !");
        }else{
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user){
        if (Auth::user()->id_level == 1) {
            $user->delete();
            return redirect('/adashboard/users')->with('success', "Data ->{$user->username}<- was successfully deleted !");
        }else{
            return redirect()->back();
        }
    }
}
