<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;
use Exception;

class MascotaController extends Controller
{
    public function crearMascota(Request $request){                  
        try{            
            $request->validate([
                'dueno_id' => 'required',
                'nombre' => 'required',                        
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
                
            Mascota::create([
                'dueno_id' => $request->dueno_id,
                'nombre' => $request->nombre,            
                'raza' => $request->raza,
                'nacimiento' => $request->nacimiento,
                'genero' => $request->genero,
                'historial_medico' => $request->historial_medico,
                'foto' => $imageName ?? null,
                'especie_id' => $request->especie_id
            ]);
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }

        
        return redirect()->route('add.mascota')->with('agregado', "$request->nombre, se agrego correctamente");        
    }

    public function editSave(Request $request){                      
        try{
            $request->validate([
                'dueno_id' => 'sometimes',
                'nombre' => 'sometimes',            
                'raza' => 'sometimes',
                'nacimiento' => 'sometimes',
                'genero' => 'sometimes',     
                'especie_id' => 'sometimes'
            ]);
        }catch(\Exception $e){
            throw new Exception($e->getMessage());
        }
        
        $mascota = Mascota::find($request->mascotaId);
        if(!$mascota){
            return back();
        }

        if ($request->hasFile('foto')) {
            $image_path = $request->file('foto');
            $imageName = time()."$request->nombre" . '.' . $image_path->getClientOriginalExtension();
            $destinationPath = public_path('uploads/mascotas');
            $image_path->move($destinationPath, $imageName);
        }        

        try{
            $mascota->update([
                'dueno_id' => $request->dueno_id ?? $mascota->dueno_id,
                'nombre' => $request->nombre ?? $mascota->nombre,
                'raza' => $request->raza ?? $mascota->raza,
                'nacimiento' => $request->nacimiento ?? $mascota->nacimiento,
                'genero' => $request->genero ?? $mascota->genero,
                'historial_medico' => $request->flagEliminarHM == true ? null : ($request->historial_medico == null ? null : $mascota->historial_medico .' - '. $request->historial_medico),
                'foto' => $request->flagElimiarFoto == true ? null : ($request->hasFile('foto') ? $imageName : $mascota->foto),
                'especie_id' => $request->especie_id ?? $mascota->especie_id
            ]);
            $mascota->save();
        }catch(\Exception $e){
            throw new Exception($e->getMessage());
        }

        return back()->with('editado', "Datos de la Mascota Actualizados");
    }
}
