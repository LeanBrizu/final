<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNoticia;
use App\Models\create_noticia;
use Illuminate\Http\Request;

class CreateNoticiaController extends Controller
{
    public function index()
    {
        $noticia = create_noticia::all()->latest('id');
        return response()->json($noticia);
    }
    public function store(CreateNoticia $request){

        $noticia = create_noticia::create($request->all());
        
}
public function update(CreateNoticia $request, $id)
    {
        $noticia = create_noticia::find($id);
        // Getting values from the blade template form
        $noticia->titulo =  $request->get('titulo');
        $noticia->copete = $request->get('copete');
        $noticia->descripcion = $request->get('descripcion');
        $noticia->imagen = $request->get('imagen');
        $noticia->save();
 
        return redirect('/noticias')->with('success', 'noticia updated.'); // -> resources/views/noticias/index.blade.php
    }
    public function destroy($id)
    {
        $noticia = create_noticia::find($id);
        $noticia->delete(); // Easy right?
 
        return redirect('/create_noticia')->with('success', 'Stock removed.');  // -> resources/views/stocks/index.blade.php
    } 
}
