<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registerForm(){
        return view('register');
    }

    public function register(Request $request){
        try {
    
            $request->validate([
                'nombre' => 'required|string|min:3|max:50',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
            ]);
    
    
            $user = User::create([
                'name' => $request->nombre,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
                
            return redirect()->route('index')->with('agregado', 'El registro se completó');
    
        } catch (\Exception $e) {
            
            throw new Exception($e->getMessage());
        }
    }

    public function login(Request $request){
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
            // return redirect()->route('login')->with('warning', 'El correo electrónico no está registrado.');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('warning', 'La contraseña es incorrecta.');
        }

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return redirect()->intended('/');
            //return back();
        } else {
            Auth::logout();
            Session::flush();
            return back()->with('warning', 'Los datos ingresados no coinciden');
        }
    } 
}
