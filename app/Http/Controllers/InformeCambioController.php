<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformeCambio;
use Barryvdh\DomPDF\Facade as PDF;


class InformeCambioController extends Controller
{
    //
    public function get()
    {
      
        $obj = InformeCambio::getInformes();
        if($obj != null){
            return response()->json(['status' => 200,'result' => $obj]);
        }else{
            return response()->json(['status' => 404]);
        }
    }  
    public function store(Request $request)
    {
        $obj =new InformeCambio();
        $obj->descripcion=$request->descripcion;
        $obj->timepo=$request->timepo;
        $obj->costo=$request->costo;     
        $obj->impacto=$request->impacto;     
        $obj->fecha=$request->fecha;     
        $obj->estado=$request->estado;     
        $obj->id_solicitud=$request->id_solicitud;     
        $obj->id_proyecto=$request->id_proyecto;  
        $obj->id_usuario=$request->id_usuario;  
        $obj->save();        
        return response()->json(['status' => 200,'result' => $obj]);  
    }

    public function update(Request $request)
    {      
         try
        {        
            $obj = InformeCambio::find($request->id_informe);
            $obj->estado = $request->estado;           
            $obj->update();
            return response()->json(['status' => 200,'result' => $obj]);
          
        } catch (\Exception $e){   
            return response()->json(['status' => 404,'message'=>$e->getMessage()]);
        }   
    }

    public function View($id_solicitud)
    {
        $obj = InformeCambio::where('id_solicitud',$id_solicitud)->first();
        if($obj){
            return response()->json(['status' => 200,'result' => $obj]);
        }else{
            return response()->json(['status' => 404]);
        }
    }

    public function InformePdf($id_informe)
    {
        $html = InformeCambio::InformePdf($id_informe);          
        $pdf = PDF::loadHTML($html);
        return $pdf->stream();
    }

}
