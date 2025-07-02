<?php
use App\Http\Controllers\FastApiController;
use Illuminate\Support\Facades\Route;
use App\Providers\ViewServiceProvider;
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
})->name('editar')->middleware('ensure.api.data');

Route::get('/iniciar_sesion', function () {
    return view('actualizacion_docente.layouts.iniciar_sesion');
})->name('iniciar_sesion');

Route::get('/video', function () {
    return view('actualizacion_docente.layouts.video');
})->name('video');

Route::get('/cambiar_contrasena', function () {
    return view('actualizacion_docente.layouts.enviar_correo');
})->name('cambiar_contrasena');

Route::get('/recuperar_contraseña', function () {
    return view('actualizacion_docente.layouts.cambiar_password');
})->name('recuperar_contraseña');

Route::get('/matematicas/inscripcion/', function () {
    return view('actualizacion_docente.matematicas.matematicas');
})->name('inscripcion_matematicas')->middleware('ensure.api.data');

Route::get('/matematicas/confirmacion/', function () {
    return view('actualizacion_docente.matematicas.confirmacion');
})->name('confirmacion_matematicas')->middleware('ensure.api.data');

Route::get('/computacion/inscripcion', function () {
    return view('actualizacion_docente.computacion.computacion');
})->name('inscripcion_computacion')->middleware('ensure.api.data');

Route::get('/computacion/confirmacion', function () {
    return view('actualizacion_docente.computacion.confirmacion');
})->name('confirmacion_computacion')->middleware('ensure.api.data');

Route::get('/fisica/inscripcion', function () {
    return view('actualizacion_docente.fisica.fisica');
})->name('inscripcion_fisica')->middleware('ensure.api.data');

Route::get('/fisica/confirmacion', function () {
    return view('actualizacion_docente.fisica.confirmacion');
})->name('confirmacion_fisica')->middleware('ensure.api.data');

Route::get('/principal', function () {
    return view('actualizacion_docente.home.home');
})->name('principal')->middleware('ensure.api.data');

Route::post('/login', [FastApiController::class, 'login']);
Route::post('/logout', [FastApiController::class, 'logout'])->name('logout');
Route::put('/actualizar-usuario/{user_id}', [FastApiController::class, 'updateUser']);
Route::post('/inscribir-usuario/{usuario_id}/{materia_id}', [FastApiController::class, 'inscribirUsuario']);
Route::put('/eliminar-inscripcion/{usuario_id}', [FastApiController::class, 'eliminarInscripcion']);
Route::post('/recuperar-password', [FastApiController::class, 'recuperarPassword']);
Route::put('/cambiar-contrasena', [FastApiController::class, 'cambiarContrasena']);