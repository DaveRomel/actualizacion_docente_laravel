<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FastApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/crear-usuario', [FastApiController::class, 'createUser']);
Route::put('/actualizar-usuario/{user_id}', [FastApiController::class, 'updateUser']);
Route::put('/cambiar-estado-usuario/{status}/{user_id}', [FastApiController::class, 'changeUserStatus']);
Route::post('/recuperar-password', [FastApiController::class, 'recuperarPassword']);
Route::put('/cambiar-contrasena', [FastApiController::class, 'cambiarContrasena']);
Route::post('/inscribir-usuario/{usuario_id}/{materia_id}', [FastApiController::class, 'inscribirUsuario']);
Route::get('/ver-inscripciones/{materia_id}', [FastApiController::class, 'verInscripcionesPorMateria']);
Route::get('/contar-inscritos/{materia_id}', [FastApiController::class, 'contarInscritos']);
Route::delete('/eliminar-inscripcion/{usuario_id}', [FastApiController::class, 'eliminarInscripcion']);
Route::post('/login', [FastApiController::class, 'login']);
Route::get('/usuario-actual', [FastApiController::class, 'getCurrentUser']);
Route::get('/usuario-items', [FastApiController::class, 'getUserItems']);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
