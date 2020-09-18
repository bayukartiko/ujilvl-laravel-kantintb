<?php

namespace App\Http\Controllers;

use App\Food;
use Illuminate\Http\Request;

class GoodsCRUDcontrol extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // admin
        public function aindex(){
            $makanan = Food::all();
            $hitung_makanan = Food::where('jenis_masakan', 'food')->count();
            $hitung_minuman = Food::where('jenis_masakan', 'drink')->count();
            return view('admin/m_goods', ['makanan' => $makanan, 'hitung_makanan' => $hitung_makanan, 'hitung_minuman' => $hitung_minuman]);
        }

    // waiter
        public function windex(){
            $makanan = Food::all();
            $hitung_makanan = Food::where('jenis_masakan', 'food')->count();
            $hitung_minuman = Food::where('jenis_masakan', 'drink')->count();
            return view('waiter/m_goods', ['makanan' => $makanan, 'hitung_makanan' => $hitung_makanan, 'hitung_minuman' => $hitung_minuman]);
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // admin
        public function acreate(){
            return view('admin/t_goods');
        }

    // waiter
        public function wcreate(){
            return view('waiter/t_goods');
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // admin
        public function astore(Request $request){
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

            return redirect('/adashboard/goods')->with('success', "Data ->{$request->namamasakan}<- was successfully added !");
        }

    // waiter
        public function wstore(Request $request){
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

            return redirect('/wdashboard/goods')->with('success', "Data ->{$request->namamasakan}<- was successfully added !");
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    // admin
        public function ashow(Food $food){
            $tipemasakan = ['food', 'drink'];
            $statusmasakan = ['new', 'old'];
            return view('admin/d_goods', ['makanan' => $food, 'tipemasakan' => $tipemasakan, 'statusmasakan' => $statusmasakan]);
        }

    // waiter
        public function wshow(Food $food){
            $tipemasakan = ['food', 'drink'];
            $statusmasakan = ['new', 'old'];
            return view('waiter/d_goods', ['makanan' => $food, 'tipemasakan' => $tipemasakan, 'statusmasakan' => $statusmasakan]);
        }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    // admin
        public function aedit(Food $food){
            // dd($food);
            $tipemasakan = ['food', 'drink'];
            $statusmasakan = ['new', 'old'];
            return view('admin/e_goods', ['makanan' => $food, 'tipemasakan' => $tipemasakan, 'statusmasakan' => $statusmasakan]);
        }

    // waiter
        public function wedit(Food $food){
            // dd($food);
            $tipemasakan = ['food', 'drink'];
            $statusmasakan = ['new', 'old'];
            return view('waiter/e_goods', ['makanan' => $food, 'tipemasakan' => $tipemasakan, 'statusmasakan' => $statusmasakan]);
        }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    // admin
        public function aupdate(Request $request, Food $food){
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

            Food::where('id', $food->id)->update($data);

            return redirect('/adashboard/goods')->with('success', "Data ->{$request->namamasakan}<- was successfully edited !");
        }

    // waiter
        public function wupdate(Request $request, Food $food){
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

            Food::where('id', $food->id)->update($data);

            return redirect('/wdashboard/goods')->with('success', "Data ->{$request->namamasakan}<- was successfully edited !");
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    // admin
        public function adestroy(Food $food){
            $food->delete();
            return redirect('/adashboard/goods')->with('success', "Data ->{$food->namamasakan}<- was successfully deleted !");
        }

    // waiter
        public function wdestroy(Food $food){
            $food->delete();
            return redirect('/wdashboard/goods')->with('success', "Data ->{$food->namamasakan}<- was successfully deleted !");
        }
}
