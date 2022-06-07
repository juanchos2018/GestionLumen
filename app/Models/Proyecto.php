<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Usuario;

class Proyecto extends Model
{
   
    protected $primaryKey = 'id_proyecto';
    
    public static function ListarProyectoUser($id){  
     
        $user =DB::table('usuarios')
        ->join('tipo_usuarios','usuarios.id_tipo','=','tipo_usuarios.id_tipo')
        ->select('usuarios.nombre_usuario','tipo_usuarios.nombre_tipo')      
        ->where('usuarios.id_usuario',$id)->first();

        if ($user->nombre_tipo=="Jefe") {            
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
                            'nombre_usuario' =>$item1->nombre_usuario,
                            'id_usuario' =>$item1->id_usuario,
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
                        'user' => $user,  
                    ));          
                    $contador++; 
                }
                return $result;
        }else{                    
                $proyectos = DB::table('proyectos')->get();    
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
                            'nombre_usuario' =>$item1->nombre_usuario,
                            'id_usuario' =>$item1->id_usuario,
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
                        'user' => $user,  
                    ));          
                    $contador++; 
                }
                return $result;
        }
        
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

    public static function CantTareas() {      
            
        $result = array();  
        $proyectos = DB::table('proyectos')->get(); 
        $contador=0;
        foreach ($proyectos as $item) {
            $listaTaras=array();
            $data=array();
            $labels=array();
            $background =array();
            $arraycolor=array();
            $tareas =DB::table('tareas')
            ->selectRaw('proyectos.id_proyecto,proyectos.nombre_proyecto, count(tareas.estado) as cantidad, tareas.estado')
            ->join('versions','tareas.id_version','=', 'versions.id_version')
            ->join('cronograma_elementos','versions.id_cronograma_elemento','=', 'cronograma_elementos.id_cronograma_elemento')
            ->join('cronograma_fases','cronograma_elementos.id_cronograma_fase','=', 'cronograma_fases.id_cronograma_fase')
            ->join('cronogramas','cronograma_fases.id_cronograma','=', 'cronogramas.id_cronograma') 
            ->join('proyectos','cronogramas.id_proyecto','=', 'proyectos.id_proyecto') 
            ->groupBy('proyectos.id_proyecto','tareas.estado') 
            ->where('proyectos.id_proyecto', $item->id_proyecto)   
            ->get();
            
            foreach ($tareas as $item1) {
                array_push($listaTaras,array(               
                    'estado' =>$item1->estado,
                    'cantidad' =>$item1->cantidad                           
                )); 
                array_push($data,$item1->cantidad);
                array_push($labels,$item1->estado);
                $array_objet['data']=$data;
                $color=sprintf('#%06X', mt_rand(0, 0xFFFFFF));         
                array_push($arraycolor,$color);                 
            }        
             
            $array_objet['backgroundColor']=$arraycolor;
            array_push($background,$array_objet);
            array_push($result,array(
                'id_proyecto' => $item->id_proyecto,
                'nombre_proyecto' =>$item->nombre_proyecto,                            
                'index' => $contador,            
                'listaTareas' => $listaTaras,  
                'data' => $data,  
                'labels' => $labels,  
                'background'=>$background
            ));          
            $contador++; 
        }
       return $result;
    }   
    public static function Grafico1(){          
   
        $proyectos = DB::table('proyectos')->get();    
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
                    'nombre_usuario' =>$item1->nombre_usuario,
                    'id_usuario' =>$item1->id_usuario,
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
}
