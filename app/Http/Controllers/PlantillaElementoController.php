<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlantillaElemento;

class PlantillaElementoController extends Controller
{
   
    public function get()
    {    $obj= PlantillaElemento::GetPlantillas();
        //return PlantillaElmento::GetPlantillas();
        if($obj){
            return response()->json(['status'=>200,'result'=>$obj]);
        }
        else{
            return response()->json(['status' => 404]);
        }
    }

    public function Store(Request $request)
    {         
        $this->validate($request, [
            'id_fase' => 'required',
            'id_elemento' => 'required',
        ]);    
        try
        {    
            $obj = PlantillaElemento::where('id_fase',$request->id_fase)->where('id_elemento',$request->id_elemento)->count();
            if($obj> 0){
                return response()->json(['status' => 404,'message' => "ya existe este elemento"]);
            }else{
                $obj  =new PlantillaElemento();
                $obj->id_fase=$request->id_fase; 
                $obj->id_elemento=$request->id_elemento;    
                $obj->save();       
                return response()->json(['status' => 200,'result' => $obj,'message' => "Registrado"]);              
            } 
           // return response()->json(['status' => 200,'result' => $obj]);   
          
        } catch (\Exception $e){   
            return response()->json(['status' => 404,'message'=>$e->getMessage()]);
        } 
    }

    public function GetElementosFase($id){
        $obj= PlantillaElemento::GetElementosFase($id);
        if($obj){
            return response()->json(['status'=>200,'result'=>$obj]);
        }
        else{
            return response()->json(['status' => 404]);
        }
    }
   

}
