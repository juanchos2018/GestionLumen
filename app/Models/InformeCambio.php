<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class InformeCambio extends Model
{
    //

    protected $primaryKey = 'id_informe';

    public static function getInformes(){       
        $informes = DB::table('informe_cambios')
        ->join('proyectos', 'informe_cambios.id_proyecto', '=', 'proyectos.id_proyecto')
        ->join('usuarios', 'informe_cambios.id_usuario', '=', 'usuarios.id_usuario')
        ->select('informe_cambios.id_informe','informe_cambios.descripcion','informe_cambios.timepo','informe_cambios.costo','informe_cambios.impacto','informe_cambios.estado','proyectos.id_proyecto','proyectos.nombre_proyecto','usuarios.nombre_usuario')     
        ->get();   
         return $informes;
    }

    public static function InformePdf($id_informe){
        
        $informe = InformeCambio::find($id_informe);     
        $proyecto=Proyecto::find($informe->id_proyecto); 
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <title></title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

        </head>
        <body class="">      
               <h5 class="text-center">INFORME DE CAMBIO</h5>
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
                <th  width="13%"  class="text-left"> <label style="margin-left:10px">Descriciopn :</label>  </th>
                <td  width="13%"> <label style="margin-left:50px">'.$informe->descripcion.'</label>  </td>
            
                </tr>
                <tr>
                <th  width="13%"  class="text-left"> <label style="margin-left:10px">Tiempo :</label>  </th>
                <td  width="13%"> <label style="margin-left:50px">'.$informe->timepo.'</label>  </td>
            
                </tr>


                </tr>
                <tr>
                <th  width="10%"> <label style="margin-left:10px">Inpacto :</label>  </th>
                <td  width="50%"> <label style="margin-left:50px">'.$informe->impacto.'</label>  </td>
            
                </tr>
                         
            </tbody>
         </table>
        </body>
        </html>
        ';

        return $html;
    }
}
