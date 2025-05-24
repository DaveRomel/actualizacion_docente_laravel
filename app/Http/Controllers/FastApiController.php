<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FastApiController extends Controller
{
    private $baseUrl = 'http://192.168.254.12:4000/api';

    // Crear usuario
    public function createUser(Request $request)
    {
        $response = Http::post("{$this->baseUrl}/user", $request->all());
        return response()->json($response->json(), $response->status());
    }

    // Actualizar usuario
    public function updateUser(Request $request, $user_id)
    {
        $token = $request->bearerToken(); // O consigue el token desde otra fuente
        $response = Http::withToken($token)->put("{$this->baseUrl}/user/{$user_id}", $request->all());
        return response()->json($response->json(), $response->status());
    }

    // Cambiar estado del usuario
    public function changeUserStatus(Request $request, $status, $user_id)
    {
        $token = $request->bearerToken();
        $response = Http::withToken($token)->put("{$this->baseUrl}/user_status_{$status}/{$user_id}");
        return response()->json($response->json(), $response->status());
    }

    // Recuperar contraseña
    public function recuperarPassword(Request $request)
    {
        $response = Http::post("{$this->baseUrl}/recuperar", [
            'email' => $request->input('email')
        ]);
        return response()->json($response->json(), $response->status());
    }

    // Cambiar contraseña
    public function cambiarContrasena(Request $request)
    {
        $response = Http::put("{$this->baseUrl}/cambiar_contrasena", $request->all());
        return response()->json($response->json(), $response->status());
    }

    // Inscribir usuario
    public function inscribirUsuario(Request $request, $usuario_id, $materia_id)
    {
        $token = $request->bearerToken();
        $response = Http::withToken($token)->post("{$this->baseUrl}/inscripcion/{$usuario_id}/{$materia_id}");
        return response()->json($response->json(), $response->status());
    }

    // Ver inscripciones por materia
    public function verInscripcionesPorMateria($materia_id)
    {
        $response = Http::get("{$this->baseUrl}/inscripcion/{$materia_id}");
        return response()->json($response->json(), $response->status());
    }

    // Contar inscritos
    public function contarInscritos($materia_id)
    {
        $response = Http::get("{$this->baseUrl}/inscripcion/contar_inscritos_por_materia/{$materia_id}");
        return response()->json($response->json(), $response->status());
    }

    // Eliminar inscripción
    public function eliminarInscripcion(Request $request, $usuario_id)
    {
        $token = $request->bearerToken();
        $response = Http::withToken($token)->delete("{$this->baseUrl}/inscripcion/{$usuario_id}");
        return response()->json($response->json(), $response->status());
    }

    // Login y obtener token
    public function login(Request $request)
    {
        $response = Http::asForm()->post("{$this->baseUrl}/token", [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ]);

        if ($response->successful()) {
            // Guardar el token en la sesión
            session(['api_token' => $response['access_token']]);

            // Redirigir al dashboard o vista principal
            return redirect('/dashboard'); // Cambia esta ruta según tu flujo
        } else {
            return back()->withErrors(['login' => 'Credenciales incorrectas.'])->withInput();
        }
    }


    // Obtener el usuario autenticado
    public function getCurrentUser(Request $request)
    {
        $token = $request->bearerToken();
        $response = Http::withToken($token)->get("{$this->baseUrl}/users/me/");
        return response()->json($response->json(), $response->status());
    }

    // Obtener ítems del usuario autenticado
    public function getUserItems(Request $request)
    {
        $token = $request->bearerToken();
        $response = Http::withToken($token)->get("{$this->baseUrl}/users/me/items/");
        return response()->json($response->json(), $response->status());
    }

}
