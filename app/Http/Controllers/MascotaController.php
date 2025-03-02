<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MascotaController extends Controller
{
    public function crearMascota(Request $request){
        $request->validate([
            ''
        ]);
    }
}
