<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MiembroProyecto;
//MiembroProyecto

class MiembroProyectoController extends Controller
{
    //
  
    public function getMember($id_proyecto)
    {
        $obj = MiembroProyecto::ListarProyectoMember($id_proyecto);    
        if($obj != null){
            return response()->json(['status' => 200,'result' => $obj]);
        }else{
            return response()->json(['status' => 404]);
        }             
         //return response()->json(array('success' => true, 'result' => $obj), 200);
    }


    public function Store(Request $request)
    {   
        $this->validate($request, [
            'id_usuario' => 'required',
            'id_rol' => 'required',
            'id_proyecto' => 'required',
        ]);    
        try
        {       
            $obj = MiembroProyecto::where('id_proyecto',$request->id_proyecto)->where('id_usuario',$request->id_usuario)->count();
            if($obj> 0){
                return response()->json(['status' => 404,'message' => "ya existe este usuario"]);

            }else{
                $obj =new MiembroProyecto();
                $obj->id_usuario=$request->id_usuario;
                $obj->id_rol=$request->id_rol;
                $obj->id_proyecto=$request->id_proyecto;        
                $obj->save();   
                return response()->json(['status' => 200,'result' => $obj,'message' => "Registrado"]);
            }           
          
        } catch (\Exception $e){   
            return response()->json(['status' => 404,'message'=>$e->getMessage()]);
        } 
    }

    public function Stores(Request $request)
    {
        $obj =new MiembroProyecto();
        $obj->id_usuario=$request->id_usuario;
        $obj->id_rol=$request->id_rol;
        $obj->id_proyecto=$request->id_proyecto;        
        $obj->save();    
        return response()->json(array('success' => true, 'last_insert_id' => $obj->id), 200);

    }

}
