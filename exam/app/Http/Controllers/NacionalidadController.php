<?php

namespace App\Http\Controllers;

use App\Models\nacionalidad;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class NacionalidadController extends Controller
{
    public function createna(Request $request)
	{
		$validacion = Validator:: make(
			$request->all(),
			[
				"nacionalidad"=>"required | max:50",
				
			],
			[
				"nacionalidad.required"=>"El campo :attribute es obligatorio",
				
			]);
				if($validacion->fails())
				{
					return response()->json([
						"status"=>400,
						"message"=>"Error en las validaciones",
						"error"=>$validacion->errors(),
						"data"=>[]
					],400);
				}

				$nacionalidad = new nacionalidad();
				$nacionalidad->nacionalidad 		=$request->nacionalidad;
				
				if($nacionalidad->save())
				
					return response()->json([
						"status"=>201,
						"message"=>"Datos insertados de manera satisfactoria",
						"error"=>[],
						"data"=>$nacionalidad
					],201);

	}

	public function buscarna()
	{
		return response()->json([
			"status"=>200,
			"message"=>"Datos encontrados satisfactoriamente",
			"error"=>[],
			"data"=>nacionalidad::all()
		],200);
	}

	public function updatena(Request $request, int $id)
	{
		$validacion = Validator:: make(
			$request->all(),
			[
				"nacionalidad"=>"required | max:50",
			],
			[
				"nacionalidad.required"=>"El campo :attribute es obligatorio",
				"nacionalidad.max"=>"El campo :attribute no debe tener un maximo de :max caracteres",
			]);
				if($validacion->fails())
				{
					return response()->json([
						"status"=>400,
						"message"=>"Error en las validaciones",
						"error"=>$validacion->errors(),
						"data"=>[]
					],400);
				}
				
				$nacionalidad=nacionalidad::find($id);
				if($nacionalidad)
				{	
				$nacionalidad->nacionalidad 		=$request->nacionalidad;

				$nacionalidad->update();
				return response()->json([
						"status"=>200,
						"message"=>"Datos actualizados de manera satisfactoria",
						"error"=>[],
						"data"=>$nacionalidad
					],200);
				}
				else 
				{
					return response()->json([
						"status"=>400,
						"message"=>"No se encontro",
						"error"=>[],
						"data"=>$nacionalidad
					],400);
				}
			}
}

