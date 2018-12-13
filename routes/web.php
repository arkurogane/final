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

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');


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
Route::get('/cursoDetalle/{id}', 'DocenteController@cursoDetalle')->name('cursoDetalle')->middleware('doc','auth');

Route::get('/cerrarCurso/{id}', 'DocenteController@cerrarCurso')->name('cerrarCurso')->middleware('doc','auth');

Route::get('/cursosCerrados', 'DocenteController@cursosCerrados')->name('cursosCerrados')->middleware('doc','auth');

Route::get('/Actividades', 'DocenteController@Actividades')->name('Actividades')->middleware('doc','auth');
Route::post('/createActividad', 'DocenteController@createActividad')->name('createActividad')->middleware('doc','auth');
Route::get('/actividadDetalle/{id}', 'DocenteController@actividadDetalle')->name('actividadDetalle')->middleware('doc','auth');
Route::get('/cursoDetalle/addActividad/{id}', 'DocenteController@addActividad')->name('addActividad')->middleware('doc','auth');
Route::post('/actividadCurso', 'DocenteController@actividadCurso')->name('actividadCurso')->middleware('doc','auth');
Route::get('/cursoDetalle/dropActividad/{id}', 'DocenteController@dropActividad')->name('dropActividad')->middleware('doc','auth');
Route::post('/deleteActividadCurso', 'DocenteController@deleteActividadCurso')->name('deleteActividadCurso')->middleware('doc','auth');
Route::get('/deleteActividad/{id}', 'DocenteController@deleteActividad')->name('deleteActividad')->middleware('doc','auth');
Route::get('/updateActividad/{id}', 'DocenteController@updateActividad')->name('updateActividad')->middleware('doc','auth');
Route::post('/ActividadUpdate', 'DocenteController@ActividadUpdate')->name('ActividadUpdate')->middleware('doc','auth');


Route::get('/alumnosCurso/{id}', 'DocenteController@alumnosCurso')->name('alumnosCurso')->middleware('doc','auth');
Route::get('/asignarPuntos/{id}', 'DocenteController@asignarPuntos')->name('asignarPuntos')->middleware('doc','auth');
Route::get('/detallesAlumno/{id}/{id_c}', 'DocenteController@detallesAlumno')->name('detallesAlumno')->middleware('doc','auth');
Route::get('/quitarAlumno/{id}', 'DocenteController@quitarAlumno')->name('quitarAlumno')->middleware('doc','auth');
Route::post('/puntos', 'DocenteController@puntos')->name('puntos')->middleware('doc','auth');


Route::get('/addParticipantes','DocenteController@addParticipantes')->name('addParticipantes')->middleware('doc','auth');
Route::post('/crearParticipante', 'Docentecontroller@crearParticipante');

Route::get('/Participante', 'AlumnoController@Participante')->name('Participante')->middleware('auth');
Route::post('/Participar', 'AlumnoController@Participar')->name('Participar')->middleware('auth');

Route::get('/cursos', 'AlumnoController@cursos')->name('cursos')->middleware('auth');
Route::get('/curso_detalle/{id}', 'AlumnoController@curso_detalle')->name('curso_detalle')->middleware('auth');
Route::get('/premios/{id}', 'AlumnoController@premios')->name('premios')->middleware('auth');
Route::get('/actividad_detalle/{id1}/{id2}', 'AlumnoController@actividad_detalle')->name('actividad_detalle')->middleware('auth');
Route::post('/canjear', 'AlumnoController@canjear')->name('canjear')->middleware('auth');

Route::get('/conversaciones', 'DocenteController@conversations')->name('conversations')->middleware('doc','auth');
Route::get('/crearConversacion/{alumno_id}','DocenteController@createConversation')->name('crearConversacion')->middleware('doc','auth');
Route::post('/crearMensaje','DocenteController@createMessage')->name('crearMensaje')->middleware('doc','auth');
Route::get('/mensajes/{id}', 'DocenteController@messages')->middleware('doc','auth');

Route::get('/conversacionDocente', 'AlumnoController@conversations')->name('conversacionDocente')->middleware('auth');
Route::get('/crear_conversacion_docente/{curso_id}','AlumnoController@createConversation')->middleware('auth');
Route::post('/mensajeDocente','AlumnoController@createMessage')->name('mensajeDocente')->middleware('auth');
Route::get('/mensajes_a_docente/{id}', 'AlumnoController@messages')->middleware('auth');

Route::get('/paginaNotificaciones', 'HomeController@pageNotification')->name('paginaNotificaciones')->middleware('auth');