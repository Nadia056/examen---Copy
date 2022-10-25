<?php

namespace App\Http\Controllers;


use App\Models\genero;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class GeneroController extends Controller
{
	public function createg(Request $request)
	{

	
		$validacion = Validator::make(
			$request->all(),
			[
				"genero" => "required | max:50",

			],
			[
				"genero.required" => "El campo :attribute es obligatorio",

			]
		);
		if ($validacion->fails()) {
			return response()->json([
				"status" => 400,
				"message" => "Error en las validaciones",
				"error" => $validacion->errors(),
				"data" => []
			], 400);
		}

		$genero = Http::post('http://192.168.123.83:8000/api/createg');		
		$genero->genero 		= $request->genero;

		if ($genero->save())

			return response()->json([
				"status" => 201,
				"message" => "Datos insertados de manera satisfactoria",
				"error" => [],
				"data" => $genero
			], 201);
	}

	public function buscarg(Response $response)
	{
		return Http::buscarg()->get('http://192.168.124.126:2365/api/buscarg');
		return response()->json([
			"status" => 200,
			"message" => "Datos encontrados satisfactoriamente",
			"error" => [],
			"data" => genero::all()
		], 200);
	}

	public function updateg(Request $request, int $id)
	{
		$validacion = Validator::make(
			$request->all(),
			[
				"genero" => "required | max:50",
			],
			[
				"genero.required" => "El campo :attribute es obligatorio",
				"genero.max" => "El campo :attribute no debe tener un maximo de :max caracteres",
			]
		);
		if ($validacion->fails()) {
			return response()->json([
				"status" => 400,
				"message" => "Error en las validaciones",
				"error" => $validacion->errors(),
				"data" => []
			], 400);
		}

		$genero = genero::find($id);
		if ($genero) {
			$genero->genero 		= $request->genero;

			$genero->update();
			return response()->json([
				"status" => 200,
				"message" => "Datos actualizados de manera satisfactoria",
				"error" => [],
				"data" => $genero
			], 200);
		} else {
			return response()->json([
				"status" => 400,
				"message" => "No se encontro",
				"error" => [],
				"data" => $genero
			], 400);
		}
	}
}
