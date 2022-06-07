<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;

class TareaController extends Controller
{
    //

    public function get($id_version)
    {       
        $obj = Tarea::GetTareasVersion($id_version);
        if($obj != null){
            return response()->json(['status' => 200,'result' => $obj]);
        }else{
            return response()->json(['status' => 404]);
        }
    } 
    public function GetTareasMenber($id_miembro_proyecto)
    {       
        $obj = Tarea::GetTareasMenber($id_miembro_proyecto);
        if($obj != null){
            return response()->json(['status' => 200,'result' => $obj]);
        }else{
            return response()->json(['status' => 404]);
        }
    } 
    public function view($id_tarea)
    {       
        $obj = Tarea::find($id_tarea);
        if($obj){
            return response()->json(['status' => 200,'result' => $obj]);
        }else{
            return response()->json(['status' => 404]);
        }
    } 
    public function Store(Request $request)
    {         
        try
        {       
            $obj  =new Tarea();
            $obj->titulo=$request->titulo;   
            $obj->descripcion=$request->descripcion;
            $obj->fecha_inicio=$request->fecha_inicio;  
            $obj->fecha_termino=$request->fecha_termino;
            $obj->estado=$request->estado;   
            $obj->estado1=$request->estado1;   
            $obj->porcentaje=$request->porcentaje;
            $obj->id_miembro_proyecto=$request->id_miembro_proyecto;  
            $obj->id_version=$request->id_version;  
       
            $obj->save();   
            return response()->json(['status' => 200,'result' => $obj]);
        
        } catch (\Exception $e){   
            return response()->json(['status' => 404,'message'=>$e->getMessage()]);
        } 
    }

    public function Update(Request $request)
    {
        $this->validate($request, [
            'id_tarea' => 'required',
            'porcentaje' => 'required',
        ]);
    
        try
        {        
            $obj = Tarea::find($request->id_tarea);
            $obj->estado = $request->estado;
            $obj->estado1 ="Proceso";
            $obj->porcentaje = $request->porcentaje;   
            if ($request->porcentaje==100) {
                $obj->estado ="Terminado";
                $obj->estado1 ="Terminado";  
                $obj->estado2 ="Revision"; 
            }    
            $obj->url_evidencia = $request->url_evidencia;   
            $obj->update();
            return response()->json(['status' => 200,'result' => $obj]);
          
        } catch (\Exception $e){   
            return response()->json(['status' => 404,'message'=>$e->getMessage()]);
        }   
    }
    public function Ssucess(Request $request)
    {
        // $this->validate($request, [
        //     'id_tarea' => 'required',
        //     'porcentaje' => 'required',
        // ]);
    
        try
        {        
            $obj = Tarea::find($request->id_tarea);  
            $obj->estado1 ="Aprobado";       
            $obj->estado2 ="Aprobado";           
            $obj->update();
            return response()->json(['status' => 200,'result' => $obj]);
          
        } catch (\Exception $e){   
            return response()->json(['status' => 404,'message'=>$e->getMessage()]);
        }   
    }
}
