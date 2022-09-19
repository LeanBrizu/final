<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNoticia;
use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function verNoticias()
    {
        $noticias = Noticia::where('estado', 1)->get();
        if (is_null($noticias)){
            return response()->json([
                "estado"  => false,
                "mensaje" => "No hay noticias activas para mostrar."
            ], 404);
        }
        return response()->json([
            "estado" => true,
            "noticias"  => $noticias], 200);
    }

    //Desde aquí, los métodos del panel de admin.
    protected function mostrarNoticias()
    {
        $noticias = Noticia::all();
        if (is_null($noticias)){
            return response()->json([
                "estado"  => false,
                "mensaje" => "No hay noticias para mostrar."
            ], 404);
        }
        return response()->json([
            "estado" => true,
            "noticias"  => $noticias], 200);
    }

    protected function mostrar($id)
    {
        $noticia = Noticia::find($id);
        if (is_null($noticia)){
          return response()->json([
                "estado" => false,
                "mensaje"=>"Noticia no encontrada."
          ], 404);
        }
        return response()->json([
            "estado"  => true,
            "noticia" => $noticia,
        ], 200);
    }

    protected function guardarNoticia(CreateNoticia $request){

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
                "mensaje"=>"La noticia ha sido creada",
                "noticia"=>$noticia,], 201);
        }else {
            return response()-> json([
            "estado" => false,
            "mensaje"=> "Error. Noticia no creada.",
            "noticia"=> $noticia,], 400);
        }

    }
    protected function actualizar(CreateNoticia $request, $id)
    {
        $noticia = Noticia::find($id);
        $noticia->titulo =  $request->get('titulo');
        $noticia->copete = $request->get('copete');
        $noticia->descripcion = $request->get('descripcion');
        $noticia->estado = $request->get('estado');
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
                "mensaje"=>"Noticia editada exitósamente.",
                "noticia"=>$noticia,], 201);
        }else {
            return response()-> json([
            "estado" => false,
            "mensaje"=> "Error. La noticia no pudo ser editada.",
            "noticia"=> $noticia,], 400);
        }
    }

    protected function cambiarImagen(Request $request, $id)
    {

        $noticia = Noticia::find($id);
        if ($request->file('imagen')){
            $file = $request->file('imagen');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file -> move(public_path('/img'), $filename);
            $url = env("APP_URL").'/img/'.$filename;
            $noticia->imagen= $url;
        }
        if ($noticia->save()) {
            return response()-> json([
                "estado"  => true,
                "mensaje" =>"Imagen subida exitósamente.",
                "noticia" =>$noticia,], 201);
        }else {
            return response()-> json([
            "estado"  => false,
            "mensaje" => "Error. La imagen no pudo guardarse.",
            "noticia" => $noticia,], 400);
        }
    }

    protected function enviaraPapelera($id)
    {
        $noticia = Noticia::find($id);
        $noticia->delete(); 
 
        return response()-> json([
            "estado" => true,
            "mensaje"=> "Noticia enviada a la papelera.",
            "noticia"=> $noticia,], 200);
    } 

    protected function verPapelera()
    {   
        $noticias = Noticia::onlyTrashed()->get();
        if (count($noticias)==0) {
            return response()-> json([
                "estado" => false,
                "mensaje"=>"No hay noticias en la papelera.",
                ], 404);
        } else {
            return response()-> json([
                "estado"   => true,
                "Noticias" =>$noticias
                ], 200);
        }   

    }

    protected function borrar($id)          //Borrado definitivo.
    {
        $noticia = Noticia::withTrashed()->where('id', $id)->forceDelete(); ;
        

        return response()-> json([
          "estado" => true,
          "mensaje"=>"La noticia ha sido eliminada.",
          ], 202);
    }
}
