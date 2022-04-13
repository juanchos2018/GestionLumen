<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Usuario;

class UsuarioController extends Controller
{
    
    public function getAll()
    {     //aqui
        $obj = Usuario::getAllUsuario();
        if($obj){
            return response()->json(['status' => 200,'result' => $obj]);
        }else{
            return response()->json(['status' => 404]);
        }
    }   

    public function get()
    {     
        $obj = Usuario::where('id_tipo',3)->get();
        if($obj){
            return response()->json(['status' => 200,'result' => $obj]);
        }else{
            return response()->json(['status' => 404]);
        }
    }   

    public function ListTypeMiembro(){
        return Usuario::ListTypeMiembro();
    }
  
    public function store(Request $request)
    {        
        $this->validate($request, [
            'nombre_usuario' => 'required',
            'correo_usuario' => 'required',
            'password_usuario' => 'required',
        ]);  
        try
        {     
            $obj = Usuario::where('correo_usuario',$request->correo_usuario)->count();
            if($obj> 0){
                return response()->json(['status' => 200,'result' => $request,'message' => "Existe este Correo"]);
            }else{
                $obj =new Usuario();
                $obj->nombre_usuario=$request->nombre_usuario;
                $obj->apellido_usuario=$request->apellido_usuario;
                $obj->correo_usuario=$request->correo_usuario;
                $obj->password_usuario=$request->password_usuario;
                $obj->id_tipo=$request->id_tipo;
                $obj->save();     
                return response()->json(['status' => 200,'result' => $obj,'message' => "Registrado"]);
            }           
        
        } catch (\Exception $e){   
            return response()->json(['status' => 404,'message'=>$e->getMessage()]);
        }
    }


    public function Login(Request $request)
    {
        if ($request->isJson()) {

            try {
                $user = Usuario::Login($request->correo_usuario, $request->password_usuario);
                  if ($user) {
                    return response()->json(['status' => 200, 'result' => $user]);

                  }  else{
                      //,"message"=>"no existe"
                      return response()->json(['status' => 404, "message"=>"no existe"]);

                  }

               } catch (\Exception $e) {
                return response()->json(['status' => 404, 'result' => 'error'.$e]);
            }
        }

        return response()->json(['status' => 405, 'error' => 'unauthtorized']);
    }
}
