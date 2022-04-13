<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Cronograma;
use App\Models\CronogramaFase;
use App\Models\MiembroProyecto;

class ProyectoController extends Controller
{
    //
  
    public function ListarProyecto(){
        return Proyecto::ListarProyecto();
    }
    public function ListarProyectoUser($id_usuario){
        try
        {
          $result= Proyecto::ListarProyectoUser($id_usuario);
          return response()->json(['status' => 200,'result' => $result]);    
        } catch (\Exception $e){   
            return response()->json(['status' => 404,'message'=>$e->getMessage()]);
        } 
    }
    public function ListarProyectoMiembro($id_usuario){
        try
        {
          $result= Proyecto::ListarProyectoMiembro($id_usuario);
          return response()->json(['status' => 200,'result' => $result]);    
        } catch (\Exception $e){   
            return response()->json(['status' => 404,'message'=>$e->getMessage()]);
        } 
    }
    public function Store(Request $request)
    {
        try
        {
        $vector=array();
        $obj  =new Proyecto();
        $obj->nombre_proyecto=$request->nombre_proyecto;     
        $obj->descripcion=$request->descripcion;   
        $obj->fecha_ini=$request->fecha_inicio;   
        $obj->fecha_fin=$request->fecha_fin;   
        $obj->porcentaje=0;   
        $obj->id_metodologia=$request->id_metodologia;
        $obj->id_usuario=$request->id_usuario;//id usuariio jefe
        $obj->save();        
        $id_proyect=$obj->id_proyecto;
      
        $crono=new Cronograma();
        $crono->fecha_ini=$request->fecha_inicio;
        $crono->fecha_fin=$request->fecha_fin;
        $crono->id_proyecto=$id_proyect;
        $crono->save();
        $id_cronograma= $crono->id;   
        $order_detail = $request->listaFases;
        $result = array();
        $contador=0;   
        for ($i=0; $i < count($order_detail); $i++) { 
                $crono_fase=new CronogramaFase();
                $crono_fase->id_cronograma=$id_cronograma;
                $crono_fase->nombre=$order_detail[$i]['nombre_fase'];
                $crono_fase->id_fase=$order_detail[$i]['id_fase'];
                $crono_fase->porcentaje_fase=$request->porcentaje;
                $crono_fase->save();
                $id_crongrama_fase=$crono_fase->id;
                array_push($result,array(
                        'id_cronograma' => $id_cronograma,   
                        'id_cronograma_fase' => $id_crongrama_fase,   
                        'nombre' => $order_detail[$i]['nombre_fase'],                
                        'id_fase' => $order_detail[$i]['id_fase'],
                    ));   
            $contador++; 
        }

        $obj1 =new MiembroProyecto();
        $obj1->id_usuario=$request->id_usuario;
        $obj1->id_rol=1;
        $obj1->id_proyecto=$id_proyect;        
        $obj1->save();   

     

      //  return response()->json(array('success' => true, 'last_insert_id' => $obj->id), 200);
      return response()->json(['status' => 200,'result' => $result,"lista"=>$order_detail ]);    
        } catch (\Exception $e){   
            return response()->json(['status' => 404,'message'=>$e->getMessage()]);
        } 
    }

    public function View($id_proyecto)
    {
        $obj = Proyecto::find($id_proyecto);
        if($obj){
            return response()->json(['status' => 200,'result' => $obj]);
        }else{
            return response()->json(['status' => 404]);
        }
    }
    public function JefeProyectoView($id_proyecto)
    {
       
        $obj = Proyecto::JefeProyectoView($id_proyecto);
        if($obj){
            return response()->json(['status' => 200,'result' => $obj]);
        }else{
            return response()->json(['status' => 404]);
        }
    }
}
