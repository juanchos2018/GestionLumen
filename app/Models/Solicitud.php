<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use App\Models\Solicitud;
use Illuminate\Support\Facades\DB;
class Solicitud extends Model
{
    
    protected $primaryKey = 'id_solicitud';

    public static function SolictudesJefe($id_jefe){       
        $solicituds = DB::table('solicituds')
        ->join('proyectos', 'solicituds.id_proyecto', '=', 'proyectos.id_proyecto')
        ->join('usuarios', 'solicituds.id_usuario', '=', 'usuarios.id_usuario')
        ->select('solicituds.id_solicitud','solicituds.fecha','solicituds.objetivo','solicituds.estado2','solicituds.linkdocumento','proyectos.id_proyecto','proyectos.nombre_proyecto','usuarios.nombre_usuario')     
        ->where('solicituds.id_jefe', $id_jefe)     
        ->get();   
         return $solicituds;
    }
    public static function SolictudesProyecto($id_jefe){       
        $proyectos = DB::table('solicituds')
        ->join('proyectos', 'solicituds.id_proyecto', '=', 'id_proyecto.id_rol')
        ->join('usuarios', 'solicituds.id_usuario', '=', 'usuarios.id_usuario')
        ->select('solicituds.fecha','solicituds.objetivo','solicituds.estado2','proyectos.id_proyecto','proyectos.nombre_proyecto','proyectos.fecha_ini','proyectos.fecha_fin')     
        ->where('solicituds.id_jefe', $id_jefe)     
        ->get();            
        return $proyectos;
    }
    public static function SolictudesProyectoDos($id_proyecto){       
        $proyectos = DB::table('solicituds')
        ->join('proyectos', 'solicituds.id_proyecto', '=', 'proyectos.id_proyecto')
        ->join('usuarios', 'solicituds.id_usuario', '=', 'usuarios.id_usuario')
        ->select('solicituds.id_solicitud','solicituds.fecha','solicituds.objetivo','solicituds.estado2','solicituds.linkdocumento','proyectos.id_proyecto','proyectos.nombre_proyecto','usuarios.nombre_usuario')     
        ->where('solicituds.id_proyecto', $id_proyecto)     
        ->get();            
        return $proyectos;
    }
    

    public static function SolictudesProyectoTres($id_jefe){       
        $proyectos = DB::table('solicituds')
        ->join('proyectos', 'solicituds.id_proyecto', '=', 'proyectos.id_proyecto')
        ->join('usuarios', 'solicituds.id_usuario', '=', 'usuarios.id_usuario')
        ->leftjoin('informe_cambios', 'solicituds.id_solicitud', '=', 'informe_cambios.id_solicitud')
        ->select('solicituds.id_solicitud','solicituds.fecha','solicituds.objetivo','solicituds.estado2','solicituds.linkdocumento','proyectos.id_proyecto','proyectos.nombre_proyecto','usuarios.nombre_usuario','informe_cambios.estado')     
        ->where('solicituds.id_jefe', $id_jefe)     
        ->get();            
        return $proyectos;
    }

    public static function SolicitudPdf($id_solicitud){
        
        $solicitud = Solicitud::find($id_solicitud);     
        $proyecto=Proyecto::find($solicitud->id_proyecto); 
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <title></title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

        </head>
        <body class="">      
               <h5 class="text-center">SOLICITUD DE CAMBIO</h5>
               <br>
         <table >    
            <thead>
                <tr>
                <th  width="100%">             </th>     
                <th  width="100%">             </th>               
            
                </tr>
            </thead>
            <tbody>
                <tr>
                <th  width="13%"  class="text-left"> <label style="margin-left:10px">Proyecto :</label>  </th>
                <td  width="13%"> <label style="margin-left:50px">' .$proyecto->nombre_proyecto.'</label>    </td>
            
                </tr>

                <tr>
                <th  width="13%"  class="text-left"> <label style="margin-left:10px">Fecha :</label>  </th>
                <td  width="13%"> <label style="margin-left:50px">'.$solicitud->fecha.'</label>  </td>
            
                </tr>
                <tr>
                <th  width="13%"  class="text-left"> <label style="margin-left:10px">Objetivo :</label>  </th>
                <td  width="13%"> <label style="margin-left:50px">'.$solicitud->objetivo.'</label>  </td>
            
                </tr>


                </tr>
                <tr>
                <th  width="10%"> <label style="margin-left:10px">Descripcion :</label>  </th>
                <td  width="50%"> <label style="margin-left:50px">'.$solicitud->descripcion.'</label>  </td>
            
                </tr>
                         
            </tbody>
         </table>
        </body>
        </html>
        ';

        return $html;
    }
}
