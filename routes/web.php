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
Route::get('/', function () {
    return view('actualizacion_docente.layouts.index');
})->name('index');

Route::get('/registrarse', function () {
    return view('actualizacion_docente.layouts.registro');
})->name('registrarse');

Route::get('/editar', function () {
    return view('actualizacion_docente.layouts.editar');
})->name('editar');

Route::get('/iniciar_sesion', function () {
    return view('actualizacion_docente.layouts.iniciar_sesion');
})->name('iniciar_sesion');
/*
Route::get('/editar', function () {
    return view('actualizacion_docente.layouts.editar');
});*/

Route::get('/recuperar_contraseña', function () {
    return view('actualizacion_docente.layouts.cambiar_password');
})->name('recuperar_contraseña');

Route::get('/matematicas/inscripcion/', function () {
    return view('actualizacion_docente.matematicas.matematicas');
})->name('inscripcion_matematicas');

Route::get('/matematicas/confirmacion/', function () {
    return view('actualizacion_docente.matematicas.confirmacion');
})->name('confirmacion_matematicas');

Route::get('/computacion/inscripcion', function () {
    return view('actualizacion_docente.computacion.computacion');
})->name('inscripcion_computacion');

Route::get('/computacion/confirmacion', function () {
    return view('actualizacion_docente.computacion.confirmacion');
})->name('confirmacion_computacion');

Route::get('/fisica/inscripcion', function () {
    return view('actualizacion_docente.fisica.fisica');
})->name('inscripcion_fisica');

Route::get('/fisica/confirmacion', function () {
    return view('actualizacion_docente.fisica.confirmacion');
})->name('confirmacion_fisica');

Route::get('/principal', function () {
    return view('actualizacion_docente.home.home');
})->name('principal');

Route::post('/login', [FastApiController::class, 'login']);