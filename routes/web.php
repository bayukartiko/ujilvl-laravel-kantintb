<?php

use App\Http\Controllers\AdminDataGoodsControl;
use App\Http\Controllers\AdminDataMerchants;
use Illuminate\Contracts\Cache\Store;
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

// admin bridge controller
    // static controller
        Route::get('/',  'AdminBridgeControl@main');
        Route::get('/login', 'AdminBridgeControl@login');
        Route::get('/register', 'AdminBridgeControl@register');
        Route::get('/forgot_password', 'AdminBridgeControl@forgot_password');
        Route::get('/dashboard', 'AdminBridgeControl@index');

// admin bridge makanan/goods controller
    // static controller
        Route::get('/dashboard/goods', 'AdminDataGoodsControl@index');

    // data makanan/goods controller
        // create
            Route::get('/dashboard/addnewgoods', 'AdminDataGoodsControl@create');
            Route::post('/goods/add', 'AdminDataGoodsControl@Store');
        // detail
            Route::get('/dashboard/goods/detail/{food}', 'AdminDataGoodsControl@show');
        // edit
            Route::get('/dashboard/goods/edit/{food}', 'AdminDataGoodsControl@edit');
            Route::patch('/goods/update/{food}', 'AdminDataGoodsControl@update');
        // delete
            Route::get('/dashboard/goods/delete/{food}', 'AdminDataGoodsControl@destroy');

// admin bridge meja/seat controller
    // static controller
        Route::get('/dashboard/seats', 'AdminDataSeatsControl@index');

    // data meja/seats controller
        // create
            Route::get('/dashboard/addnewseats', 'AdminDataSeatsControl@create');
            Route::post('/seats/add', 'AdminDataSeatsControl@Store');
        // delete
            Route::get('/dashboard/seats/delete/{seat}', 'AdminDataSeatsControl@destroy');
            Route::get('/dashboard/seats/deactivate/{seat}', 'AdminDataSeatsControl@hapus_sementara');
            Route::get('/dashboard/seats/activate/{seat}', 'AdminDataSeatsControl@kembalikan_sampah');

// admin bridge user controller
    // static controller
        Route::get('/dashboard/users', 'AdminDataUsersControl@index');

    // data meja/users controller
        // create
            Route::get('/dashboard/addnewusers', 'AdminDataUsersControl@create');
            Route::post('/users/add', 'AdminDataUsersControl@store');
        // detail
            Route::get('/dashboard/users/detail/{user}', 'AdminDataUsersControl@show');
        // edit
            Route::get('/dashboard/users/edit/{user}', 'AdminDataUsersControl@edit');
            Route::patch('/users/update/{user}', 'AdminDataUsersControl@update');
        // delete
            Route::get('/dashboard/users/delete/{user}', 'AdminDataUsersControl@destroy');

