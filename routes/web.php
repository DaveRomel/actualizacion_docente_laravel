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

Route::get('/matematicas/inscripcion/', function () {
    $token = session('api_token');
    $baseUrl = 'http://192.168.254.12:4001';
    try {
        $response = Http::withToken($token)->get("{$baseUrl}/api/inscripcion/contar_inscritos_por_materia/3");
        $data = $response->json();
        $contagem_inscritos = is_numeric($data) ? $data : ($data['count'] ?? 0);
    } catch (\Throwable $e) {
        $contagem_inscritos = 0;
    }
    return view('actualizacion_docente.matematicas.matematicas', compact('contagem_inscritos'));
})->name('inscripcion_matematicas')->middleware('ensure.api.data');

Route::get('/matematicas/confirmacion/', function () {
    $token = session('api_token');
    $baseUrl = 'http://192.168.254.12:4001';
    try {
        $response = Http::withToken($token)->get("{$baseUrl}/api/inscripcion/contar_inscritos_por_materia/3");
        $data = $response->json();
        $contagem_inscritos = is_numeric($data) ? $data : ($data['count'] ?? 0);
    } catch (\Throwable $e) {
        $contagem_inscritos = 0;
    }
    return view('actualizacion_docente.matematicas.confirmacion', compact('contagem_inscritos'));
})->name('confirmacion_matematicas')->middleware('ensure.api.data');

Route::get('/computacion/inscripcion', function () {
    $token = session('api_token');
    $baseUrl = 'http://192.168.254.12:4001';
    try {
        $response = Http::withToken($token)->get("{$baseUrl}/api/inscripcion/contar_inscritos_por_materia/1");
        $data = $response->json();
        $contagem_inscritos = is_numeric($data) ? $data : ($data['count'] ?? 0);
    } catch (\Throwable $e) {
        $contagem_inscritos = 0;
    }
    return view('actualizacion_docente.computacion.computacion', compact('contagem_inscritos'));
})->name('inscripcion_computacion')->middleware('ensure.api.data');

Route::get('/computacion/confirmacion', function () {
    $token = session('api_token');
    $baseUrl = 'http://192.168.254.12:4001';
    try {
        $response = Http::withToken($token)->get("{$baseUrl}/api/inscripcion/contar_inscritos_por_materia/1");
        $data = $response->json();
        $contagem_inscritos = is_numeric($data) ? $data : ($data['count'] ?? 0);
    } catch (\Throwable $e) {
        $contagem_inscritos = 0;
    }
    return view('actualizacion_docente.computacion.confirmacion', compact('contagem_inscritos'));
})->name('confirmacion_computacion')->middleware('ensure.api.data');

Route::get('/electronica/inscripcion', function () {
    $token = session('api_token');
    $baseUrl = 'http://192.168.254.12:4001';
    try {
        $response = Http::withToken($token)->get("{$baseUrl}/api/inscripcion/contar_inscritos_por_materia/8");
        $data = $response->json();
        $contagem_inscritos = is_numeric($data) ? $data : ($data['count'] ?? 0);
    } catch (\Throwable $e) {
        $contagem_inscritos = 0;
    }
    return view('actualizacion_docente.electronica.electronica', compact('contagem_inscritos'));
})->name('inscripcion_electronica')->middleware('ensure.api.data');

Route::get('/electronica/confirmacion', function () {
    $token = session('api_token');
    $baseUrl = 'http://192.168.254.12:4001';
    try {
        $response = Http::withToken($token)->get("{$baseUrl}/api/inscripcion/contar_inscritos_por_materia/8");
        $data = $response->json();
        $contagem_inscritos = is_numeric($data) ? $data : ($data['count'] ?? 0);
    } catch (\Throwable $e) {
        $contagem_inscritos = 0;
    }
    return view('actualizacion_docente.electronica.confirmacion', compact('contagem_inscritos'));
})->name('confirmacion_electronica')->middleware('ensure.api.data');

Route::get('/ingles/inscripcion', function () {
    $token = session('api_token');
    $baseUrl = 'http://192.168.254.12:4001';
    try {
        $response = Http::withToken($token)->get("{$baseUrl}/api/inscripcion/contar_inscritos_por_materia/9");
        $data = $response->json();
        $contagem_inscritos = is_numeric($data) ? $data : ($data['count'] ?? 0);
    } catch (\Throwable $e) {
        $contagem_inscritos = 0;
    }
    return view('actualizacion_docente.ingles.ingles', compact('contagem_inscritos'));
})->name('inscripcion_ingles')->middleware('ensure.api.data');

Route::get('/ingles/confirmacion', function () {
    $token = session('api_token');
    $baseUrl = 'http://192.168.254.12:4001';
    try {
        $response = Http::withToken($token)->get("{$baseUrl}/api/inscripcion/contar_inscritos_por_materia/9");
        $data = $response->json();
        $contagem_inscritos = is_numeric($data) ? $data : ($data['count'] ?? 0);
    } catch (\Throwable $e) {
        $contagem_inscritos = 0;
    }
    return view('actualizacion_docente.ingles.confirmacion', compact('contagem_inscritos'));
})->name('confirmacion_ingles')->middleware('ensure.api.data');

Route::get('/fisica/inscripcion', function () {
    $token = session('api_token');
    $baseUrl = 'http://192.168.254.12:4001';
    try {
        $response = Http::withToken($token)->get("{$baseUrl}/api/inscripcion/contar_inscritos_por_materia/2");
        $data = $response->json();
        $contagem_inscritos = is_numeric($data) ? $data : ($data['count'] ?? 0);
    } catch (\Throwable $e) {
        $contagem_inscritos = 0;
    }
    return view('actualizacion_docente.fisica.fisica', compact('contagem_inscritos'));
})->name('inscripcion_fisica')->middleware('ensure.api.data');

Route::get('/fisica/confirmacion', function () {
    $token = session('api_token');
    $baseUrl = 'http://192.168.254.12:4001';
    try {
        $response = Http::withToken($token)->get("{$baseUrl}/api/inscripcion/contar_inscritos_por_materia/2");
        $data = $response->json();
        $contagem_inscritos = is_numeric($data) ? $data : ($data['count'] ?? 0);
    } catch (\Throwable $e) {
        $contagem_inscritos = 0;
    }
    return view('actualizacion_docente.fisica.confirmacion', compact('contagem_inscritos'));
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