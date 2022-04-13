<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Tarea extends Model
{
    //
    protected $primaryKey = 'id_tarea';


    public static function GetTareasVersion($id_version){

        $elementos = DB::table('tareas')
        ->join('miembro_proyectos', 'tareas.id_miembro_proyecto', '=', 'miembro_proyectos.id_miembro_proyecto')
        ->join('usuarios', 'miembro_proyectos.id_usuario', '=', 'usuarios.id_usuario')
        ->select('tareas.id_tarea','tareas.titulo','tareas.descripcion','tareas.fecha_inicio','tareas.fecha_termino','tareas.estado','tareas.estado1','tareas.estado2','tareas.porcentaje','tareas.id_version', 'tareas.id_miembro_proyecto', 'usuarios.nombre_usuario')
        ->where('tareas.id_version',$id_version)
        ->get();
  
        return $elementos;
     }

     public static function GetTareasMenber($id_miembro_proyecto){
            //aun no hagpo esto
        $elementos = DB::table('tareas')
        ->join('miembro_proyectos', 'tareas.id_miembro_proyecto', '=', 'miembro_proyectos.id_miembro_proyecto')
        ->join('usuarios', 'miembro_proyectos.id_usuario', '=', 'usuarios.id_usuario')
        ->select('tareas.id_tarea','tareas.titulo','tareas.descripcion','tareas.fecha_inicio','tareas.fecha_termino', 'tareas.url_evidencia','tareas.estado','tareas.estado1','tareas.estado2','tareas.porcentaje','tareas.id_version', 'tareas.id_miembro_proyecto','usuarios.nombre_usuario')
        ->where('tareas.id_miembro_proyecto',$id_miembro_proyecto)
        ->get();
  
        return $elementos;
     }
}
