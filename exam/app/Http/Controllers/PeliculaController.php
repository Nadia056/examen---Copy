<?php

namespace App\Http\Controllers;

use App\Models\pelicula;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PeliculaController extends Controller
{
    public function createp(Request $request)
	{
		$validacion = Validator:: make(
			$request->all(),
			[
				"titulo"=>"required | max:50",
                "genero_id"=>"required",
                "protagonista"=>"required",
				"director"=>"required",
                "año"=>"required",
			],
			[
				"titulo.required"=>"El campo :attribute es obligatorio",
                "genero_id.required"=>"El campo :attribute es obligatorio",
                "protagonista.required"=>"El campo :attribute es obligatorio",
                "director.required"=>"El campo :attribute es obligatorio",
                "año.required"=>"El campo :attribute es obligatorio",
				
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

				$pelicula = new pelicula();
				$pelicula->titulo		=$request->titulo;
                $pelicula->genero_id 		=$request->genero_id;
                $pelicula->protagonista =$request->protagonista;
                $pelicula->director     =$request->director;
                $pelicula->año          =$request->año;
				
				if($pelicula->save())
				
					return response()->json([
						"status"=>201,
						"message"=>"Datos insertados de manera satisfactoria",
						"error"=>[],
						"data"=>$pelicula
					],201);

	}

    public function buscarp()
	{
		return response()->json([
			"status"=>200,
			"message"=>"Datos encontrados satisfactoriamente",
			"error"=>[],
			"data"=>pelicula::all()
		],200);
	}

    public function updatep(Request $request, int $id)
	{
		$validacion = Validator:: make(
			$request->all(),
			[
				"titulo"=>"required | max:50",
                "genero_id"=>"required",
                "protagonista"=>"required",
				"director"=>"required",
                "año"=>"required",
			],
			[
                "titulo.required"=>"El campo :attribute es obligatorio",
				"titulo.max"=>"El campo :attribute no debe tener un maximo de :max caracteres",
                "genero_id.required"=>"El campo :attribute es obligatorio",
				"protagonista.required"=>"El campo :attribute es obligatorio",
                "director.required"=>"El campo :attribute es obligatorio",
                "año.required"=>"El campo :attribute es obligatorio",
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
				
				$pelicula=pelicula::find($id);
				if($pelicula)
				{	
				
                $pelicula->titulo		=$request->titulo;
                $pelicula->genero_id 		=$request->genero_id;
                $pelicula->protagonista =$request->protagonista;
                $pelicula->director     =$request->director;
                $pelicula->año          =$request->año;

				$pelicula->update();

				return response()->json([
						"status"=>200,
						"message"=>"Datos actualizados de manera satisfactoria",
						"error"=>[],
						"data"=>$pelicula
					],200);
				}
				else 
				{
					return response()->json([
						"status"=>400,
						"message"=>"No se encontro",
						"error"=>[],
						"data"=>$pelicula
					],400);
				}
			}
}
