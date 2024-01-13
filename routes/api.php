<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\LoginController;



Route::post('/admin', [LoginController::class, 'ingreso'])->name('login');     //Login del admin

Route::middleware('auth:sanctum')->group( function ()  {                       //Panel del admin
    Route::controller(ContactoController::class) ->group(function(){
        Route::get('/admin/verContactos','mostrarContactos');
    });
    Route::controller(NoticiaController::class) ->group(function(){
        Route::get('/admin/noticia','mostrarNoticias');
        Route::get('/admin/noticia/{id}','mostrar');
        Route::post('/admin/noticia','guardarNoticia');
        Route::put('/admin/noticia/{id}','actualizar');
        Route::post('/admin/noticia/cambiarimagen/{id}', 'cambiarImagen');
        Route::delete('/admin/noticia/{id}','enviaraPapelera');
        Route::get('/admin/noticia/mostrar/papelera','verPapelera');
        Route::delete('/admin/noticia/eliminar/{id}','borrar');
    });
});

//Rutas no protegidas.
//Rutas del modelo Contacto.
Route::post('/inicio',[ContactoController::class, 'guardarContacto']);

//Rutas del modelo Noticia.
Route::get('/inicio',[NoticiaController::class, 'verNoticias']); //Noticias "activas" (Pueden ser vistas públicamente).

