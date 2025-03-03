<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;

class MascotaController extends Controller
{
    public function crearMascota(Request $request){        
        $request->validate([
            'dueno_id' => 'required',
            'nombre' => 'required',
            'especie' => 'required',
            'raza' => 'required',
            'nacimiento' => 'required',
            'genero' => 'required',                        
        ]);

        if ($request->hasFile('foto')) {
            $image_path = $request->file('foto');
            $imageName = time()."$request->nombre" . '.' . $image_path->getClientOriginalExtension();
            $destinationPath = public_path('uploads/mascotas');
            $image_path->move($destinationPath, $imageName);
        }
        
        Mascota::create([
            'dueno_id' => $request->dueno_id,
            'nombre' => $request->nombre,
            'especie' => $request->especie,
            'raza' => $request->raza,
            'nacimiento' => $request->nacimiento,
            'genero' => $request->genero,
            'historial_medico' => $request->historial_medico,
            'foto' => $imageName,
        ]);
        
        return redirect()->route('index')->with('agregado', "$request->nombre, se agrego correctamente");        
    }
}
