<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
 
    public function ingreso(Request $request)
    {
        if(Auth::attempt(['name' => $request->name, 'password' => $request->password])){ 
            $user = Auth::User(); 
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            $success['name'] =  $user->name;
            return response()-> json([
                "estado"  => true,
                "mensaje" => "Bienvenido admin.",
                "success" => $success
            ]);
        }else{
            return response()-> json([
                "estado"  => false,
                "mensaje" =>"No autorizado.",
            ]);
        } 
    }
}
