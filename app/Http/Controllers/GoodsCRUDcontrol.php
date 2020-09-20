<?php

namespace App\Http\Controllers;

use App\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoodsCRUDcontrol extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // admin
        public function aindex(){
            if (Auth::user()->id_level == 1) {
                $makanan = Food::all();
                $hitung_makanan_tersedia = Food::where('jenis_masakan', 'food')->where('status_masakan', 'available')->count();
                $hitung_makanan_habis = Food::where('jenis_masakan', 'food')->where('status_masakan', 'run out')->count();
                $hitung_minuman_tersedia = Food::where('jenis_masakan', 'drink')->where('status_masakan', 'available')->count();
                $hitung_minuman_habis = Food::where('jenis_masakan', 'drink')->where('status_masakan', 'run out')->count();
                $data = [
                    'makanan' => $makanan,
                    'hitung_makanan_tersedia' => $hitung_makanan_tersedia,
                    'hitung_makanan_habis' => $hitung_makanan_habis,
                    'hitung_minuman_tersedia' => $hitung_minuman_tersedia,
                    'hitung_minuman_habis' => $hitung_minuman_habis
                ];
                return view('admin/m_goods', $data);
            }else{
                return redirect()->back();
            }
        }

        // waiter
        public function windex(){
            if (Auth::user()->id_level == 2) {
                $makanan = Food::all();
                $hitung_makanan_tersedia = Food::where('jenis_masakan', 'food')->where('status_masakan', 'available')->count();
                $hitung_makanan_habis = Food::where('jenis_masakan', 'food')->where('status_masakan', 'run out')->count();
                $hitung_minuman_tersedia = Food::where('jenis_masakan', 'drink')->where('status_masakan', 'available')->count();
                $hitung_minuman_habis = Food::where('jenis_masakan', 'drink')->where('status_masakan', 'run out')->count();
                $data = [
                    'makanan' => $makanan,
                    'hitung_makanan_tersedia' => $hitung_makanan_tersedia,
                    'hitung_makanan_habis' => $hitung_makanan_habis,
                    'hitung_minuman_tersedia' => $hitung_minuman_tersedia,
                    'hitung_minuman_habis' => $hitung_minuman_habis
                ];
                return view('waiter/m_goods', $data);
            }else{
                return redirect()->back();
            }
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // admin
        public function acreate(){
            if (Auth::user()->id_level == 1) {
                return view('admin/t_goods');
            }else{
                return redirect()->back();
            }
        }

    // waiter
        public function wcreate(){
            if (Auth::user()->id_level == 2) {
                return view('waiter/t_goods');
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
    // admin
        public function astore(Request $request){
            if (Auth::user()->id_level == 1) {
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
            }else{
                return redirect()->back();
            }
        }

    // waiter
        public function wstore(Request $request){
            if (Auth::user()->id_level == 2) {
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
            }else{
                return redirect()->back();
            }
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    // admin
        public function ashow(Food $food){
            if (Auth::user()->id_level == 1) {
                $tipemasakan = ['food', 'drink'];
                $statusmasakan = ['available', 'run out'];
                return view('admin/d_goods', ['makanan' => $food, 'tipemasakan' => $tipemasakan, 'statusmasakan' => $statusmasakan]);
            }else{
                return redirect()->back();
            }
        }

    // waiter
        public function wshow(Food $food){
            if (Auth::user()->id_level == 2) {
                $tipemasakan = ['food', 'drink'];
                $statusmasakan = ['available', 'run out'];
                return view('waiter/d_goods', ['makanan' => $food, 'tipemasakan' => $tipemasakan, 'statusmasakan' => $statusmasakan]);
            }else{
                return redirect()->back();
            }
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
            if (Auth::user()->id_level == 1) {
                $tipemasakan = ['food', 'drink'];
                $statusmasakan = ['available', 'run out'];
                return view('admin/e_goods', ['makanan' => $food, 'tipemasakan' => $tipemasakan, 'statusmasakan' => $statusmasakan]);
            }else{
                return redirect()->back();
            }
        }

    // waiter
        public function wedit(Food $food){
            // dd($food);
            if (Auth::user()->id_level == 2) {
                $tipemasakan = ['food', 'drink'];
                $statusmasakan = ['available', 'run out'];
                return view('waiter/e_goods', ['makanan' => $food, 'tipemasakan' => $tipemasakan, 'statusmasakan' => $statusmasakan]);
            }else{
                return redirect()->back();
            }
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
            if (Auth::user()->id_level == 1) {
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
            }else{
                return redirect()->back();
            }
        }

    // waiter
        public function wupdate(Request $request, Food $food){
            if (Auth::user()->id_level == 2) {
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
            }else{
                return redirect()->back();
            }
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    // admin
        public function adestroy(Food $food){
            if (Auth::user()->id_level == 1) {
                $food->delete();
                return redirect('/adashboard/goods')->with('success', "Data ->{$food->namamasakan}<- was successfully deleted !");
            }else{
                return redirect()->back();
            }
        }

    // waiter
        public function wdestroy(Food $food){
            if (Auth::user()->id_level == 2) {
                $food->delete();
                return redirect('/wdashboard/goods')->with('success', "Data ->{$food->namamasakan}<- was successfully deleted !");
            }else{
                return redirect()->back();
            }
        }
}
