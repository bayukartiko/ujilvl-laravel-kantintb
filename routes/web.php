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

    Route::get('/coba', function(){
        return dd(Auth::user());
    })->name('coba');

    Route::get('/logout', 'AuthControl@logout')->middleware('auth');

// admin
    // admin bridge controller
        // static controller
            Route::get('/',  'AdminBridgeControl@main');
            Route::get('/adashboard', 'AdminBridgeControl@index')->middleware('auth');

    // admin bridge makanan/goods controller
        // static controller
            Route::get('/adashboard/goods', 'AdminDataGoodsControl@index');

        // data makanan/goods controller
            // create
                Route::get('/adashboard/addnewgoods', 'AdminDataGoodsControl@create');
                Route::post('/goods/add', 'AdminDataGoodsControl@Store');
            // detail
                Route::get('/adashboard/goods/detail/{food}', 'AdminDataGoodsControl@show');
            // edit
                Route::get('/adashboard/goods/edit/{food}', 'AdminDataGoodsControl@edit');
                Route::patch('/goods/update/{food}', 'AdminDataGoodsControl@update');
            // delete
                Route::get('/adashboard/goods/delete/{food}', 'AdminDataGoodsControl@destroy');

    // admin bridge meja/seat controller
        // static controller
            Route::get('/adashboard/seats', 'AdminDataSeatsControl@index');

        // data meja/seats controller
            // create
                Route::get('/adashboard/addnewseats', 'AdminDataSeatsControl@create');
                Route::post('/seats/add', 'AdminDataSeatsControl@Store');
            // delete
                Route::get('/adashboard/seats/delete/{seat}', 'AdminDataSeatsControl@destroy');
                Route::get('/adashboard/seats/deactivate/{seat}', 'AdminDataSeatsControl@hapus_sementara');
                Route::get('/adashboard/seats/activate/{seat}', 'AdminDataSeatsControl@kembalikan_sampah');

    // admin bridge user controller
        // static controller
            Route::get('/adashboard/users', 'AdminDataUsersControl@index');

        // data meja/users controller
            // create
                Route::get('/adashboard/addnewusers', 'AdminDataUsersControl@create');
                Route::post('/users/add', 'AdminDataUsersControl@store');
            // detail
                Route::get('/adashboard/users/detail/{user}', 'AdminDataUsersControl@show');
            // edit
                Route::get('/adashboard/users/edit/{user}', 'AdminDataUsersControl@edit');
                Route::patch('/users/update/{user}', 'AdminDataUsersControl@update');
            // delete
                Route::get('/adashboard/users/delete/{user}', 'AdminDataUsersControl@destroy');

// waiter
    // waiter bridge controller
        // static controller
            Route::get('/',  'WaiterBridgeControl@main');
            Route::get('/wdashboard', 'WaiterBridgeControl@index')->middleware('auth');


