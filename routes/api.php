<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\ContactoController;




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(ContactoController::class) ->group(function(){
    Route::post('/contacto','guardarContacto');
    Route::get('/contacto','mostrarContacto');
});
Route::controller(NoticiaController::class) ->group(function(){
    Route::get('/noticia','mostrarNoticias');
    Route::get('/noticia/{id}','mostrar');
    Route::post('/noticia','guardarNoticia');
    Route::put('/noticia/{id}','actualizar');
    Route::post('/noticia/cambiarimagen/{id}', 'cambiarImagen');
    Route::delete('/noticia/{id}','enviaraPapelera');
    Route::get('/noticia/mostrar/papelera','verPapelera');
    Route::delete('/noticia/eliminar/{id}','borrar');
    });
