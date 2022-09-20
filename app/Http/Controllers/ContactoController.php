<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateContacto;
use App\Models\Contacto;


class ContactoController extends Controller
{
    public function mostrarContactos(){
        $contactos = Contacto::all();

        if (is_null($contactos)){
            response()->json([
                "estado"    => false,
                "mensaje"   => "No hay contactos en los registros.",   
                "contactos" =>  $contactos], 204);
        }
        return response()->json([
         "estado"    => true,
         "mensaje"   => "Lista de todos los contactos.",   
         "contactos" =>  $contactos], 200);
    }

    public function guardarContacto(CreateContacto $request){
     $contacto = Contacto::create($request->all());
     if (is_null($contacto)){
        return response()-> json([
            "estado" => false,
            "mensaje"=>"Error. El contacto no se ha guardado.",
            "contacto"=>$contacto], 400);
     }
     return response()-> json([
        "estado" => true,
        "mensaje"=>"Contacto registrado exitósamente.",
        "contacto"=>$contacto], 201);
    }

    public function borrarContacto($id){   //Borrado definitivo.
      
        $contacto = Contacto::find($id);
        if (is_null($contacto)){
            $contacto->delete(); 
            response()-> json([
                "estado" => false,
                "mensaje"=>"Error. Recurso no encontrado.",
            ], 404);
        }
        return response()-> json([
          "estado" => true,
          "mensaje"=>"El contacto ha sido eliminado.",
          ], 202);
    }
}
