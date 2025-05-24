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
        $data = [
            'name'   => $request->input('nombre'),
            'celular' => $request->input('telefono'),
            'procedencia'  => $request->input('escuela'),
            'email'    => $request->input('correo'),
            'user_passw' => $request->input('contrasena'),
        ];
        $response = Http::post("{$this->baseUrl}/user", $data);
        return redirect('/iniciar_sesion');
    }

    // Actualizar usuario
    public function updateUser(Request $request, $user_id)
    {
        $token = $token = session('api_token');
        $response = Http::withToken($token)->put("{$this->baseUrl}/user/{$user_id}", $request->all());
        // Guardar el token en la sesión
        $userResponse = Http::withToken($token)->get("http://192.168.254.12:4000/users/me/");


        if ($userResponse->successful()) {
            session(['current_user_data' => $userResponse->json()]);
            return redirect('/principal');
        }
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
        $response = Http::asForm()->post("http://192.168.254.12:4000/token", [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ]);

        if ($response->successful()) {
            $responseData = $response->json();
            if (!isset($responseData['access_token'])) {
                return back()->withErrors(['login' => 'Token de acesso no recibido de la API.'])->withInput();
            }
            $accessToken = $responseData['access_token'];
            // Guardar el token en la sesión
            session(['api_token' => $accessToken]);
            $userResponse = Http::withToken($accessToken)->get("http://192.168.254.12:4000/users/me/");


            if ($userResponse->successful()) {
            session(['current_user_data' => $userResponse->json()]);
            return redirect('/principal'); // Cambia esta ruta según tu flujo
        } else {
            session()->forget('api_token');
            return back()->withErrors(['login' => 'No fue posible obtener los datos del usuario']);
        }
            // Redirigir al dashboard o vista principal
            //showUserProfile($request);
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

    //Cerrar sesión
    public function logout(Request $request)
    {
        $request -> session()->forget('api_token');
        //$request->session()->invalidate();
        //$request->session()->regenerateToken();
        return redirect('/');
    }

}
