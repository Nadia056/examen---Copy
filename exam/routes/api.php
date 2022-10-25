<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\consultasController;
use App\Http\Controllers\CreateController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\indexController;
use App\Http\Controllers\NacionalidadController;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\ProtagonistaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\undiad1Controller;
use App\Http\Controllers\updateController;
use App\Models\protagonista;

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

Route::prefix('')-> group(function()
{
   Route::get("/message/pagina1",[undiad1Controller::class,"pagina1"]);
   Route::get("/message/pagina2",[undiad1Controller::class,"leerespecifico"]);
   Route::get("/message/pagina3",[undiad1Controller::class,"pagina3"]);
   Route::get("/message/pagina4",[undiad1Controller::class,"pagina4"]);
   Route::get("/message/pagina5",[undiad1Controller::class,"pagina5"]);
   Route::get("/math/{num}",[undiad1Controller::class,"matematicas"]);



});

Route::post("/cliente",[CreateController::class,"cliente"]);
Route::post("/empleado",[CreateController::class,"empleado"]);
Route::post("/producto",[CreateController::class,"producto"]);
Route::post("/pedido",[CreateController::class,"pedido"]);
Route::post("/detalle",[CreateController::class,"detalle"]);

Route::get("/clientes",[indexController::class,"clientes"]);
Route::get("/empleados",[indexController::class,"empleados"]);
Route::get("/productos",[indexController::class,"productos"]);
Route::get("/pedidos",[indexController::class,"pedidos"]);
Route::get("/detalles",[indexController::class,"detalles"]);

Route::put("/updateCliente/{id}",[updateController::class,"updateCliente"]);
Route::put("/updateEmpleado/{id}",[updateController::class,"updateEmpleado"]);
Route::put("/updateProducto/{id}",[updateController::class,"updateProducto"]);
Route::put("/updatePedido/{id}",[updateController::class,"updatePedido"]);
Route::put("/updateDetalle/{id}",[updateController::class,"updateDetalle"]);

Route::get("/consulta1",[consultasController::class,"consulta1"]);
Route::get("/consulta2",[consultasController::class,"consulta2"]);



//insertar genero
Route::prefix('')->group(function(){
    Route::post("/createg",[GeneroController::class,"createg"]);
});
//insertar actor
Route::prefix('')->group(function(){
    Route::post("/createa",[ActorController::class,"createa"]);
});
//insertar nacionalidad
Route::prefix('')->group(function(){
    Route::post("/createna",[NacionalidadController::class,"createna"]);
});
//insertar pelicula
Route::prefix('')->group(function(){
    Route::post("/createp",[PeliculaController::class,"createp"]);
});
//insertar protagonista
Route::prefix('')->group(function(){
    Route::post("/createpr",[protagonista::class,"createpr"]);
});


//buscar genero
Route::prefix('')->group(function(){
    Route::get("/buscarg",[GeneroController::class,"buscarg"]);
});
//buscar actor
Route::prefix('')->group(function(){
    Route::get("/buscara",[ActorController::class,"buscara"]);
});
//buscar nacionalidad
Route::prefix('')->group(function(){
    Route::get("/buscarna",[NacionalidadController::class,"buscarna"]);
});
//buscar pelicula
Route::prefix('')->group(function(){
    Route::get("/buscarp",[PeliculaController::class,"buscarp"]);
});
//buscar protagonista
Route::prefix('')->group(function(){
    Route::get("/buscarpr",[ProtagonistaController::class,"buscarpr"]);
});


//actulaizar genero
Route::prefix('')->group(function(){
    Route::put("/updateg/{id}",[GeneroController::class,"updateg"]);
});
//actulaizar actor
Route::prefix('')->group(function(){
    Route::put("/updatea/{id}",[ActorController::class,"updatea"]);
});
//actulaizar nacionalidad
Route::prefix('')->group(function(){
    Route::put("/updatena/{id}",[NacionalidadController::class,"updatena"]);
});
//actulaizar pelicula
Route::prefix('')->group(function(){
    Route::put("/updatep/{id}",[PeliculaController::class,"updatep"]);
});
//actulaizar protagonista
Route::prefix('')->group(function(){
    Route::put("/updatepr/{id}",[ProtagonistaController::class,"updatepr"]);
});