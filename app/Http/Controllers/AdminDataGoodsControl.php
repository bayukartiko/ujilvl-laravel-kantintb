<?php

namespace App\Http\Controllers;

use App\Food;
use Illuminate\Http\Request;

class AdminDataGoodsControl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $makanan = Food::all();
        $hitung_makanan = Food::where('jenis_masakan', 'food')->count();
        $hitung_minuman = Food::where('jenis_masakan', 'drink')->count();
        return view('admin/m_goods', ['makanan' => $makanan, 'hitung_makanan' => $hitung_makanan, 'hitung_minuman' => $hitung_minuman]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/t_goods');
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
                'namamasakan.required'=>'You cant leave Food Name field empty',
                'tipemasakan.required'=>'You cant leave Type of Food field empty',
                'hargamasakan.required'=>'You cant leave Food Price field empty',
                'statusmasakan.required'=>'You cant leave Food Status field empty'
            ];
            $rules = [
                    'namamasakan' => 'required',
                    'tipemasakan' => 'required',
                    'hargamasakan' => 'required',
                    'statusmasakan' => 'required'
                ];

            $this->validate($request, $rules, $rule_message);

        Food::create([
            'nama_masakan' => $request->namamasakan,
            'jenis_masakan' => $request->tipemasakan,
            'harga' => $request->hargamasakan,
            'status_masakan' => $request->statusmasakan
        ]);

        return redirect('/dashboard/goods')->with('success', "Data ->{$request->namamasakan}<- was successfully added !");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        $tipemasakan = ['food', 'drink'];
        $statusmasakan = ['new', 'old'];
        return view('admin/d_goods', ['makanan' => $food, 'tipemasakan' => $tipemasakan, 'statusmasakan' => $statusmasakan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function edit(Food $food)
    {
        // dd($food);
        $tipemasakan = ['food', 'drink'];
        $statusmasakan = ['new', 'old'];
        return view('admin/e_goods', ['makanan' => $food, 'tipemasakan' => $tipemasakan, 'statusmasakan' => $statusmasakan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Food $food)
    {
        // validation
            $rule_message = [
                'namamasakan.required'=>'You cant leave Food Name field empty',
                'tipemasakan.required'=>'You cant leave Type of Food field empty',
                'hargamasakan.required'=>'You cant leave Food Price field empty',
                'statusmasakan.required'=>'You cant leave Food Status field empty'
            ];
            $rules = [
                    'namamasakan' => 'required',
                    'tipemasakan' => 'required',
                    'hargamasakan' => 'required',
                    'statusmasakan' => 'required'
                ];

            $this->validate($request, $rules, $rule_message);

        $data = [
            'nama_masakan' => $request->namamasakan,
            'jenis_masakan' => $request->tipemasakan,
            'harga' => $request->hargamasakan,
            'status_masakan' => $request->statusmasakan
        ];

        // $masakan = Food::find($food);
        // $masakan->nama_masakan = $request->namamasakan;
        // $masakan->jenis_masakan = $request->tipemasakan;
        // $masakan->harga = $request->hargamasakan;
        // $masakan->status_masakan = $request->statusmasakan;
        // $masakan->save();

        Food::where('id', $food->id)->update($data);

        return redirect('/dashboard/goods')->with('success', "Data ->{$request->namamasakan}<- was successfully edited !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        // $makanan = Food::find($food);
        // $makanan->delete();
        $food->delete();
        return redirect('/dashboard/goods')->with('success', "Data ->{$food->namamasakan}<- was successfully deleted !");
    }
}
