<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoUsuario;


class TipoUsuarioController extends Controller
{
    //

    public function get()
    {
        return TipoUsuario::get();
    }

  
}
