<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Metodologia;


class MetodologiaController extends Controller
{
    //

    public function get()
    {
        //return Metodologia::get();
        $obj = Metodologia::get();
        if($obj != null){
            return response()->json(['status' => 200,'result' => $obj]);
        }else{
            return response()->json(['status' => 404]);
        }
    } 
    public function view($id)
    {       
        $obj = Metodologia::find($id);
        if($obj){
            return response()->json(['status' => 200,'result' => $obj]);
        }else{
            return response()->json(['status' => 404]);
        }
    } 

    public function store(Request $request)
    {        
        $this->validate($request, [
            'nombre' => 'required',
        ]);    
        try
        {       
            $obj = Metodologia::where('nombre',$request->nombre)->count();
            if($obj> 0){
                return response()->json(['status' => 404,'message' => "nombre ya existe"]);

            }else{
                $obj = new Metodologia();
                $obj->nombre=$request->nombre;   
                $obj->save();
                return response()->json(['status' => 201,'result' => $obj,'message' => "Registrado"]);              
            }  
          
        } catch (\Exception $e){   
            return response()->json(['status' => 404,'message'=>$e->getMessage()]);
        } 
    }
}
