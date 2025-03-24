<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;

class InventarioController extends Controller
{
    public function store(Request $request)
    {        

        try{        
            $request->validate([
                'nombre' => 'required',
                'descripcion' => 'nullable',            
                'categoria' => 'required|exists:categorias,id',            
                'precio' => 'required',            
                'precio_compra' => 'nullable',
                'stock_actual' => 'required',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',            
            ]);

            if ($request->hasFile('foto')) {
                $image_path = $request->file('foto');
                $imageName = time()."$request->nombre" . '.' . $image_path->getClientOriginalExtension();
                $destinationPath = public_path('uploads/productos');
                $image_path->move($destinationPath, $imageName);
            }

            $producto = Producto::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'categoria' => $request->categoria,
                'precio' => $request->precio,
                'precio_compra' => $request->precio_compra,
                'stock_actual' => $request->stock_actual,
                'foto' => $imageName ?? null,
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
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',            
            ]);

            $producto = Producto::find($productoId);

            if ($request->hasFile('foto')) {
                $image_path = $request->file('foto');
                $imageName = time()."$request->nombre" . '.' . $image_path->getClientOriginalExtension();
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
                'categoria' => $request->categoria,
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
}
