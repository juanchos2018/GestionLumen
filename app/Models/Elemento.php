<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Elemento extends Model
{
    //

    public static function SearchElemento($search){       
       
        return DB::table('elementos')
        ->select('elementos.id_elemento','elementos.nombre_elemento')     
        ->where(function ($query) use ($search) {
            $query = $query->orWhere('elementos.nombre_elemento','like',"%$search%");          
        })     
        ->limit(15)
        ->get();        
    }

    public static function GetElemento($id_proyecto,$id_fase){       

        return   DB::table('proyectos')
        ->join('cronogramas', 'proyectos.id_proyecto', '=', 'cronogramas.id_proyecto')
        ->join('cronograma_fases', 'cronogramas.id_cronograma', '=', 'cronograma_fases.id_cronograma')
        ->join('cronograma_elementos', 'cronograma_fases.id_cronograma_fase', '=', 'cronograma_elementos.id_cronograma_fase')
        ->select('cronograma_elementos.id_cronograma_elemento','cronograma_elementos.nombre_elemento','cronograma_elementos.id_elemento','cronograma_fases.id_fase')   
        ->where('proyectos.id_proyecto', $id_proyecto)    
        ->where('cronograma_fases.id_fase', $id_fase)           
        ->get();        
    }

}
