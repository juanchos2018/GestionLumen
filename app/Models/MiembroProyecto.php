<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MiembroProyecto extends Model
{
    //

    public static function ListarProyectoMember($id){       
        return   DB::table('miembro_proyectos')
           ->join('usuarios', 'miembro_proyectos.id_usuario', '=', 'usuarios.id_usuario')
           ->join('rols', 'rols.id_rol', '=', 'miembro_proyectos.id_rol')
           ->select('miembro_proyectos.id_miembro_proyecto','usuarios.nombre_usuario','usuarios.id_usuario','rols.nombre_rol')   
           ->where('miembro_proyectos.id_proyecto', $id)           
           ->get();        
       }
}
