<?php

namespace App\Http\Controllers;

use App\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeatsCRUDcontrol extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if (Auth::user()->id_level == 1) {
            $meja = Seat::withTrashed()->get();
            $hitung_meja = Seat::withTrashed()->count();
            $hitung_meja_aktif = Seat::all()->count();
            $hitung_meja_notaktif = Seat::onlyTrashed()->count();
            return view('admin/m_seats', ['meja' => $meja, 'hitung_meja' => $hitung_meja, 'hitung_meja_aktif' => $hitung_meja_aktif, 'hitung_meja_notaktif' => $hitung_meja_notaktif]);
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
            return view('admin/t_seats');
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
                    'nomeja.required'=>'Please fill out this field'
                ];
                $rules = [
                        'nomeja' => 'required'
                    ];

                $this->validate($request, $rules, $rule_message);

            Seat::create([
                'no_meja' => 'S-'.$request->nomeja,
            ]);

            return redirect('/adashboard/seats')->with('success', "Data ->S-{$request->nomeja}<- was successfully added !");
        }else{
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function show(Seat $seat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function edit(Seat $seat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seat $seat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function destroy($seat){
        if (Auth::user()->id_level == 1) {
            $seat = Seat::withTrashed()->where('id',$seat);
            $seat->forceDelete();
            return redirect('/adashboard/seats')->with('success', "Data was successfully deleted !");
        }else{
            return redirect()->back();
        }
    }
    public function hapus_sementara($seat){
        if (Auth::user()->id_level == 1) {
            $seat = Seat::withTrashed()->where('id',$seat);
            $seat->delete();
            return redirect('/adashboard/seats')->with('success', "Data was successfully deactivated !");
        }else{
            return redirect()->back();
        }
    }
    public function kembalikan_sampah($seat){
        if (Auth::user()->id_level == 1) {
            $seat = Seat::onlyTrashed()->where('id',$seat);
            $seat->restore();
            return redirect('/adashboard/seats')->with('success', "Data was successfully activated !");
        }else{
            return redirect()->back();
        }
    }
}
