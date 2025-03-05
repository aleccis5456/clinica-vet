<?php

namespace App\Http\Controllers;

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
                'descripcion' => 'required',            
                'categoria' => 'required|exists:categorias,id',            
                'precio' => 'required',            
                'precio_compra' => 'required',
                'stock_actual' => 'required',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',            
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
                'foto' => $imageName
            ]);
            
        }catch(\Exception $e){
            throw new Exception($e->getMessage());
        }

        return back()->with('agregado', 'Producto Agregado');
    }
}
