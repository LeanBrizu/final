<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::POST('/contacto',[formularioController::class,'store']);
Route::get('/contacto', [formularioController::class, 'index']);
Route::controller(NoticiasController::class) ->group(function(){
    Route::get('/noticia','index');
    Route::post('/noticia','store');
    Route::get('/noticia','update');
    Route::delete('/noticia','destroy');
    Route::get('/noticia/{noticia}','show')->name('noticias.show');
    //Route::patch('/noticia','patch');
    });
