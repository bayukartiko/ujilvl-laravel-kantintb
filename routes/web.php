<?php

use App\Http\Controllers\AdminDataGoodsControl;
use App\Http\Controllers\AdminDataMerchants;
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

    // admin bridge makanan/goods controller
        // static controller
            Route::get('/adashboard/goods', 'GoodsCRUDcontrol@aindex')->middleware('auth');

        // data makanan/goods controller
            // create
                Route::get('/adashboard/addnewgoods', 'GoodsCRUDcontrol@acreate')->middleware('auth');
                Route::post('/goods/add', 'GoodsCRUDcontrol@astore')->middleware('auth');
            // detail
                Route::get('/adashboard/goods/detail/{food}', 'GoodsCRUDcontrol@ashow')->middleware('auth');
            // edit
                Route::get('/adashboard/goods/edit/{food}', 'GoodsCRUDcontrol@aedit')->middleware('auth');
                Route::patch('/goods/update/{food}', 'GoodsCRUDcontrol@aupdate')->middleware('auth');
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
    // waiter bridge controller
        // static controller
            Route::get('/',  'WaiterBridgeControl@main');
            Route::get('/wdashboard', 'WaiterBridgeControl@index')->middleware('auth');

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
                Route::post('/goods/add', 'GoodsCRUDcontrol@wstore')->middleware('auth');
            // detail
                Route::get('/wdashboard/goods/detail/{food}', 'GoodsCRUDcontrol@wshow')->middleware('auth');
            // edit
                Route::get('/wdashboard/goods/edit/{food}', 'GoodsCRUDcontrol@wedit')->middleware('auth');
                Route::patch('/goods/update/{food}', 'GoodsCRUDcontrol@wupdate')->middleware('auth');
            // delete
                Route::get('/wdashboard/goods/delete/{food}', 'GoodsCRUDcontrol@wdestroy')->middleware('auth');

