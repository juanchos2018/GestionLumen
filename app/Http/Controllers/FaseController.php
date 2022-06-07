<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fase;

class FaseController extends Controller
{
    //


    public function get()
    {
        //return Fase::get();
        $obj = Fase::get();
        if($obj != null){
            return response()->json(['status' => 200,'result' => $obj]);
        }else{
            return response()->json(['status' => 404]);
        }
    }

    public function store(Request $request)
    {         
        try
        {         
            $obj = Fase::where('nombre_fase',$request->nombre_fase)->where('id_metodologia',$request->id_metodologia)->count();
            if($obj> 0){
                return response()->json(['status' => 404,'message' => "nombre ya existe"]);

            }else{
                $page="page1";
                $obj  =new Fase();
                $obj->nombre_fase=$request->nombre_fase;   
                $obj->id_metodologia=$request->id_metodologia;
                $obj->label=$request->nombre_fase;   
                $obj->slot=$page; 
                $obj->save();  
                return response()->json(['status' => 200,'result' => $obj,'message' => "Registrado"]);              
            } 

            // $page="page1";
            // $obj  =new Fase();
            // $obj->nombre_fase=$request->nombre_fase;   
            // $obj->id_metodologia=$request->id_metodologia;
            // $obj->label=$request->nombre_fase;   
            // $obj->slot=$page; 
            // $obj->save();   
            // return response()->json(['status' => 200,'result' => $obj]);
        
        } catch (\Exception $e){   
            return response()->json(['status' => 404,'message'=>$e->getMessage()]);
        } 
    }

    public function SearchFases($id_metodologia){
        try
        {
            $obj = Fase::SearchFases($id_metodologia);
            if($obj){
                return response()->json(['status' => 200,'result' => $obj]);
            }else{
                return response()->json(['status' => 404]);
            }
        } catch (\Exception $e){   
            return response()->json(['status' => 404,'message'=>$e->getMessage()]);
        } 
    }  
    public function SearchFasesMetodologia($id){
        $list=Fase::SearchFasesMetodologia($id);
        if ($list) {
            return response()->json(['status' =>200,'result'=>$list]);
        }
        else{
            return response()->json(['status' =>404]);
        }
    }

    public function getFasesProyecto($id_proyecto){
        try
        {
            $obj = Fase::getFasesProyecto($id_proyecto);
            if($obj){
                return response()->json(['status' => 200,'result' => $obj]);
            }else{
                return response()->json(['status' => 404]);
            }
        } catch (\Exception $e){   
            return response()->json(['status' => 404,'message'=>$e->getMessage()]);
        } 
    }
    
}   
