<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Response;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rules\In;
use Twilio\Rest\Client;


class undiad1Controller extends Controller
{
  
  public function pagina1( Response $response)
  {
    $response = Http::withBasicAuth('ACfc2b7ee4660013cc85c6f4999004d9bc', '89f5f306532fd0a0c7d8e826877b9372')->
    get('https://api.twilio.com/2010-04-01/Accounts/ACfc2b7ee4660013cc85c6f4999004d9bc/Messages.json');
      if($response->ok()){
          Log::channel('slackinfo')
          ->info('Something happened in unidad1Controller@pagina1',

           [$response->object()->messages]);
      
      return response()->json([
          "estatus"=>200,
          "total"=>count($response->object()->messages),
          "result"=>$response->object()->messages,],200);
        }
  
  }
  public function enviarMensaje(Request $request)
    {
      $validacion=Validator::make(
        $request->all(),
        [
          'To'=>"required",
          'From'=>"required",
          'msg'=>"required"

        ],[
          "to.require"=>"El campo :attribute es obligatorio",
          "From.require"=>"El campo :attribute es obligatorio",
          "msg.require"=>"El campo :attribute es obligatorio"

        ]
        );
        if ($validacion->fails())
        return response()->json([
          "status"=>400,
          "message"=>"Error en las validaciones",
          "error"=>$validacion->errors(),
          "data"=>[]
        ],400);
        $response = Http::withBasicAuth('ACfc2b7ee4660013cc85c6f4999004d9bc', '89f5f306532fd0a0c7d8e826877b9372')
      ->asForm()->post('https://api.twilio.com/2010-04-01/Accounts/ACfc2b7ee4660013cc85c6f4999004d9bc/Messages.json',[
            "To"=>$request->to,
            "From"=>$request->From,
            "body"=>$request->msg
          ]);
          if($response->successful())
          return response()->json([
            "status"=>200,
            "message"=>"Envio Exitoso",
            "error"=>[],
            "data"=>[
              "msg"=>$response->object()->body,
              "status"=>$response->object()->status

            ]
            ],$response->status());
            return response()->json([
              "status"=>$response->status(),
              "message"=>$response->object()->message,
              "error"=>[],
              "data"=>[]
            ],$response->status());
    }
    public function leermensaje(Request $request, Response $response)
    {
        $response=Http::withBasicAuth('AC6b000a25372fd4a70cef871d6dced801',  '551c57bf0b36e79ddb780f61f05b09ef')
        ->get('https://api.twilio.com/2010-04-01/Accounts/AC6b000a25372fd4a70cef871d6dced801/Messages.json');

        if($response->ok()){
            log::channel('slackinfo')
            ->info('Something happened in buenocontroller@ahorasi', [$response->object()->messages] );
            return response()->json([
            "estatus"=>200,
            "total"=>count($response->object()->messages),
            "result"=>$response->object()->messages
         ],200);
        }
        elseif ($response->failed()) {
            log::channel('slackinfo')
            ->info('algo sucedio',[$response]);
            return response()->json([
                "estatus"=>400,
                "total"=>count($response->object()->messages),
                "result"=>$response->object()->messages
             ],400);
        }
    }

    public function leerespecifico(Request $request, int $number){
      $response=Http::withBasicAuth('AC6b000a25372fd4a70cef871d6dced801',  '551c57bf0b36e79ddb780f61f05b09ef')
      ->get('https://api.twilio.com/2010-04-01/Accounts/AC6b000a25372fd4a70cef871d6dced801/Messages.json');
        //return Http::dd()->get($response);
        //return Http::dd()->get($response);
        $prev="http:///127.0.0.1:5678/api/twilio/leerespecifico/";
        $next="http:///127.0.0.1:5678/api/twilio/leerespecifico/";
        if($response->ok()){
            log::channel('slackinfo')->info('se realizo una peticion para consultar un dato especifico',[$response]);
            if ($number==1) {
                return response()->json([
                    $page=$number-1,
                    "estatus"=>200,
                    "Next_Page"=>$prev.($page+2),
                    "Prev_Page"=>[],
                    "total"=>count($response->object()->messages),
                    "result"=>$response->object()->messages
                 ],200);
            }
            return response()->json([
                $page=$number-1,
                "estatus"=>200,
                "Next_Page"=>$next . ($page + 2),
                "Prev_Page"=>$prev . ($page),
                "total"=>count($response->object()->messages),
                "result"=>$response->object()->messages[$number],
             ],200); 

        }else if ($response->failed()) {
            log::channel('slackinfo')
            ->info('algo sucedio',[$response]);
            return response()->json([
                "estatus"=>400,
                "total"=>count($response->object()->messages),
                "result"=>$response->object()->messages
             ],400);
           }
    }


    public function matematicas(int $num)
    {
   
      for ($i = 1; $i <= 10; $i++) 
      {

        echo $i."x".$num."=".($i*$num);
        echo "<br>";

      }
    }

 
  }
