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

class updateController extends Controller
{
    
    public function updateCliente(Request $request, int $id)
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
                'ERROR NO SE PUEDE ACTUALIZAR EL CLIENTE',
                [$_REQUEST]
            );
            return response()->json([
                "status" => 400,
                "message" => "Error en las validaciones",
                "error" => $validacion->errors(),
                "data" => []
            ], 400);
        }
		$cliente = Http::put('http://192.168.124.126:5678/api/updateCliente');
        $cliente = cliente::find($id);
        if ($cliente) {
            $cliente->nombre         = $request->nombre;
            $cliente->ap_paterno     = $request->ap_paterno;
            $cliente->ap_materno     = $request->ap_materno;
            $cliente->edad             = $request->edad;
            $cliente->email         = $request->email;
            $cliente->telefono         = $request->telefono;
            $cliente->direccion     = $request->direccion;
            $cliente->empleado_id     = $request->empleado_id;
            $cliente->update();
            Log::channel('slackuser')->error(
                'Cliente actualizado de manera satisfactoria',
                [$_REQUEST]
            );
            return response()->json([

                "status" => 200,
                "message" => "Datos actualizados de manera satisfactoria",
                "error" => [],
                "data" => $cliente
            ], 200);
        } else {
            return response()->json([
                "status" => 400,
                "message" => "No se encontro",
                "error" => [],
                "data" => $cliente
            ], 400);
        }
    }
    public function updateEmpleado(Request $request, int $id)
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
		$empleado = Http::put('http://192.168.124.126:5678/api/updateEmpleado');

        $empleado = empleado::find($id);
        if ($empleado) {
            $empleado->nombre         = $request->nombre;
            $empleado->ap_paterno     = $request->ap_paterno;
            $empleado->ap_materno     = $request->ap_materno;
            $empleado->email         = $request->email;
            $empleado->edad         = $request->edad;
            $empleado->telefono     = $request->telefono;
            $empleado->update();
            Log::channel('slackuser')->error(
                'Empleado actualizado de manera satisfactoria',
                [$_REQUEST]
            );
            return response()->json([

                "status" => 200,
                "message" => "Datos actualizados de manera satisfactoria",
                "error" => [],
                "data" => $empleado
            ], 200);
        } else {
            return response()->json([
                "status" => 400,
                "message" => "No se encontro",
                "error" => [],
                "data" => $empleado
            ], 400);
        }
    }
    public function updateProducto(Request $request, int $id)
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
		$producto = Http::put('http://192.168.124.126:5678/api/updateProducto');

        $producto = producto::find($id);
        if ($producto) {
            $producto->nombre             = $request->nombre;
            $producto->cantidad         = $request->cantidad;
            $producto->precio_provedor     = $request->precio_provedor;
            $producto->precio_venta     = $request->precio_venta;
            $producto->update();
            Log::channel('slackuser')->error(
                'Producto actualizado de manera satisfactoria',
                [$_REQUEST]
            );
            return response()->json([

                "status" => 200,
                "message" => "Datos actualizados de manera satisfactoria",
                "error" => [],
                "data" => $producto
            ], 200);
        } else {
            return response()->json([
                "status" => 400,
                "message" => "No se encontro",
                "error" => [],
                "data" => $producto
            ], 400);
        }
    }
    public function updatePedido(Request $request, int $id)
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
		$pedido = Http::put('http://192.168.124.126:5678/api/updatePedido');

        $pedido = pedido::find($id);
        if ($pedido) {
            $pedido->fecha_pedido         = $request->fecha_pedido;
            $pedido->fecha_esperada     = $request->fecha_esperada;
            $pedido->fecha_entrega         = $request->fecha_entrega;
            $pedido->estado             = $request->estado;
            $pedido->codigo_cliente     = $request->codigo_cliente;
            $pedido->update();
            Log::channel('slackuser')->error(
                'Pedido actualizado de manera satisfactoria',
                [$_REQUEST]
            );
            return response()->json([

                "status" => 200,
                "message" => "Datos actualizados de manera satisfactoria",
                "error" => [],
                "data" => $pedido
            ], 200);
        } else {
            return response()->json([
                "status" => 400,
                "message" => "No se encontro",
                "error" => [],
                "data" => $pedido
            ], 400);
        }
    }
    public function updateDetalle(Request $request, int $id)
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

		$detalle = Http::put('http://192.168.124.126:5678/api/updateDetalle');

        $detalle = detalle::find($id);
        if ($detalle) {
            $detalle->cantidad                = $request->cantidad;
            $detalle->precio                = $request->precio;
            $detalle->codigo_producto        = $request->codigo_producto;
            $detalle->codigo_pedido        = $request->codigo_pedido;

            $detalle->update();

            Log::channel('slackuser')->error(
                'Pedido actualizado de manera satisfactoria',
                [$_REQUEST]
            );
            return response()->json([

                "status" => 200,
                "message" => "Datos actualizados de manera satisfactoria",
                "error" => [],
                "data" => $detalle
            ], 200);
        } else {
            return response()->json([
                "status" => 400,
                "message" => "No se encontro",
                "error" => [],
                "data" => $detalle
            ], 400);
        }
    }
}
