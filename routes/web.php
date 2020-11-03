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
    
});