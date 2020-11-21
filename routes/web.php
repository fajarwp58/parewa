<?php

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::get('logout', function(){
    Auth::logout();
    return redirect('login');
});

Route::group(['middleware' => ['auth', 'roles'], 'roles' => ['manager','head barista','barista']], function () {

    Route::group(['prefix' => 'home'], function () {
        Route::get('/', 'HomeController@index')->name('home');
    });

});

Route::group(['middleware' => ['auth', 'roles'], 'roles' => ['manager']], function () {

    Route::group(['prefix' => 'user'], function () {
        Route::get('/profile', 'UserController@profile');
        Route::get('/kelolauser', 'UserController@kelolauser');
        Route::get('/data', 'UserController@data');
        Route::get('/listrole', 'UserController@listrole');
        Route::post('/create', 'UserController@create');
        Route::post('/edit/{id}', 'UserController@edit');
        Route::get('/delete/{id}', 'UserController@delete');
    });

    Route::group(['prefix' => 'supplier'], function () {
        Route::get('/index', 'SupplierController@index');
        Route::get('/data', 'SupplierController@data');
        Route::post('/create', 'SupplierController@create');
        Route::post('/edit/{id}', 'SupplierController@edit');
        Route::get('/delete/{id}', 'SupplierController@delete');
    });

    Route::group(['prefix' => 'stock'], function () {
        Route::get('/index', 'StockController@index');
        Route::get('/data', 'stockController@data');
        Route::post('/create', 'stockController@create');
        Route::post('/edit/{id}', 'stockController@edit');
        Route::get('/delete/{id}', 'stockController@delete');
    });

    Route::group(['prefix' => 'pembelian'], function () {
        Route::get('/', 'PembelianController@index')->name('pembelian.index');
        Route::get('/detail', 'PembelianController@index2')->name('pembelian_detail.index');
        Route::get('/data', 'PembelianController@listData')->name('pembelian.data');
        Route::get('/data2', 'PembelianController@listData2')->name('pembelian_detail.data');
        Route::get('/{id}/tambah', 'PembelianController@create');
        Route::get('/{id}/lihat', 'PembelianController@show');
        Route::post('/store', 'PembelianController@store')->name('pembelian.store');
        Route::post('/store2', 'PembelianController@store2')->name('pembelian_detail.store');
        Route::get('/pembelian_detail/loadform/{diskon}/{total}', 'PembelianController@loadForm');
        Route::get('/delete/{id}', 'PembelianController@delete');
        Route::get('/update/{id}', 'PembelianController@update');
        Route::get('/delete/{id}', 'PembelianController@delete');
        Route::get('/delete2/{id}', 'PembelianController@delete2');
        //Route::resource('/', 'PembelianController');  
    });
    
});