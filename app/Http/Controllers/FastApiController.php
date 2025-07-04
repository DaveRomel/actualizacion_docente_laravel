<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse; // Importar JsonResponse para tipado
use Throwable; // Importar Throwable para capturar cualquier tipo de error o excepción.

class FastApiController extends Controller
{
    // private $baseUrl = 'http://192.168.254.12:4001';
    /* private $baseUrl = 'http://localhost:4000/api'; */
    private $baseUrl = 'http://192.168.0.15:4000'; // Asegúrate de que esta URL sea correcta

    /**
     * Crea un nuevo usuario.
     * Maneja la respuesta de la API externa y redirige o devuelve un JSON.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function createUser(Request $request)
    {
        try {
            // Prepara los datos para enviar a la API externa
            $data = [
                'name'         => $request->input('nombre'),
                'celular'      => $request->input('telefono'),
                'procedencia'  => $request->input('escuela'),
                'email'        => $request->input('correo'),
                'user_passw'   => $request->input('contrasena'),
            ];

            // Realiza la petición POST a la API externa
            $response = Http::post("{$this->baseUrl}/api/user", $data);

            // Verifica el código de estado de la respuesta de la API externa
            if ($response->status() === 400) {
                // Si el correo ya está registrado (código 400), devuelve una respuesta JSON
                return response()->json(['message' => 'El correo electrónico ya ha sido registrado.'], 400);
            } elseif ($response->successful()) {
                // Si la creación del usuario fue exitosa (código 2xx), redirige a la página de inicio de sesión.
                return redirect('/iniciar_sesion');
            } else {
                // Si hay otro tipo de error de la API externa, devuelve una respuesta JSON
                return response()->json(['message' => 'Error al registrar el usuario. Por favor, intente de nuevo.'], $response->status());
            }
        } catch (Throwable $e) {
            // Si ocurre cualquier excepción (ej. la API no está disponible), muestra una página de error genérica.
            // También es buena idea registrar el error para futura depuración: \Log::error($e->getMessage());
            return response()->view('errors.generico');
        }
    }

    /**
     * Actualiza un usuario existente.
     *
     * @param Request $request
     * @param int $user_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function updateUser(Request $request, $user_id)
    {
        try {
            $token = session('api_token');
            $response = Http::withToken($token)->put("{$this->baseUrl}/api/user/{$user_id}", $request->all());

            // Verifica el código de estado de la respuesta de la API externa
            if ($response->status() === 400) {
                $responseData = $response->json();
                $errorMessage = $responseData['message'] ?? $responseData['detail'] ?? '';
                $errorMessageLower = strtolower($errorMessage);

                // Asumimos que un 400 con ciertos mensajes indica correo duplicado
                if (
                    (str_contains($errorMessageLower, 'correo') && str_contains($errorMessageLower, 'registrado')) ||
                    (str_contains($errorMessageLower, 'email') && str_contains($errorMessageLower, 'exists')) ||
                    (str_contains($errorMessageLower, 'duplicate') && str_contains($errorMessageLower, 'entry')) ||
                    (str_contains($errorMessageLower, 'already exists')) ||
                    (str_contains($errorMessageLower, 'ya existe'))
                ) {
                    // Si el mensaje indica un correo duplicado, devolvemos un 400 al frontend
                    return response()->json(['message' => 'El correo electrónico ya ha sido registrado.'], 400);
                } else {
                    // Si es un 400 pero no es por correo duplicado, devolvemos el error tal cual
                    return response()->json(['message' => 'Error al actualizar el usuario: ' . ($errorMessage ?: 'Solicitud inválida.')], 400);
                }
            } elseif ($response->successful()) {
                $userResponse = Http::withToken($token)->get("{$this->baseUrl}/users/me/");
                if ($userResponse->successful()) {
                    session(['current_user_data' => $userResponse->json()]);
                    return redirect('/principal');
                } else {
                    // Si la actualización fue exitosa pero no se pudo obtener el usuario actualizado
                    return response()->json(['message' => 'Usuario actualizado, pero no se pudieron obtener los nuevos datos.'], $userResponse->status());
                }
            } else {
                // Otros errores de la API externa
                $errorMessage = $response->json()['message'] ?? $response->json()['detail'] ?? 'Error desconocido al actualizar el usuario.';
                return response()->json(['message' => $errorMessage], $response->status());
            }
        } catch (Throwable $e) {
            // Error de conexión o del servidor Laravel
            return response()->json(['message' => 'Error de conexión o del servidor. Por favor, intente de nuevo más tarde.'], 500);
        }
    }

    /**
     * Cambia el estado de un usuario.
     *
     * @param Request $request
     * @param string $status
     * @param int $user_id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function changeUserStatus(Request $request, $status, $user_id)
    {
        try {
            $token = $request->bearerToken();
            $response = Http::withToken($token)->put("{$this->baseUrl}/api/user_status_{$status}/{$user_id}");
            return response()->json($response->json(), $response->status());
        } catch (Throwable $e) {
            return response()->view('errors.generico');
        }
    }

    /**
     * Recupera la contraseña de un usuario.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function recuperarPassword(Request $request)
    {
        try {
            $correo = $request->input('email');
            $response = Http::post("{$this->baseUrl}/api/recuperar?email={$correo}");
            session(['correo' => $correo]);
            return redirect('/recuperar_contraseña');
        } catch (Throwable $e) {
            return response()->view('errors.generico');
        }
    }

    /**
     * Cambia la contraseña de un usuario.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function cambiarContrasena(Request $request)
    {
        try {
            session()->forget('correo');
            $response = Http::put("{$this->baseUrl}/api/cambiar_contrasena", $request->all());

            // Si la API externa devuelve un error (ej. 500 por código incorrecto),
            // Laravel debe devolver un JSON con el mismo status para que el frontend lo maneje.
            if (!$response->successful()) {
                $errorMessage = $response->json()['message'] ?? $response->json()['detail'] ?? 'El código de verificación no es correcto.';
                return response()->json(['message' => $errorMessage], $response->status());
            }

            // Si la operación fue exitosa, devolvemos un JSON de éxito
            // para que el frontend pueda mostrar el modal de éxito y luego redirigir.
            return response()->json(['message' => 'Contraseña actualizada correctamente.'], 200);

        } catch (Throwable $e) {
            // Si hay un error de conexión o un error inesperado en Laravel,
            // devolvemos un 500 genérico para el frontend.
            return response()->json(['message' => 'Error de conexión o del servidor. Por favor, intente de nuevo más tarde.'], 500);
        }
    }

    /**
     * Inscribe un usuario a una materia.
     *
     * @param Request $request
     * @param int $usuario_id
     * @param int $materia_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function inscribirUsuario(Request $request, $usuario_id, $materia_id)
    {
        try {
            $token = session('api_token');
            $response = Http::withToken($token)->post("{$this->baseUrl}/api/inscripcion/{$usuario_id}/{$materia_id}");
            if ($response->successful()){
                $userResponse = Http::withToken($token)->get("{$this->baseUrl}/users/me/");
                if ($userResponse->successful()) {
                    session(['current_user_data' => $userResponse->json()]);
                    switch ($materia_id) {
                        case 1:
                            return redirect('/computacion/confirmacion');
                        case 2:
                            return redirect('/fisica/confirmacion');
                        default:
                            return redirect('/matematicas/confirmacion');
                    }
                }
            }
            return response()->json($response->json(), $response->status());
        } catch (Throwable $e) {
            return response()->view('errors.generico');
        }
    }

    /**
     * Ver inscripciones por materia.
     *
     * @param int $materia_id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function verInscripcionesPorMateria($materia_id)
    {
        try {
            $response = Http::get("{$this->baseUrl}/api/inscripcion/{$materia_id}");
            return response()->json($response->json(), $response->status());
        } catch (Throwable $e) {
            return response()->view('errors.generico');
        }
    }

     /**
     * Contar inscritos por materia.
     * Modificado para estandarizar la salida JSON para llamadas AJAX.
     *
     * @param int $materia_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function contarInscritos($materia_id)
    {
        try {
            // Es buena práctica usar el token si el endpoint lo requiere.
            $token = session('api_token');
            
            // Si el endpoint no requiere token, puedes usar:
            // $response = Http::get("{$this->baseUrl}/api/inscripcion/contar_inscritos_por_materia/{$materia_id}");
            
            $response = Http::withToken($token)->get("{$this->baseUrl}/api/inscripcion/contar_inscritos_por_materia/{$materia_id}");

            if ($response->successful()) {
                $data = $response->json();
                
                // Aseguramos que la salida sea siempre {"count": X}
                // Esto funciona si la API devuelve solo un número o un objeto como {'count': 15}.
                $count = is_numeric($data) ? $data : ($data['count'] ?? 'N/A');
                
                return response()->json(['count' => $count]);
            } else {
                // Si la API falla, devolvemos un JSON de error claro.
                return response()->json(['error' => 'No se pudo obtener el conteo.'], $response->status());
            }

        } catch (Throwable $e) {
            // Si hay un error de conexión, devolvemos un JSON de error.
            return response()->json(['error' => 'Error de conexión con el servidor.'], 500);
        }
    }

    /**
     * Eliminar una inscripción.
     *
     * @param Request $request
     * @param int $usuario_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function eliminarInscripcion(Request $request, $usuario_id)
    {
        try {
            $token = session('api_token');
            $response = Http::withToken($token)->put("{$this->baseUrl}/api/inscripcion/{$usuario_id}");
            if ($response->successful()){
                $userResponse = Http::withToken($token)->get("{$this->baseUrl}/users/me/");
                if ($userResponse->successful()) {
                    session(['current_user_data' => $userResponse->json()]);
                    return redirect('/principal');
                }
            }
            return response()->json($response->json(), $response->status());
        } catch (Throwable $e) {
            return response()->view('errors.generico');
        }
    }

    /**
     * Realiza el login y obtiene el token de acceso.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse|\Illuminate\View\View
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
                    return response()->json(['message' => 'Token de acceso no recibido de la API.'], 500);
                }
                $accessToken = $responseData['access_token'];
                session(['api_token' => $accessToken]);

                $userResponse = Http::withToken($accessToken)->get("{$this->baseUrl}/users/me/");

                if ($userResponse->successful()) {
                    session(['current_user_data' => $userResponse->json()]);
                    return redirect('/principal');
                } else {
                    session()->forget('api_token');
                    return response()->json(['message' => 'No fue posible obtener los datos del usuario.'], $userResponse->status());
                }
            } else {
                return response()->json(['message' => 'Credenciales incorrectas.'], 401);
            }
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error de conexión o del servidor. Por favor, intente de nuevo más tarde.'], 500);
        }
    }

    /**
     * Obtiene el usuario autenticado.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function getCurrentUser(Request $request)
    {
        try {
            $token = $request->bearerToken();
            $response = Http::withToken($token)->get("{$this->baseUrl}/api/users/me/");
            return response()->json($response->json(), $response->status());
        } catch (Throwable $e) {
            return response()->view('errors.generico');
        }
    }

    /**
     * Obtiene los ítems del usuario autenticado.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function getUserItems(Request $request)
    {
        try {
            $token = $request->bearerToken();
            $response = Http::withToken($token)->get("{$this->baseUrl}/api/users/me/items/");
            return response()->json($response->json(), $response->status());
        } catch (Throwable $e) {
            return response()->view('errors.generico');
        }
    }

    /**
     * Cierra la sesión del usuario.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function logout(Request $request)
    {
        try {
            $request->session()->forget('api_token');
            $request->session()->forget('current_user_data');
            // $request->session()->invalidate(); // Descomentar si deseas invalidar la sesión completamente
            // $request->session()->regenerateToken(); // Descomentar si deseas regenerar el token de sesión
            return redirect('/');
        } catch (Throwable $e) {
            return response()->view('errors.generico');
        }
    }
}
