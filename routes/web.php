<?php
use App\Http\Controllers\FastApiController;
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
Route::get('/', function () {
    return view('welcome');
});
Route::get('/fastapi-lale', [FastApiController::class, 'get_users']);

Route::get('/', function () {
    return view('actualizacion_docente.welcome');
    
});

Route::get('/fisica', function () {
    return view('fisica.fisica');
});

Route::middleware('auth')-> group(function(){
    
});
*/
Route::get('/matematicas', function () {
    return view('matematicas.matematicas');
});

Route::get('/', function () {
    return view('actualizacion_docente.layouts.index');
});

Route::get('/registro', function () {
    return view('actualizacion_docente.layouts.registro');
});

Route::get('/editar', function () {
    return view('actualizacion_docente.layouts.editar');
});

Route::get('/iniciar_sesion', function () {
    return view('actualizacion_docente.iniciar_sesion');
});

Route::get('/recuperar_contraseña', function () {
    return view('actualizacion_docente.recuperar_contraseña');
});
Route::get('/inscripcion/computacion', function () {
    return view('computacion.principal');
});

Route::get('/confirmacion/computacion', function () {
    return view('computacion.confirmacion');
});