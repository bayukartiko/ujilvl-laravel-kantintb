<?php

namespace App\Http\Controllers;

use App\Seat;
use Illuminate\Http\Request;

class AdminDataSeatsControl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meja = Seat::withTrashed()->get();
        $hitung_meja = Seat::withTrashed()->count();
        $hitung_meja_aktif = Seat::all()->count();
        $hitung_meja_notaktif = Seat::onlyTrashed()->count();
        return view('admin/m_seats', ['meja' => $meja, 'hitung_meja' => $hitung_meja, 'hitung_meja_aktif' => $hitung_meja_aktif, 'hitung_meja_notaktif' => $hitung_meja_notaktif]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/t_seats');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
            $rule_message = [
                'nomeja.required'=>'You cant leave Seat Number field empty'
            ];
            $rules = [
                    'nomeja' => 'required'
                ];

            $this->validate($request, $rules, $rule_message);

        Seat::create([
            'no_meja' => 'S-'.$request->nomeja,
        ]);

        return redirect('/dashboard/seats')->with('success', "Data ->S-{$request->nomeja}<- was successfully added !");
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
    public function destroy($seat)
    {
        $seat = Seat::withTrashed()->where('id',$seat);
        $seat->forceDelete();
        return redirect('/dashboard/seats')->with('success', "Data was successfully deleted !");
    }
    public function hapus_sementara($seat)
    {
        $seat = Seat::withTrashed()->where('id',$seat);
        $seat->delete();
        return redirect('/dashboard/seats')->with('success', "Data was successfully deactivated !");
    }
    public function kembalikan_sampah($seat)
    {
        $seat = Seat::onlyTrashed()->where('id',$seat);
        $seat->restore();
        return redirect('/dashboard/seats')->with('success', "Data was successfully activated !");
    }
}
