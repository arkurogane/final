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
    Route::get('/datos', 'HomeController@datos')->name('datos');
    
});
Route::get('/docentes', 'AdminController@read_Docente')->name('docentes')->middleware('admin','auth');

Route::get('/eliminar/{id}', 'AdminController@eliminarDocente')->middleware('admin','auth');
Route::post('/actualizar/{id}', 'AdminController@actualizar')->middleware('admin','auth');
Route::get('/cambiapassword', 'HomeController@cambiapassword')->middleware('auth');
Route::post('/cambiar', 'HomeController@cambiar')->middleware('auth');
Route::get('/actualizarDocente/{id}','AdminController@actualizarDocente')->middleware('admin','auth');

Route::get('/asignaturas', 'DocenteController@asignaturas')->name('asignaturas')->middleware('doc','auth');
Route::post('/agregarAsignatura', 'DocenteController@agregarAsignatura')->name('agregarAsignatura')->middleware('doc','auth');

Route::get('/crearCurso', 'DocenteController@crearCurso')->name('crearCurso')->middleware('doc','auth');
Route::post('/creaCurso', 'DocenteController@creaCurso')->name('creaCurso')->middleware('doc','auth');

Route::get('/listaCurso','DocenteController@listaCurso')->name('listaCurso')->middleware('doc','auth');

Route::get('/cerrarCurso/{id}', 'DocenteController@cerrarCurso')->name('cerrarCurso')->middleware('doc','auth');

Route::get('/cursosCerrados', 'DocenteController@cursosCerrados')->name('cursosCerrados')->middleware('doc','auth');