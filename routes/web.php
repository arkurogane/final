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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => 'auth'],function (){
    Route::get('/datos/{id}', 'HomeController@datos')->name('datos');
    
});
Route::get('/docentes', 'AdminController@read_Docente')->name('docentes')->middleware('admin','auth');

Route::get('/eliminar/{id}', 'AdminController@eliminarDocente')->middleware('admin','auth');
Route::post('/actualizar/{id}', 'AdminController@actualizar')->middleware('admin','auth');
Route::get('/cambiapassword/{id}', 'HomeController@cambiapassword')->middleware('auth');
Route::post('/cambiar/{id}', 'HomeController@cambiar')->middleware('auth');
Route::get('/actualizarDocente/{id}','AdminController@actualizarDocente')->middleware('admin','auth');

