<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNoticia;
use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function mostrarNoticias()
    {
        $noticia = Noticia::all();
        return response()->json($noticia);
    }

    public function mostrar($id)
    {
        $noticia = Noticia::find($id);
        if (is_null($noticia)){
          return response()->json([
                "estado" => false,
                "mensaje"=>"Advertencia: Esta noticia ha sido descartada, o no existe."
          ]);
        }
        return response()->json($noticia);
    }

    public function guardarNoticia(CreateNoticia $request){

        $validated = $request->validated();
        $noticia = new Noticia();
        $noticia->titulo = $request->titulo;
        $noticia->copete = $request->copete;
        $noticia->descripcion = $request->descripcion;
        $noticia->estado = $request->estado;
        
        if ($request->file('imagen')){
            $file = $request->file('imagen');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file -> move(public_path('/img'), $filename);
            $url = env("APP_URL").'/img/'.$filename;
            $noticia->imagen= $url;
        }
        if ($noticia->save()) {
            return response()-> json([
                "estado" => true,
                "mensaje"=>"Su noticia ha sido creada",
                "noticia"=>$noticia,]);
        }else {
            return response()-> json([
            "estado" => false,
            "mensaje"=> "Su noticia no fue creada",
            "noticia"=> $noticia,]);
        }

    }
    public function actualizar(CreateNoticia $request, $id)
    {
        $noticia = Noticia::find($id);
        $noticia->titulo =  $request->get('titulo');
        $noticia->copete = $request->get('copete');
        $noticia->descripcion = $request->get('descripcion');
        $noticia->estado = $request->get('estado');
        //Subida de la imagen. No puedo hacerlo funcionar con el método PUT
        // if ($request->file('imagen')){
        //     $file = $request->file('imagen');
        //     $filename = date('YmdHi').$file->getClientOriginalName();
        //     $file -> move(public_path('/img'), $filename);
        //     $url = env("APP_URL").'/img/'.$filename;
        //     $noticia->imagen= $url;
        // }
 
        if ($noticia->save()) {
            return response()-> json([
                "estado" => true,
                "mensaje"=>"Noticia editada exitósamente.",
                "noticia"=>$noticia,]);
        }else {
            return response()-> json([
            "estado" => false,
            "mensaje"=> "Ha ocurrido un problema.",
            "noticia"=> $noticia,]);
        }
    }

    public function cambiarImagen(Request $request, $id)
    {

        $noticia = Noticia::find($id);
        if ($request->file('imagen')){
            $file = $request->file('imagen');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file -> move(public_path('/img'), $filename);
            $url = env("APP_URL").'/img/'.$filename;
            $noticia->imagen= $url;
        }
        $noticia->save();

        return response()->json(["estado" => true,
        "mensaje"=>"La imagen ha sido cambiada."]);
    }

    public function enviaraPapelera($id)
    {
        $noticia = Noticia::find($id);
        $noticia->delete(); 
 
        return response()-> json([
            "estado" => true,
            "mensaje"=> "Noticia enviada a la papelera.",
            "noticia"=> $noticia,]);
    } 

    public function verPapelera()
    {   
        $noticias = Noticia::onlyTrashed()->get();
        if (count($noticias)==0) {
            return response()-> json([
                "estado" => false,
                "mensaje"=>"No hay noticias en la papelera.",
                ]);
        } else {
            return response()-> json([
                "estado" => true,
                "Noticias"=>$noticias
                ]);
        }   

    }

    public function borrar($id)//Borrado definitivo.
    {
        $noticia = Noticia::withTrashed()->where('id', $id)->forceDelete(); ;
        

        return response()-> json([
          "estado" => true,
          "mensaje"=>"La noticia ha sido eliminada.",
          ]);
    }
}
