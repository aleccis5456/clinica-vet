<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;
use Exception;

class MascotaController extends Controller
{
    public function crearMascota(Request $request){            
        $request->validate([
            'dueno_id' => 'required',
            'nombre' => 'required',            
            'raza' => 'required',
            'nacimiento' => 'date|required',
            'genero' => 'required',     
            'especie_id' => 'required|exists:especies,id'
        ]);

        if ($request->hasFile('foto')) {
            $image_path = $request->file('foto');
            $imageName = time()."$request->nombre" . '.' . $image_path->getClientOriginalExtension();
            $destinationPath = public_path('uploads/mascotas');
            $image_path->move($destinationPath, $imageName);
        }
        
        try{
            Mascota::create([
                'dueno_id' => $request->dueno_id,
                'nombre' => $request->nombre,            
                'raza' => $request->raza,
                'nacimiento' => $request->nacimiento,
                'genero' => $request->genero,
                'historial_medico' => $request->historial_medico,
                'foto' => $imageName,
                'especie_id' => $request->especie_id
            ]);
        }catch(\Exception $e){
            throw new Exception($e->getMessage());
        }

        
        return redirect()->route('index')->with('agregado', "$request->nombre, se agrego correctamente");        
    }
}
