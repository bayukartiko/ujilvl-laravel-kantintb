<?php

use App\Http\Controllers\AdminDataGoodsControl;
use App\Http\Controllers\AdminDataMerchants;
use App\Http\Controllers\WaiterBridgeControl;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// besok bikin pembaruan semua fitur di user kasir

// login auth
    Route::get('/login', 'AuthControl@getLogin')->middleware('guest')->name('login');
    Route::post('/login', 'AuthControl@postLogin')->middleware('guest')->name('aksi.login');
    Route::get('/forgot_password', function(){
        return view('auth/forgot-password');
    });

    // Route::get('/coba', function(){
    //     return dd(Auth::user());
    // })->name('coba');

    Route::get('/logout', 'AuthControl@logout')->middleware('auth');

// admin
    // admin bridge controller
        // static controller
            Route::get('/',  'AdminBridgeControl@main');
            Route::get('/adashboard', 'AdminBridgeControl@index')->middleware('auth');
            Route::get('/adashboard/profil', 'AdminBridgeControl@profil')->middleware('auth');
            Route::get('/adashboard/password', 'AdminBridgeControl@password')->middleware('auth');
            Route::patch('/aprofil/update/{user}', 'AdminBridgeControl@updateprofil')->middleware('auth');
            Route::patch('/apassword/update/{user}', 'AdminBridgeControl@updatepassword')->middleware('auth');

    // admin bridge makanan/goods controller
        // static controller
            Route::get('/adashboard/goods', 'GoodsCRUDcontrol@aindex')->middleware('auth');

        // data makanan/goods controller
            // create
                Route::get('/adashboard/addnewgoods', 'GoodsCRUDcontrol@acreate')->middleware('auth');
                Route::post('/agoods/add', 'GoodsCRUDcontrol@astore')->middleware('auth');
            // detail
                Route::get('/adashboard/goods/detail/{food}', 'GoodsCRUDcontrol@ashow')->middleware('auth');
            // edit
                Route::get('/adashboard/goods/edit/{food}', 'GoodsCRUDcontrol@aedit')->middleware('auth');
                Route::patch('/agoods/update/{food}', 'GoodsCRUDcontrol@aupdate')->middleware('auth');
            // delete
                Route::get('/adashboard/goods/delete/{food}', 'GoodsCRUDcontrol@adestroy')->middleware('auth');

    // admin bridge meja/seat controller
        // static controller
            Route::get('/adashboard/seats', 'SeatsCRUDcontrol@index')->middleware('auth');

        // data meja/seats controller
            // create
                Route::get('/adashboard/addnewseats', 'SeatsCRUDcontrol@create')->middleware('auth');
                Route::post('/seats/add', 'SeatsCRUDcontrol@store')->middleware('auth');
            // delete
                Route::get('/adashboard/seats/delete/{seat}', 'SeatsCRUDcontrol@destroy')->middleware('auth');
                Route::get('/adashboard/seats/deactivate/{seat}', 'SeatsCRUDcontrol@hapus_sementara')->middleware('auth');
                Route::get('/adashboard/seats/activate/{seat}', 'SeatsCRUDcontrol@kembalikan_sampah')->middleware('auth');

    // admin bridge user controller
        // static controller
            Route::get('/adashboard/users', 'UsersCRUDcontrol@index')->middleware('auth');

        // data meja/users controller
            // create
                Route::get('/adashboard/addnewusers', 'UsersCRUDcontrol@create')->middleware('auth');
                Route::post('/users/add', 'UsersCRUDcontrol@store');
            // detail
                Route::get('/adashboard/users/detail/{user}', 'UsersCRUDcontrol@show')->middleware('auth');
            // edit
                Route::get('/adashboard/users/edit/{user}', 'UsersCRUDcontrol@edit')->middleware('auth');
                Route::patch('/users/update/{user}', 'UsersCRUDcontrol@update')->middleware('auth');
            // delete
                Route::get('/adashboard/users/delete/{user}', 'UsersCRUDcontrol@destroy')->middleware('auth');

