<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\cliente;
use App\Models\empleado;
use App\Models\producto;
use App\Models\pedido;
use App\Models\detalle;
use GuzzleHttp\Exception\ClientException;

class consultasController extends Controller
{
    public function consulta1(Request $request)
    {
        $cliente= cliente::where("edad",">=",$request->edad)->get();
        return response()->json([
            "status"=>200,
            "cliente"=>$cliente
        ]);
    }
    public function consulta2(Request $request)
    {
            $pedio =DB::table('clientes as c')
            ->join('pedidos as p', 'p.codigo_cliente', '=', 'c.id')
            ->join('detalles as d', 'p.id', '=', 'd.codigo_pedido')
            ->join('productos as  pro', 'pro.id', '=', 'd.codigo_producto')
            
            ->select('c.nombre', 'c.ap_paterno','c.ap_materno',
            'pro.nombre as producto','d.cantidad','pro.precio_venta as precio','d.precio as total')
            ->get();
            return response()->json([
                "status"=>200,
                "info"=>$pedio
            ]);

    }
}
