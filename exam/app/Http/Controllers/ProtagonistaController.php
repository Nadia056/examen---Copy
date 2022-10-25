<?php

namespace App\Http\Controllers;
use App\Models\protagonista;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProtagonistaController extends Controller
{

    public function createpr(Request $request)
	{
		$validacion = Validator:: make(
			$request->all(),
			[
				"actor_id"=>"required ",
                "pelicula"=>"required ",
				
			],
			[
				"acotor_id.required"=>"El campo :attribute es obligatorio",
                "pelicula.required"=>"El campo :attribute es obligatorio",
				
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

				$protagonista = new protagonista();
				$protagonista->actor_id 		=$request->actor_id;
                $protagonista->pelicula 		=$request->pelicula;
				
				if($protagonista->save())
				
					return response()->json([
						"status"=>201,
						"message"=>"Datos insertados de manera satisfactoria",
						"error"=>[],
						"data"=>$protagonista
					],201);

	}

    public function buscarpr()
	{
		return response()->json([
			"status"=>200,
			"message"=>"Datos encontrados satisfactoriamente",
			"error"=>[],
			"data"=>protagonista::all()
		],200);
	}

    public function updatepr(Request $request, int $id)
	{
		$validacion = Validator:: make(
			$request->all(),
			[
				"actor_id"=>"required ",
                "pelicula"=>"required ",
				
			],
			[
				"acotor_id.required"=>"El campo :attribute es obligatorio",
                "pelicula.required"=>"El campo :attribute es obligatorio",
				
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
				
				$protagonista=protagonista::find($id);
				if($protagonista)
				{
				    $protagonista->actor_id 		=$request->actor_id;
                    $protagonista->pelicula 		=$request->pelicula;

					$protagonista->update();
				return response()->json([
						"status"=>200,
						"message"=>"Datos actualizados de manera satisfactoria",
						"error"=>[],
						"data"=>$protagonista
					],200);
				}
				else 
				{
					return response()->json([
						"status"=>400,
						"message"=>"No se encontro",
						"error"=>[],
						"data"=>$protagonista
					],400);
				}
			}
}