// waiter
    // report data
        Route::get('/wreport', 'WaiterBridgeControl@wcetak')->middleware('auth');
        Route::post('/wreport/print', 'WaiterBridgeControl@wcetak_pdf')->middleware('auth');
    // waiter bridge controller
        // static controller
            Route::get('/',  'WaiterBridgeControl@main');
            Route::get('/wdashboard', 'WaiterBridgeControl@index')->middleware('auth');
            Route::get('/wdashboard/profil', 'WaiterBridgeControl@profil')->middleware('auth');
            Route::get('/wdashboard/password', 'WaiterBridgeControl@password')->middleware('auth');
            Route::patch('/wprofil/update/{user}', 'WaiterBridgeControl@updateprofil')->middleware('auth');
            Route::patch('/wpassword/update/{user}', 'WaiterBridgeControl@updatepassword')->middleware('auth');

    // waiter bridge order
        // static controller
            Route::get('/wdashboard/orders', 'OrdersCRUDcontrol@index')->middleware('auth');

        // data orders controller
            // create
                Route::get('/wdashboard/addneworders', 'OrdersCRUDcontrol@create')->middleware('auth');
                Route::post('/orders/add', 'OrdersCRUDcontrol@Store')->middleware('auth');
            // detail
                Route::get('/wdashboard/orders/detail/{order}', 'OrdersCRUDcontrol@show')->middleware('auth');
            // edit
                Route::get('/wdashboard/orders/edit/{order}', 'OrdersCRUDcontrol@edit')->middleware('auth');
                Route::patch('/orders/update/{order}', 'OrdersCRUDcontrol@update')->middleware('auth');
            // delete
                Route::get('/wdashboard/orders/delete/{order}', 'OrdersCRUDcontrol@adestroy')->middleware('auth');

    // waiter bridge makanan/goods
        // static controller
            Route::get('/wdashboard/goods', 'GoodsCRUDcontrol@windex')->middleware('auth');

        // data makanan/goods controller
            // create
                Route::get('/wdashboard/addnewgoods', 'GoodsCRUDcontrol@wcreate')->middleware('auth');
                Route::post('/wgoods/add', 'GoodsCRUDcontrol@wstore')->middleware('auth');
            // detail
                Route::get('/wdashboard/goods/detail/{food}', 'GoodsCRUDcontrol@wshow')->middleware('auth');
            // edit
                Route::get('/wdashboard/goods/edit/{food}', 'GoodsCRUDcontrol@wedit')->middleware('auth');
                Route::patch('/wgoods/update/{food}', 'GoodsCRUDcontrol@wupdate')->middleware('auth');
            // delete
                Route::get('/wdashboard/goods/delete/{food}', 'GoodsCRUDcontrol@wdestroy')->middleware('auth');


// kasir
    // kasir bridge controller
        // static controller
            Route::get('/',  'KasirBridgeControl@main');
            Route::get('/kdashboard', 'KasirBridgeControl@index')->middleware('auth');
            Route::get('/kdashboard/profil', 'KasirBridgeControl@profil')->middleware('auth');
            Route::get('/kdashboard/password', 'KasirBridgeControl@password')->middleware('auth');
            Route::patch('/kprofil/update/{user}', 'KasirBridgeControl@updateprofil')->middleware('auth');
            Route::patch('/kpassword/update/{user}', 'KasirBridgeControl@updatepassword')->middleware('auth');

    // admin bridge makanan/goods controller
        // static controller
            Route::get('/kdashboard/transactions', 'TransactionCRUDcontrol@index')->middleware('auth');

        // data transactions controller
            // detail
                Route::get('/kdashboard/transactions/detail/{order}', 'TransactionCRUDcontrol@show')->middleware('auth');
            // edit
                Route::get('/kdashboard/transactions/payment/{order}', 'TransactionCRUDcontrol@edit')->middleware('auth');
                Route::patch('/transactions/pay/{order}', 'TransactionCRUDcontrol@update')->middleware('auth');
