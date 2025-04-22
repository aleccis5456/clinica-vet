<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PermisoRol;
use App\Models\Rol;
use App\Models\Permiso;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    public function registerForm() {
        return view('register');
    }

    public function register(Request $request) {
        $request->validate([
            'nombre' => 'required|string|min:3|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ], [
            'nombre.required' => 'Rellene el campo nombre',
            'nombre.string' => 'El nombre debe ser una cadena de texto',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres',
            'nombre.max' => 'El nombre no puede tener más de 50 caracteres',
            'email.required' => 'Rellene el campo email',
            'email.email' => 'Ingrese un email valido',
            'email.unique' => 'El correo electrónico ya está registrado',
            'password.required' => 'Por favor, ingrese su contraseña',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres'
        ]);

        $user = User::create([
            'name' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol_id' => $request->admin_user ? 1 : null,
            'admin' => true,
            'admin_id' => null,
        ]);

        foreach (Permiso::all() as $permiso) {
            PermisoRol::create([
                'rol_id' => $user->rol_id,
                'permiso_id' => $permiso->id,
            ]);
        }

        return redirect()->route('index')->with('agregado', 'El registro se completó');
    }

    public function login(Request $request) {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'Rellene el campo email',
                'email.email' => 'Ingrese un email valido',
                'password' => 'Hay un error con tu contraseña',
                'password.required' => 'Por favor, ingrese su contraseña'
            ]
        );

        $credentials = $request->only('email', 'password');

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('warning', 'El correo electrónico no está registrado.');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('warning', 'La contraseña es incorrecta.');
        }

        if (Auth::attempt($credentials)) {
            Auth::user();
            return redirect()->intended('/');
        } else {
            Auth::logout();
            Session::flush();
            return back()->with('warning', 'Los datos ingresados no coinciden');
        }
    }
}
