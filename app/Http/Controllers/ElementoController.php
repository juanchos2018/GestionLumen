<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Elemento;


class ElementoController extends Controller
{
    //

    public function get()
    {
        //return Elemento::get();
        $obj = Elemento::get();
        if($obj != null){
            return response()->json(['status' => 200,'result' => $obj]);
        }else{
            return response()->json(['status' => 404]);
        }
    }  

    public function Store(Request $request)
    {   
        $this->validate($request, [
            'nombre_elemento' => 'required',
        ]);    
        try
        {       
            $obj = Elemento::where('nombre_elemento',$request->nombre_elemento)->count();
            if($obj> 0){
                return response()->json(['status' => 404,'message' => "nombre ya existe"]);

            }else{
                $obj = new Elemento();
                $obj->nombre_elemento=$request->nombre_elemento;   
                $obj->save();
                return response()->json(['status' => 200,'result' => $obj,'message' => "Registrado"]);
            }           
          
        } catch (\Exception $e){   
            return response()->json(['status' => 404,'message'=>$e->getMessage()]);
        } 
    }
   public function SearchElemento($search)
    {        
        $obj = Elemento::SearchElemento($search);
        $elememto = array();
        foreach ($obj as $be) {
            array_push($elememto,
                array(
                    'id_elemento' => $be->id_elemento,
                    'nombre_elemento' => $be->nombre_elemento
                )
            );
        }
        return response()->json(['status' => 200,'result' => $elememto]);      
    }

    public function GetElemento($id_proyecto,$id_fase)
    {
        //return Elemento::get();
        $obj = Elemento::GetElemento($id_proyecto,$id_fase);
        if($obj != null){
            return response()->json(['status' => 200,'result' => $obj]);
        }else{
            return response()->json(['status' => 404]);
        }
    }  
}
