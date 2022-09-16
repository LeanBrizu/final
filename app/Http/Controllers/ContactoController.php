<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateContacto;
use App\Models\Contacto;

class ContactoController extends Controller
{
    public function mostrarContactos(){
        $contacto = Contacto::all();
        return response()->json($contacto);
    }

    public function guardarContacto(CreateContacto $request){
     $contacto = Contacto::create($request->all());
     return response()-> json([
        "estado" => true,
        "mensaje"=>"Su formulario ha sido enviado, gracias por comunicarte",
        "contacto"=>$contacto]);
    }
}
