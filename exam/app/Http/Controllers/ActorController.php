<?php

namespace App\Http\Controllers;

use App\Models\actor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    public function createa(Request $request)
	{
		$validacion = Validator:: make(
			$request->all(),
			[
				"Nombre"=>"required | max:50",
                "Apellidos"=>"required | max:50",
                "nacionalidad_id"=>"required",
				
			],
			[
				"Nombre.required"=>"El campo :attribute es obligatorio",
				
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

				$actor = new actor();
				$actor->Nombre		=$request->Nombre;
                $actor->Apellidos 		=$request->Apellidos;
                $actor->nacionalidad_id		=$request->nacionalidad_id;
				
				if($actor->save())
				
					return response()->json([
						"status"=>201,
						"message"=>"Datos insertados de manera satisfactoria",
						"error"=>[],
						"data"=>$actor
					],201);

	}

	public function buscara()
	{
		return response()->json([
			"status"=>200,
			"message"=>"Datos encontrados satisfactoriamente",
			"error"=>[],
			"data"=>actor::all()
		],200);
	}

	public function updatea(Request $request, int $id)
	{
		$validacion = Validator:: make(
			$request->all(),
			[
				"Nombre"=>"required | max:50",
                "Apellidos"=>"required | max:50",
                "nacionalidad_id"=>"required",
			],
			[
				"Nombre.required"=>"El campo :attribute es obligatorio",
				"Nombre.max"=>"El campo :attribute no debe tener un maximo de :max caracteres",
				"Apellidos.required"=>"El campo :attribute es obligatorio",
				"Apellidos.max"=>"El campo :attribute no debe tener un maximo de :max caracteres",
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
				
				$actor=actor::find($id);
				if($actor)
				{
					$actor->Nombre		=$request->Nombre;
                    $actor->Apellidos 		=$request->Apellidos;
                    $actor->nacionalidad_id		=$request->nacionalidad_id;

					$actor->update();
				return response()->json([
						"status"=>200,
						"message"=>"Datos actualizados de manera satisfactoria",
						"error"=>[],
						"data"=>$actor
					],200);
				}
				else 
				{
					return response()->json([
						"status"=>400,
						"message"=>"No se encontro",
						"error"=>[],
						"data"=>$actor
					],400);
				}
			}
}
