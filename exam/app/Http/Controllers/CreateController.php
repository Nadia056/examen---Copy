<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\cliente;
use App\Models\empleado;
use App\Models\producto;
use App\Models\pedido;
use App\Models\detalle;

class CreateController extends Controller
{

	public function empleado(Request $request)
	{
		$validacion = Validator::make(
			$request->all(),
			[
				"nombre" => "required | max:25",
				"ap_paterno" => "required | max:20",
				"ap_materno" => "required | max:20",
				"edad" => "required",
				"email" => "required | max:50",
				"telefono" => "required",


			],
			[
				"nombre.required" => "El campo :attribute es obligatorio",
				"nombre.max" => "El campo :attribute no debe tener un maximo de :max caracteres",
				"ap_paterno.required" => "El campo :attribute es obligatorio",
				"ap_paterno.max" => "El campo :attribute no debe tener un maximo de :max caracteres",
				"ap_materno.required" => "El campo :attribute es obligatorio",
				"ap_materno.max" => "El campo :attribute no debe tener un maximo de :max caracteres",
				"edad" => "El campo :atribute es obligatorio",
				"email.required" => "El campo :attribute es obligatorio",
				"email.max" => "El campo :attribute no puede tener un maximo de :max caracteres",
				"telefono.required" => "El campo :attribute es obligatorio",


			]
		);
		if ($validacion->fails()) {
			Log::channel('slackuser')->error(
				'Falta de Informacion',
				[$_REQUEST]
			);
			return response()->json([
				"status" => 400,
				"message" => "Error en las validaciones",
				"error" => $validacion->errors(),
				"data" => []
			], 400);
		}

		$empleado = Http::post('http://192.168.124.126:2365/api/empleado');
		$empleado->nombre 		= $request->nombre;
		$empleado->ap_paterno 	= $request->ap_paterno;
		$empleado->ap_materno 	= $request->ap_materno;
		$empleado->email 	    = $request->email;
		$empleado->edad 	    = $request->edad;
		$empleado->telefono 	= $request->telefono;

		if ($empleado->save())
			Log::channel('slackinfo')->info(
				'Nuevo Empleado Registrado',
				[$_REQUEST]
			);
		return response()->json([
			"status" => 201,
			"message" => "Datos insertados de manera satisfactoria",
			"error" => [],
			"data" => $empleado
		], 201);
	}
	public function cliente(Request $request)
	{
		$validacion = Validator::make(
			$request->all(),
			[
				"nombre" => "required | max:25",
				"ap_paterno" => "required | max:20",
				"ap_materno" => "required | max:20",
				"edad" => "required",
				"email" => "required | max:50",
				"telefono" => "required",
				"direccion" => "required | max:50",
				"empleado_id" => "required"

			],
			[
				"nombre.required" => "El campo :attribute es obligatorio",
				"nombre.max" => "El campo :attribute no debe tener un maximo de :max caracteres",
				"ap_paterno.required" => "El campo :attribute es obligatorio",
				"ap_paterno.max" => "El campo :attribute no debe tener un maximo de :max caracteres",
				"ap_materno.required" => "El campo :attribute es obligatorio",
				"ap_materno.max" => "El campo :attribute no debe tener un maximo de :max caracteres",
				"edad.required" => "El campo :atribute es obligatorio",
				"email.required" => "El campo :attribute es obligatorio",
				"email.max" => "El campo :attribute no puede tener un maximo de :max caracteres",
				"telefono.required" => "El campo :attribute es obligatorio",
				"empleado_id.required" => "El campo :attribute es obligatorio"

			]
		);
		if ($validacion->fails()) {
			Log::channel('slackuser')->error(
				'Falta de Informacion',
				[$_REQUEST]
			);
			return response()->json([
				"status" => 400,
				"message" => "Error en las validaciones",
				"error" => $validacion->errors(),
				"data" => []
			], 400);
		}

		$cliente = Http::post('http://192.168.124.126:5678/api/cliente');
		$cliente->nombre 		= $request->nombre;
		$cliente->ap_paterno 	= $request->ap_paterno;
		$cliente->ap_materno 	= $request->ap_materno;
		$cliente->edad 			= $request->edad;
		$cliente->email 	    = $request->email;
		$cliente->telefono 	    = $request->telefono;
		$cliente->direccion 	= $request->direccion;
		$cliente->empleado_id 	= $request->empleado_id;

		if ($cliente->save())
			Log::channel('slackinfo')->info(
				'Nuevo Cliente Registrado',
				[$_REQUEST]
			);
		return response()->json([
			"status" => 201,
			"message" => "Datos insertados de manera satisfactoria",
			"error" => [],
			"data" => $cliente
		], 201);
	}
	public function producto(Request $request)
	{
		$validacion = Validator::make(
			$request->all(),
			[

				"nombre" => "required | max:25",
				"cantidad" => "required",
				"precio_provedor" => "required ",
				"precio_venta" => "required",

			],
			[
				"nombre.required" => "El campo :attribute es obligatorio",
				"nombre.max" => "El campo :attribute no debe tener un maximo de :max caracteres",
				"cantidad.required" => "El campo :attribute es obligatorio",
				"precio_provedor.required" => "El campo :attribute es obligatorio",
				"precio_venta.required" => "El campo :attribute es obligatorio",

			]
		);
		if ($validacion->fails()) {
			Log::channel('slackuser')->error(
				'Falta de Informacion',
				[$_REQUEST]
			);
			return response()->json([
				"status" => 400,
				"message" => "Error en las validaciones",
				"error" => $validacion->errors(),
				"data" => []
			], 400);
		}

		$producto = Http::post('http://192.168.124.126:5678/api/producto');
		$producto->nombre 		    = $request->nombre;
		$producto->cantidad 	    = $request->cantidad;
		$producto->precio_provedor 	= $request->precio_provedor;
		$producto->precio_venta 	= $request->precio_venta;


		if ($producto->save())
			Log::channel('slackinfo')->info(
				'Nuevo Producto Registrado',
				[$_REQUEST]
			);
		return response()->json([
			"status" => 201,
			"message" => "Datos insertados de manera satisfactoria",
			"error" => [],
			"data" => $producto
		], 201);
	}
	public function pedido(Request $request)
	{
		$validacion = Validator::make(
			$request->all(),
			[

				"fecha_pedido" => "required",
				"fecha_esperada" => "required",
				"fecha_entrega" => "required ",
				"estado" => "required",
				"codigo_cliente" => "required"

			],
			[
				"fecha_pedido.required" => "El campo :attribute es obligatorio",
				"fecha_esperada.required" => "El campo :attribute es obligatorio",
				"fecha_entrega.required" => "El campo :attribute es obligatorio",
				"estado.required" => "El campo :attribute es obligatorio",
				"codigo_cliente.required" => "El campo :attribute es obligatorio",

			]
		);
		if ($validacion->fails()) {
			Log::channel('slackuser')->error(
				'Falta de Informacion',
				[$_REQUEST]
			);
			return response()->json([
				"status" => 400,
				"message" => "Error en las validaciones",
				"error" => $validacion->errors(),
				"data" => []
			], 400);
		}

		$pedido = Http::post('http://192.168.124.126:5678/api/pedido');
		$pedido->fecha_pedido 		= $request->fecha_pedido;
		$pedido->fecha_esperada 	= $request->fecha_esperada;
		$pedido->fecha_entrega 	    = $request->fecha_entrega;
		$pedido->estado 			= $request->estado;
		$pedido->codigo_cliente 	= $request->codigo_cliente;


		if ($pedido->save())
			Log::channel('slackinfo')->info(
				'Nuevo Pedido Registrado',
				[$_REQUEST]
			);
		return response()->json([
			"status" => 201,
			"message" => "Datos insertados de manera satisfactoria",
			"error" => [],
			"data" => $pedido
		], 201);
	}
	public function detalle(Request $request)
	{
		$validacion = Validator::make(
			$request->all(),
			[

				"cantidad" => "required",
				"precio" => "required",
				"codigo_producto" => "required ",
				"codigo_pedido" => "required",

			],
			[
				"cantidad.required" => "El campo :attribute es obligatorio",
				"precio.required" => "El campo :attribute es obligatorio",
				"codigo_producto.required" => "El campo :attribute es obligatorio",
				"codigo_pedido.required" => "El campo :attribute es obligatorio",

			]
		);
		if ($validacion->fails()) {
			Log::channel('slackuser')->error(
				'Falta de Informacion',
				[$_REQUEST]
			);
			return response()->json([
				"status" => 400,
				"message" => "Error en las validaciones",
				"error" => $validacion->errors(),
				"data" => []
			], 400);
		}

		$detalle = Http::post('http://192.168.124.126:5678/api/detalle');
		$detalle->cantidad 		       = $request->cantidad;
		$detalle->precio 	           = $request->precio;
		$detalle->codigo_producto 	   = $request->codigo_producto;
		$detalle->codigo_pedido 	   = $request->codigo_pedido;


		if ($detalle->save())
			Log::channel('slackinfo')->info(
				'Detalle Registrado',
				[$_REQUEST]
			);
		return response()->json([
			"status" => 201,
			"message" => "Datos insertados de manera satisfactoria",
			"error" => [],
			"data" => $detalle
		], 201);
	}
}
