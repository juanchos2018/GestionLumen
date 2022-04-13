<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Fase extends Model
{
    //
    protected $primaryKey = 'id_fase';
    public static function SearchFases($id_metodologia){
               
        $lista= DB::table('fases')
        ->select('fases.nombre_fase','fases.id_fase','fases.id_metodologia')
        ->where('fases.id_metodologia', $id_metodologia)          
        ->get();          
        $contador=0;
        $result = array();            
        foreach ($lista as $item) {                     
                    $elementos=array();
                    $listBd=DB::table('plantilla_elementos')
                    ->join('elementos', 'plantilla_elementos.id_elemento', '=', 'elementos.id_elemento')
                    ->select('elementos.nombre_elemento','elementos.id_elemento')       
                    ->where('plantilla_elementos.id_fase', $item->id_fase)          
                    ->get();        
                    foreach ($listBd as $item1) {
                        array_push($elementos,array(               
                            'nombre_elemento' =>$item1->nombre_elemento   , 
                            'id_elemento' =>$item1->id_elemento                 
                        )); 
                    }  
                array_push($result,array(
                    'id_fase' => $item->id_fase,
                    'nombre_fase' =>$item->nombre_fase,
                    'innerCollapse' =>false,
                    'id_metodologia' => $item->id_metodologia,
                    'elementos'=>$elementos     
                ));   

                $contador++;           
           }
         return $result;  
        
    }

    public static function SearchFasesMetodologia($id){
               
        $lista = DB::table('fases')
        ->join('metodologias','metodologias.id','=','fases.id')
        ->select('fases.id_fase','fases.nombre_fase','metodologias.nombre','metodologias.id')
        ->where('fases.id', $id)          
        ->get();      
    
        $tabla = array();   
        $contador=0;
        $result = array();            
            foreach ($lista as $item) {             
                array_push($result,array(
                    'id_fase' => $item->id_fase,
                    'nombre_fase' =>$item->nombre_fase,
                    'innerCollapse' =>false,
                    'id_metodologia' => $item->id,
                    'title' => $item->nombre_fase,
                    'tabla' => $tabla,
                    'index' => $contador,
                ));   
                $contador++;           
            }
        //return array('table' => $products,'products' => $mproducts);
        return $result;            
    }

    public static function getFasesProyecto($id_proyecto){

        return DB::table('cronogramas')
        ->join('cronograma_fases','cronograma_fases.id_cronograma','=','cronogramas.id_cronograma')
        ->join('fases','cronograma_fases.id_fase','=','fases.id_fase')
        ->select('fases.nombre_fase','fases.id_fase','fases.id_metodologia')
        ->where('cronogramas.id_proyecto', $id_proyecto)          
        ->get();  
    }
}
