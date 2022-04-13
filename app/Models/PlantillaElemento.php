<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PlantillaElemento extends Model
{
    //


    public static function GetElementosFase($id_fase){

        $elementos = DB::table('plantilla_elmentos')
        ->join('fases', 'plantilla_elmentos.id_fase', '=', 'fases.id_fase')
        ->join('elementos', 'plantilla_elmentos.id_elemento', '=', 'elementos.id_elemento')
        ->select('plantilla_elmentos.id_plantilla', 'elementos.nombre_elemento')
        ->where('fases.id_fase',$id_fase)
        ->get();
  
        return $elementos;
     }
  
     public static function GetPlantillas(){
  
        $elementos = DB::table('plantilla_elmentos')
        ->join('elementos', 'plantilla_elmentos.id_elemento', '=', 'elementos.id_elemento')
        ->join('fases', 'plantilla_elmentos.id_fase', '=', 'fases.id_fase')   
        ->select('plantilla_elmentos.id_plantilla','elementos.id_elemento', 'elementos.nombre_elemento','fases.id_fase','fases.nombre_fase')     
        ->get();    
  
        return $elementos;
      
     }
}
