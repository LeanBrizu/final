<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateContacto;
use App\Models\create_contacto;

class CreateContactoController extends Controller
{
    public function index(){
        $contacto = create_contacto::all();
        return response()->json($contacto);
    }

    public function store(CreateContacto $request){
     $contacto = create_contacto::create($request->all());
     return response()-> json([
        "estado" => true,
        "mensaje"=>"Su formulario ha sido enviado, gracias por comunicarte",
        "contacto"=>$contacto]);
    }
}
