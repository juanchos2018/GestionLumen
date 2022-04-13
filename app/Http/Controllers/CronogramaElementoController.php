<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CronogramaElemento;


class CronogramaElementoController extends Controller
{
    //


    public function Store(Request $request)
    {
        try
        {
        $order_detail = $request->listaenviar;
        for ($i=0; $i < count($order_detail); $i++) { 
            $obj  =new CronogramaElemento();
            $obj->id_elemento=$order_detail[$i]['id_elemento'];   
            $obj->nombre_elemento=$order_detail[$i]['nombre_elemento'];   
            $obj->id_cronograma=$order_detail[$i]['id_cronograma'];   
            $obj->id_cronograma_fase=$order_detail[$i]['id_cronograma_fase'];             
            $obj->save();  
        }
        return response()->json(['status' => 200,'message' =>"save" ]);    

        } catch (\Exception $e){   
            return response()->json(['status' => 404,'message'=>$e->getMessage()]);
        } 
     }
}
