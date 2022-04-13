<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;

class RolController extends Controller
{
    //

    public function get()
    {
        return Rol::get();
    }


    public function Store(Request $request)
    {   
        $this->validate($request, [
            'nombre_rol' => 'required',
        ]);    
        try
        {       
            $obj = Rol::where('nombre_rol',$request->nombre_rol)->count();
            if($obj> 0){
                return response()->json(['status' => 404,'message' => "nombre ya existe"]);

            }else{
                $obj = new Rol();
                $obj->nombre_rol=$request->nombre_rol;   
                $obj->save();
                return response()->json(['status' => 200,'result' => $obj,'message' => "Registrado"]);
            }           
          
        } catch (\Exception $e){   
            return response()->json(['status' => 404,'message'=>$e->getMessage()]);
        } 
    }
}
