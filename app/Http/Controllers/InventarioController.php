<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\User;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class InventarioController extends Controller {
    public function store(Request $request){           
        try{       
            $request->validate([
                'nombre' => 'required',
                'proveedor_id' => 'nullable|exists:proveedores,id',
                'codigo' => 'nullable|unique:productos,codigo',
                'descripcion' => 'nullable',            
                'categoria_id' => 'required|exists:categorias,id',            
                'precio' => 'required',            
                'precio_compra' => 'nullable',
                'stock_actual' => 'required',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',            
            ]);

            if ($request->hasFile('foto')) {
                $image_path = $request->file('foto');
                $imageName = time(). '.' . $image_path->getClientOriginalExtension();
                $destinationPath = public_path('uploads/productos');
                $image_path->move($destinationPath, $imageName);
            }
            $requestUserId = Auth::user()->id;
            $user = User::find($requestUserId);
            if($user->admin){
                $admin_id = $user->id;
            }else{
                $admin_id = $user->admin_id;
            }
            if($admin_id == null){
                return back()->with('error', 'No tienes permisos para agregar una mascota');
            }                                  

            Producto::create([
                'nombre' => $request->nombre,
                'codigo' => $request->flagCodigo ? $this->codigo(6) : ($request->codigo ?? null),
                'proveedor_id' => $request->proveedor_id ?? null,
                'descripcion' => $request->descripcion,
                'categoria_id' => $request->categoria_id,
                'precio' => $request->precio,
                'precio_compra' => $request->precio_compra,
                'stock_actual' => $request->stock_actual,
                'foto' => $imageName ?? null,
                'owner_id' => $admin_id,
                'unidad_medida' => $request->unidades ?? null,
                'cantidad' => $request->cantidad ?? null,
                'precio_interno' => $request->precio_interno ?? null,
            ]);
            
        }catch(\Exception $e){            
            return redirect()->route('inventario')->with('error', $e->getMessage());
        }

        return back()->with('agregado', 'Producto Agregado');
    }

    public function update(Request $request, $productoId) : RedirectResponse {        
        try{
            $request->validate([
                'nombre' => 'required',
                'descripcion' => 'nullable',            
                'categoria' => 'required|exists:categorias,id',            
                'precio' => 'required',            
                'precio_compra' => 'nullable',
                'stock_actual' => 'required',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',            
            ]);

            $producto = Producto::find($productoId);

            if ($request->hasFile('foto')) {
                $image_path = $request->file('foto');
                $imageName = time() . $image_path->getClientOriginalExtension();
                $destinationPath = public_path('uploads/productos');
                $image_path->move($destinationPath, $imageName);
            }
            if (isset($request->deleteFoto) && $producto->foto) {
                $rutaFoto = public_path('uploads/productos/' . $producto->foto);
                
                if (file_exists($rutaFoto)) {
                    unlink($rutaFoto);
                }
            }            

            $producto->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'categoria_id' => $request->categoria,
                'precio' => $request->precio,
                'precio_compra' => $request->precio_compra,
                'stock_actual' => $request->stock_actual,
                'foto' => $imageName ?? (isset($request->deleteFoto) ? null : $producto->foto), 
            ]);
            
        }catch(\Exception $e){
            return redirect()->route('inventario')->with('error', $e->getMessage());
        }

        return back()->with('editado', 'Producto Actualizado');
    }   

    private function codigo($length) : string {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }
}
