<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cronograma;


class CronogramaController extends Controller
{
    //



    public function store(Request $request)
    {
        $obj =new Cronograma();
        $obj->fecha_ini=$request->fecha_ini;
        $obj->fecha_fin=$request->fecha_fin;
        $obj->id_proyecto=$request->id_proyecto;     
        $obj->save();        
        return response()->json(['status' => 200,'result' => $obj]);  
    }

}
