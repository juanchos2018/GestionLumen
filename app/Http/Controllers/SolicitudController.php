<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Solicitud;
//use Barryvdh\DomPDF\Facade\Pdf;

class SolicitudController extends Controller
{
    
    public function SolictudesJefe($id_jefe)
    {
      
        $obj = Solicitud::SolictudesJefe($id_jefe);
        if($obj != null){
            return response()->json(['status' => 200,'result' => $obj]);
        }else{
            return response()->json(['status' => 404]);
        }
    }  

    public function Store(Request $request)
    {   
        // $this->validate($request, [
        //     'objetivo' => 'required',
        // ]);    
        try
        {                  
            $obj = new Solicitud();
            $obj->fecha=$request->fecha;   
            $obj->objetivo=$request->objetivo;   
        
            $obj->estado=$request->estado;   
            $obj->mensaje=$request->mensaje;  
            $obj->descripcion=$request->descripcion;   
            $obj->estado="Enviado";   
            $obj->estado2="Nuevo";   
            $obj->id_proyecto=$request->id_proyecto;   
            $obj->id_usuario=$request->id_usuario;   
            $obj->id_jefe=$request->id_jefe;   
            $obj->id_fase=$request->id_fase;   
            $obj->id_elemento=$request->id_elemento;

            $obj->save();
            $id_solicitud=$obj->id_solicitud;

            return response()->json(['status' => 200,'result' => $id_solicitud,'message' => "Registrado"]);
            
          
        } catch (\Exception $e){   
            return response()->json(['status' => 404,'message'=>$e->getMessage()]);
        } 
    }

    public function Update(Request $request)
    {
        // $this->validate($request, [
        //     'id_solicitud' => 'required',
        //     'linkdocumento' => 'required',
        // ]);
         try
        {        
            $obj = Solicitud::find($request->id_solicitud);
            $obj->linkdocumento = $request->linkdocumento;           
            $obj->update();
            return response()->json(['status' => 200,'result' => $obj]);
          
        } catch (\Exception $e){   
            return response()->json(['status' => 404,'message'=>$e->getMessage()]);
        }   
    }


    public function ExportPDF($id_solicitud)
    {
        $html = Solicitud::SolicitudPdf($id_solicitud);          
        $pdf = PDF::loadHTML($html);
        return $pdf->stream();
    }

}
