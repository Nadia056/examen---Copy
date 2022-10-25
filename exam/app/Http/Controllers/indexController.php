<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\cliente;
use App\Models\empleado;
use App\Models\producto;
use App\Models\pedido;
use App\Models\detalle;

class indexController extends Controller
{
    public function clientes()
	{
		return Http::clientes()->get('http://192.168.124.126:2365/api/cli');
		return response()->json([
			"status"=>200,
			"message"=>"Datos encontrados satisfactoriamente",
			"error"=>[],
			"data"=>cliente::all()
		],200);
	}
    public function empleados()
	{
		return response()->json([
			"status"=>200,
			"message"=>"Datos encontrados satisfactoriamente",
			"error"=>[],
			"data"=>empleado::all()
		],200);
	}
    public function productos()
	{
		return response()->json([
			"status"=>200,
			"message"=>"Datos encontrados satisfactoriamente",
			"error"=>[],
			"data"=>producto::all()
		],200);
	}
    public function pedidos()
	{
		return response()->json([
			"status"=>200,
			"message"=>"Datos encontrados satisfactoriamente",
			"error"=>[],
			"data"=>pedido::all()
		],200);
	}
    public function detalles()
	{
		return response()->json([
			"status"=>200,
			"message"=>"Datos encontrados satisfactoriamente",
			"error"=>[],
			"data"=>detalle::all()
		],200);
	}
}
