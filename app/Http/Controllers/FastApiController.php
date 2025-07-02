<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;

class FastApiController extends Controller
{
    // private $baseUrl = 'http://192.168.254.12:4001/api';
    /* private $baseUrl = 'http://localhost:4000/api'; */
    private $baseUrl = 'http://192.168.0.11:4000/api';

    /**
     * Crea un nuevo usuario.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function createUser(Request $request)
    {
        try {
            $data = [
                'name'         => $request->input('nombre'),
                'celular'      => $request->input('telefono'),
                'procedencia'  => $request->input('escuela'),
                'email'        => $request->input('correo'),
                'user_passw'   => $request->input('contrasena'),
            ];

            $response = Http::post("{$this->baseUrl}/user", $data);

            if ($response->status() === 400) {
                return response()->json(['message' => 'El correo electrónico ya ha sido registrado.'], 400);
            } elseif ($response->successful()) {
                return redirect('/iniciar_sesion');
            } else {
                return response()->json(['message' => 'Error al registrar el usuario. Por favor, intente de nuevo.'], $response->status());
            }
        } catch (\Exception $e) {
            return response()->view('errors.generico');
        }
    }

    /**
     * Actualiza un usuario existente.
     */
    public function updateUser(Request $request, $user_id)
    {
        try {
            $token = session('api_token');
            $response = Http::withToken($token)->put("{$this->baseUrl}/user/{$user_id}", $request->all());

            if ($response->successful()) {
                $userResponse = Http::withToken($token)->get("{$this->baseUrl}/users/me/");
                if ($userResponse->successful()) {
                    session(['current_user_data' => $userResponse->json()]);
                    return redirect('/principal');
                }
            }
            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            return response()->view('errors.generico');
        }
    }

    /**
     * Cambia el estado de un usuario.
     */
    public function changeUserStatus(Request $request, $status, $user_id)
    {
        try {
            $token = $request->bearerToken();
            $response = Http::withToken($token)->put("{$this->baseUrl}/user_status_{$status}/{$user_id}");
            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            return response()->view('errors.generico');
        }
    }

    /**
     * Recupera la contraseña de un usuario.
     */
    public function recuperarPassword(Request $request)
    {
        try {
            $correo = $request->input('email');
            $response = Http::post("{$this->baseUrl}/recuperar?email={$correo}");
            session(['correo' => $correo]);
            return redirect('/recuperar_contraseña');
        } catch (\Exception $e) {
            return response()->view('errors.generico');
        }
    }

    /**
     * Cambia la contraseña de un usuario.
     */
    public function cambiarContrasena(Request $request)
    {
        try {
            session()->forget('correo');
            $response = Http::put("{$this->baseUrl}/cambiar_contrasena", $request->all());
            return redirect('/iniciar_sesion');
        } catch (\Exception $e) {
            return response()->view('errors.generico');
        }
    }

    /**
     * Inscribe un usuario a una materia.
     */
    public function inscribirUsuario(Request $request, $usuario_id, $materia_id)
    {
        try {
            $token = session('api_token');
            $response = Http::withToken($token)->post("{$this->baseUrl}/inscripcion/{$usuario_id}/{$materia_id}");
            if ($response->successful()){
                $userResponse = Http::withToken($token)->get("{$this->baseUrl}/users/me/");
                if ($userResponse->successful()) {
                    session(['current_user_data' => $userResponse->json()]);
                    switch ($materia_id) {
                        case 1: return redirect('/computacion/confirmacion');
                        case 2: return redirect('/fisica/confirmacion');
                        default: return redirect('/matematicas/confirmacion');
                    }
                }
            }
            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            return response()->view('errors.generico');
        }
    }

    /**
     * Ver inscripciones por materia.
     */
    public function verInscripcionesPorMateria($materia_id)
    {
        try {
            $response = Http::get("{$this->baseUrl}/inscripcion/{$materia_id}");
            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            return response()->view('errors.generico');
        }
    }

    /**
     * Contar inscritos por materia.
     */
    public function contarInscritos($materia_id)
    {
        try {
            $response = Http::get("{$this->baseUrl}/inscripcion/contar_inscritos_por_materia/{$materia_id}");
            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            return response()->view('errors.generico');
        }
    }

    /**
     * Eliminar una inscripción.
     */
    public function eliminarInscripcion(Request $request, $usuario_id)
    {
        try {
            $token = session('api_token');
            $response = Http::withToken($token)->put("{$this->baseUrl}/inscripcion/{$usuario_id}");
            if ($response->successful()){
                $userResponse = Http::withToken($token)->get("{$this->baseUrl}/users/me/");
                if ($userResponse->successful()) {
                    session(['current_user_data' => $userResponse->json()]);
                    return redirect('/principal');
                }
            }
            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            return response()->view('errors.generico');
        }
    }

    /**
     * Realiza el login y obtiene el token de acceso.
     */
    public function login(Request $request)
    {
        try {
            $response = Http::asForm()->post("{$this->baseUrl}/token", [
                'username' => $request->input('username'),
                'password' => $request->input('password'),
            ]);

            if ($response->successful()) {
                $responseData = $response->json();
                if (!isset($responseData['access_token'])) {
                    return back()->withErrors(['iniciar_sesion' => 'Token de acceso no recibido de la API.'])->withInput();
                }
                $accessToken = $responseData['access_token'];
                session(['api_token' => $accessToken]);

                $userResponse = Http::withToken($accessToken)->get("{$this->baseUrl}/users/me/");
                if ($userResponse->successful()) {
                    session(['current_user_data' => $userResponse->json()]);
                    return redirect('/principal');
                } else {
                    session()->forget('api_token');
                    return back()->withErrors(['iniciar_sesion' => 'No fue posible obtener los datos del usuario']);
                }
            } else {
                return back()->withErrors(['iniciar_sesion' => 'Credenciales incorrectas.'])->withInput();
            }
        } catch (\Exception $e) {
            return response()->view('errors.generico');
        }
    }

    /**
     * Obtiene el usuario autenticado.
     */
    public function getCurrentUser(Request $request)
    {
        try {
            $token = $request->bearerToken();
            $response = Http::withToken($token)->get("{$this->baseUrl}/users/me/");
            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            return response()->view('errors.generico');
        }
    }

    /**
     * Obtiene los ítems del usuario autenticado.
     */
    public function getUserItems(Request $request)
    {
        try {
            $token = $request->bearerToken();
            $response = Http::withToken($token)->get("{$this->baseUrl}/users/me/items/");
            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            return response()->view('errors.generico');
        }
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logout(Request $request)
    {
        try {
            $request->session()->forget('api_token');
            $request->session()->forget('current_user_data');
            return redirect('/');
        } catch (\Exception $e) {
            return response()->view('errors.generico');
        }
    }
}
