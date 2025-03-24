<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GestionUsuarioController extends Controller
{
    public function update(Request $request){
        $request->validate([
            'name' => 'sometimes',
            'email' => 'sometimes',
            'password' => 'sometimes',
            'rol' => 'sometimes',
        ]);
        $user = User::find($request->userId);

        if(Hash::check($request->password, $user->password)){
            return redirect()->back()->with('error', 'La contraseña no puede ser la misma');
        }
        
        $user->update([
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
            'password' => empty($request->password) ? $user->password : Hash::make($request->password),          
            'rol' => $request->rol ?? $user->rol_id,
        ]);

        return redirect()->back()->with('editado', 'Usuario actualizado correctamente');
    }
}
