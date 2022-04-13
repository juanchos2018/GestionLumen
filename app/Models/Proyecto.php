<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Proyecto extends Model
{
    //
    protected $primaryKey = 'id_proyecto';

    
    public static function ListarProyectoUser($id){       
        $proyectos = DB::table('proyectos')
        ->where('proyectos.id_usuario', $id)     
        ->get();    
        $result = array();    
        $contador=0;
        foreach ($proyectos as $item) {
            $listaMiembros=array();
            $listami=DB::table('miembro_proyectos')
            ->join('usuarios', 'miembro_proyectos.id_usuario', '=', 'usuarios.id_usuario')
            ->join('rols', 'miembro_proyectos.id_rol', '=', 'rols.id_rol')
            ->select('usuarios.nombre_usuario','usuarios.id_usuario','rols.nombre_rol')       
            ->where('miembro_proyectos.id_proyecto', $item->id_proyecto)          
            ->get();        
            foreach ($listami as $item1) {
                array_push($listaMiembros,array(               
                    'nombre_usuario' =>$item1->nombre_usuario   ,
                    'id_usuario' =>$item1->id_usuario    ,
                    'nombre_rol' =>$item1->nombre_rol                 
                )); 
            }        
            array_push($result,array(
                'id_proyecto' => $item->id_proyecto,
                'nombre_proyecto' =>$item->nombre_proyecto,
                'porcentaje' => $item->porcentaje,
                'fecha_ini' => $item->fecha_ini,
                'fecha_fin' => $item->fecha_fin,                     
                'index' => $contador,            
                'listaMiembros' => $listaMiembros,  
            ));          
            $contador++; 
        }
         return $result;
    }

    public static function ListarProyectoMiembro($id_usuario){       
        $proyectos = DB::table('miembro_proyectos')
        ->join('rols', 'miembro_proyectos.id_rol', '=', 'rols.id_rol')
        ->join('proyectos', 'miembro_proyectos.id_proyecto', '=', 'proyectos.id_proyecto')
        ->select('miembro_proyectos.id_miembro_proyecto','rols.nombre_rol','proyectos.id_proyecto','proyectos.nombre_proyecto','proyectos.fecha_ini','proyectos.fecha_fin')     
        ->where('miembro_proyectos.id_usuario', $id_usuario)     
        ->get();    
        
         return $proyectos;
    }
    public static function JefeProyectoView($id_proyecto){          
   
        $jefe = DB::table('usuarios')
        ->join('tipo_usuarios', 'usuarios.id_tipo', '=', 'tipo_usuarios.id_tipo')
        ->join('miembro_proyectos', 'usuarios.id_usuario', '=', 'miembro_proyectos.id_usuario')
        ->select('miembro_proyectos.id_miembro_proyecto','usuarios.id_usuario','usuarios.nombre_usuario')     
        ->where('tipo_usuarios.nombre_tipo', "Jefe")     
        ->where('miembro_proyectos.id_proyecto', $id_proyecto)     
        ->get();            
         return $jefe;
    }
}
