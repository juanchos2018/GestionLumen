<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Version;

class VersionController extends Controller
{
    //
    public function get($id_cronograma_elemento)
    {
       // return Usuario::get();
        $obj = Version::GetReponsableVersion($id_cronograma_elemento);
        if($obj){
            return response()->json(['status' => 200,'result' => $obj]);
        }else{
            return response()->json(['status' => 404]);
        }
    }  


    public function Store(Request $request)
    {   
        $this->validate($request, [
            'version' => 'required',
            'id_cronograma_elemento' => 'required',
            'id_miembro_proyecto' => 'required',
        ]);    
        try
        {       
            $obj = Version::where('version',$request->version)->where('id_cronograma_elemento',$request->id_cronograma_elemento)->count();
            if($obj> 0){
                return response()->json(['status' => 404,'message' => "ya existe esta version"]);

            }else{
                $obj  =new Version();
                $obj->version=$request->version;   
                $obj->fecha_inicio=$request->fecha_inicio;
                $obj->fecha_termino=$request->fecha_termino; 
                $obj->id_cronograma_elemento=$request->id_cronograma_elemento;
                $obj->id_miembro_proyecto=$request->id_miembro_proyecto;              
                $obj->save();   
                return response()->json(['status' => 200,'result' => $obj,'message' => "Registrado"]);
            }           
          
        } catch (\Exception $e){   
            return response()->json(['status' => 404,'message'=>$e->getMessage()]);
        } 
    }
    // public function Stores(Request $request)
    // {         
    //     try
    //     {                   
    //         $obj  =new Version();
    //         $obj->version=$request->version;   
    //         $obj->fecha_inicio=$request->fecha_inicio;
    //         $obj->fecha_termino=$request->fecha_termino; 
    //         $obj->id_cronograma_elemento=$request->id_cronograma_elemento;
    //         $obj->id_miembro_proyecto=$request->id_miembro_proyecto;              
    //         $obj->save();   
    //         return response()->json(['status' => 200,'result' => $obj]);
        
    //     } catch (\Exception $e){   
    //         return response()->json(['status' => 404,'message'=>$e->getMessage()]);
    //     } 
    // }
}
