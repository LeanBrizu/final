<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Maneja el intento de ingreso de un usuario.
     *
     * Verifica las credenciales del usuario y, en caso de éxito, genera y retorna un token de autenticación.
     * Retorna un mensaje de error en caso de credenciales incorrectas.
     *
     * @param  \Illuminate\Http\Request  $request  Datos de la solicitud, incluyendo nombre y contraseña.
     * @return \Illuminate\Http\JsonResponse  Respuesta JSON con el estado del ingreso, mensaje y token en caso de éxito.
     */
    public function ingreso(Request $request)
    {
        if (Auth::attempt(['name' => $request->name, 'password' => $request->password])) {
            $user = Auth::User();
            $token = $user->createToken('MyApp')->plainTextToken;

            return response()->json([
                'estado' => true,
                'mensaje' => 'Bienvenido admin.',
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'estado'  => false,
                'mensaje' =>'No autorizado.',
            ], 401);
        }
    }
}
