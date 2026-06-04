<?php
use App\Http\Controllers\FastApiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
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
/*
Route::get('/editar', function () {
    return view('actualizacion_docente.layouts.editar');
});*/

Route::get('/cambiar_contrasena', function () {
    return view('actualizacion_docente.layouts.enviar_correo');
})->name('cambiar_contrasena');

Route::get('/recuperar_contraseña', function () {
    return view('actualizacion_docente.layouts.cambiar_password');
})->name('recuperar_contraseña');

$baseUrl = 'http://127.0.0.1:4001';

$fetchCount = function (int $materiaId) use ($baseUrl): int {
    try {
        $response = Http::withToken(session('api_token'))
            ->get("{$baseUrl}/api/inscripcion/contar_inscritos_por_materia/{$materiaId}");
        $data = $response->json();
        return is_numeric($data) ? (int) $data : ($data['count'] ?? 0);
    } catch (\Throwable $e) {
        return 0;
    }
};

Route::get('/matematicas/inscripcion/', function () use ($fetchCount) {
    return view('actualizacion_docente.matematicas.matematicas', [
        'contagem_inscritos' => $fetchCount(3)
    ]);
})->name('inscripcion_matematicas')->middleware('ensure.api.data');

Route::get('/matematicas/confirmacion/', function () use ($fetchCount) {
    return view('actualizacion_docente.matematicas.confirmacion', [
        'contagem_inscritos' => $fetchCount(3)
    ]);
})->name('confirmacion_matematicas')->middleware('ensure.api.data');

Route::get('/computacion/inscripcion', function () use ($fetchCount) {
    return view('actualizacion_docente.computacion.computacion', [
        'contagem_inscritos' => $fetchCount(1)
    ]);
})->name('inscripcion_computacion')->middleware('ensure.api.data');

Route::get('/computacion/confirmacion', function () use ($fetchCount) {
    return view('actualizacion_docente.computacion.confirmacion', [
        'contagem_inscritos' => $fetchCount(1)
    ]);
})->name('confirmacion_computacion')->middleware('ensure.api.data');

Route::get('/electronica/inscripcion', function () use ($fetchCount) {
    return view('actualizacion_docente.electronica.electronica', [
        'contagem_inscritos' => $fetchCount(8)
    ]);
})->name('inscripcion_electronica')->middleware('ensure.api.data');

Route::get('/electronica/confirmacion', function () use ($fetchCount) {
    return view('actualizacion_docente.electronica.confirmacion', [
        'contagem_inscritos' => $fetchCount(8)
    ]);
})->name('confirmacion_electronica')->middleware('ensure.api.data');

Route::get('/ingles/inscripcion', function () use ($fetchCount) {
    return view('actualizacion_docente.ingles.ingles', [
        'contagem_inscritos' => $fetchCount(9)
    ]);
})->name('inscripcion_ingles')->middleware('ensure.api.data');

Route::get('/ingles/confirmacion', function () use ($fetchCount) {
    return view('actualizacion_docente.ingles.confirmacion', [
        'contagem_inscritos' => $fetchCount(9)
    ]);
})->name('confirmacion_ingles')->middleware('ensure.api.data');

Route::get('/fisica/inscripcion', function () use ($fetchCount) {
    return view('actualizacion_docente.fisica.fisica', [
        'contagem_inscritos' => $fetchCount(2)
    ]);
})->name('inscripcion_fisica')->middleware('ensure.api.data');

Route::get('/fisica/confirmacion', function () use ($fetchCount) {
    return view('actualizacion_docente.fisica.confirmacion', [
        'contagem_inscritos' => $fetchCount(2)
    ]);
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

Route::get('/materia/{id}/inscritos', [FastApiController::class, 'contarInscritos'])->name('materia.inscritos.count');


Route::get('/error', function () {
    abort(500, 'Soy una tetera');
});