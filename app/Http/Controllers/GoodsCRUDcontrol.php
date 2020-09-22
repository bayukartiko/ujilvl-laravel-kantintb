<?php

namespace App\Http\Controllers;

use App\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            // dd($request->file('gambarmasakan'));
            if (Auth::user()->id_level == 1) {
                // validation
                    $rule_message = [
                        'namamasakan.required'=>'Please fill out this field',
                        'tipemasakan.required'=>'Please fill out this field',
                        'gambarmasakan.required'=>'Please fill out this field',
                        'hargamasakan.required'=>'Please fill out this field',
                        'stokmasakan.required'=>'Please fill out this field',
                        'infomasakan.required'=>'Please fill out this field'
                    ];
                    $rules = [
                            'namamasakan' => 'required',
                            'tipemasakan' => 'required',
                            'gambarmasakan' => 'required',
                            'hargamasakan' => 'required',
                            'stokmasakan' => 'required',
                            'infomasakan' => 'required'
                        ];

                    $this->validate($request, $rules, $rule_message);

                if($request->stokmasakan > 0){
                    $status = "available";
                }else{
                    $status = "run out";
                }

                Food::create([
                    'nama_masakan' => $request->namamasakan,
                    'jenis_masakan' => $request->tipemasakan,
                    'gambar' => $request->file('gambarmasakan')->store('imgmasakan'),
                    'harga' => $request->hargamasakan,
                    'stok' => $request->stokmasakan,
                    'keterangan' => $request->infomasakan,
                    'status_masakan' => $status
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
                        'namamasakan.required'=>'Please fill out this field',
                        'tipemasakan.required'=>'Please fill out this field',
                        'gambarmasakan.required'=>'Please fill out this field',
                        'hargamasakan.required'=>'Please fill out this field',
                        'stokmasakan.required'=>'Please fill out this field',
                        'infomasakan.required'=>'Please fill out this field'
                    ];
                    $rules = [
                            'namamasakan' => 'required',
                            'tipemasakan' => 'required',
                            'gambarmasakan' => 'required',
                            'hargamasakan' => 'required',
                            'stokmasakan' => 'required',
                            'infomasakan' => 'required'
                        ];

                    $this->validate($request, $rules, $rule_message);

                if($request->stokmasakan > 0){
                    $status = "available";
                }else{
                    $status = "run out";
                }

                Food::create([
                    'nama_masakan' => $request->namamasakan,
                    'jenis_masakan' => $request->tipemasakan,
                    'gambar' => $request->file('gambarmasakan')->store('imgmasakan'),
                    'harga' => $request->hargamasakan,
                    'stok' => $request->stokmasakan,
                    'keterangan' => $request->infomasakan,
                    'status_masakan' => $status
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
                        'namamasakan.required'=>'Please fill out this field',
                        'tipemasakan.required'=>'Please fill out this field',
                        'hargamasakan.required'=>'Please fill out this field',
                        'stokmasakan.required'=>'Please fill out this field',
                        'infomasakan.required'=>'Please fill out this field'
                    ];
                    $rules = [
                            'namamasakan' => 'required',
                            'tipemasakan' => 'required',
                            'hargamasakan' => 'required',
                            'stokmasakan' => 'required',
                            'infomasakan' => 'required'
                        ];

                    $this->validate($request, $rules, $rule_message);

                // hapus gambar di storange
                // dd($request->food->gambar);
                if($request->file('gambarmasakan')){
                    if ($request->food->gambar) {
                        Storage::delete($request->food->gambar);
                        $gambar = $request->file('gambarmasakan')->store('imgmasakan');
                    }
                }else{
                    $gambar = $food->gambar;
                }

                // dd($request->file('gambarmasakan'));

                if($request->stokmasakan > 0){
                    $status = "available";
                }else{
                    $status = "run out";
                }

                $data = [
                    'nama_masakan' => $request->namamasakan,
                    'jenis_masakan' => $request->tipemasakan,
                    'gambar' => $gambar,
                    'harga' => $request->hargamasakan,
                    'stok' => $request->stokmasakan,
                    'keterangan' => $request->infomasakan,
                    'status_masakan' => $status
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
                    'namamasakan.required'=>'Please fill out this field',
                    'tipemasakan.required'=>'Please fill out this field',
                    'gambarmasakan.required'=>'Please fill out this field',
                    'hargamasakan.required'=>'Please fill out this field',
                    'stokmasakan.required'=>'Please fill out this field',
                    'infomasakan.required'=>'Please fill out this field'
                ];
                $rules = [
                        'namamasakan' => 'required',
                        'tipemasakan' => 'required',
                        'gambarmasakan' => 'required',
                        'hargamasakan' => 'required',
                        'stokmasakan' => 'required',
                        'infomasakan' => 'required'
                    ];

                $this->validate($request, $rules, $rule_message);

            // hapus gambar di storange
            // dd($request->food->gambar);
            if($request->file('gambarmasakan')){
                if ($request->food->gambar) {
                    Storage::delete($request->food->gambar);
                    $gambar = $request->file('gambarmasakan')->store('imgmasakan');
                }
            }else{
                $gambar = $food->gambar;
            }

            // dd($request->file('gambarmasakan'));

            if($request->stokmasakan > 0){
                $status = "available";
            }else{
                $status = "run out";
            }

            $data = [
                'nama_masakan' => $request->namamasakan,
                'jenis_masakan' => $request->tipemasakan,
                'gambar' => $gambar,
                'harga' => $request->hargamasakan,
                'stok' => $request->stokmasakan,
                'keterangan' => $request->infomasakan,
                'status_masakan' => $status
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
                if ($food->gambar) {
                    Storage::delete($food->gambar);
                }

                $food->delete();
                return redirect('/adashboard/goods')->with('success', "Data ->{$food->nama_masakan}<- was successfully deleted !");
            }else{
                return redirect()->back();
            }
        }

    // waiter
        public function wdestroy(Food $food){
            if (Auth::user()->id_level == 2) {
                if ($food->gambar) {
                    Storage::delete($food->gambar);
                }

                $food->delete();
                return redirect('/wdashboard/goods')->with('success', "Data ->{$food->nama_masakan}<- was successfully deleted !");
            }else{
                return redirect()->back();
            }
        }
}
