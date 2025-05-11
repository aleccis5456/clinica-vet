<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\PermisoRol;
use App\Models\Permiso;
use App\Models\Consulta;
use App\Models\Producto;
use App\Models\ConsultaProducto;
use App\Models\Pago;
use App\Models\Caja;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Helper
{
    public static function formatearFecha($fecha)
    {
        return Carbon::parse($fecha)->format('d-m-Y');
    }
    public static function formatearMonto($monto)
    {
        return number_format(round($monto, -2), 0, ',', '.');
    }
    public static function edad($fecha)
    {
        return Carbon::parse($fecha)->age;
    }
    public static function total(): int
    {
        $total = 0;
        $cobro = session('cobro');
        foreach ($cobro as &$item) {
            $total += $item['precio'] * $item['cantidad'];
        }
        return $total;
    }
    public static function crearCajas()
    {
        if (Auth::check()) {
            $requestUserId = Auth::user()->id;
            $user = User::find($requestUserId);
            if ($user->admin) {
                $admin_id = $user->id;
            } else {
                $admin_id = $user->admin_id;
            }

            $cajasDB = Caja::where('pago_estado', '!=', 'pagado')
                ->where('owner_id', $admin_id)
                ->get();

            $caja = session('caja', []);
            $cortar = false;
            if ($cajasDB->count() == 0) {
                dd('fs');
                return;
            }


            foreach ($cajasDB as $cajadb) {
                foreach ($caja as $item) {
                    if ($item['consultaId'] == $cajadb->consulta_id) {
                        $cortar = true;
                    }
                }

                if ($cortar) {
                    continue;
                }
                $consultaProductos = ConsultaProducto::where('consulta_id', $cajadb->consulta_id)
                    ->where('owner_id', $admin_id)
                    ->get();
                $productos = [];
                // if($consultaProductos->count() == 0){
                //     continue;
                // }
                foreach ($consultaProductos as $cProducto) {
                    $producto = Producto::where('id', $cProducto->producto_id)
                        ->where('owner_id', $admin_id)->first();
                    $productos[] = [
                        "productoId" => $producto->id,
                        "producto" => $producto->nombre,
                        "cantidad" => $cProducto->cantidad,
                        "precio" => $producto->precio_interno,
                        "owner_id" => $admin_id
                    ];
                    
                }
                $consultadb = Consulta::where('id', $cajadb->consulta_id)
                                        ->where('owner_id', $admin_id)
                                        ->first();
                //dd($consultadb); 
                $pago = Pago::where('pagado', false)
                    ->where('owner_id', $admin_id)
                    ->first();
                $caja[] = [
                    'consultaId' => $consultadb->id,
                    'cliente' => $cajadb->consulta->mascota->dueno,
                    'mascota' => $cajadb->consulta->mascota,
                    'productos' => $productos,
                    'consulta' => $consultadb,
                    'pagoEstado' => $pago->estado,
                    'montoTotal' => $cajadb->monto_total,
                    'ownerId' => $admin_id,
                ];
            }
            session(['caja' => $caja]);
        }
    }

    public static function crearCajas2()
    {
        // Verificar si el usuario es admin y obtener su id
        // Si no es admin, obtener el id del admin al que pertenece
        if (Auth::check()) {
            $requestUserId = Auth::user()->id;
            $user = User::find($requestUserId);
            if ($user->admin) {
                $admin_id = $user->id;
            } else {
                $admin_id = $user->admin_id;
            }
            $pagos = Pago::where('pagado', false)
                ->where('owner_id', $admin_id)
                ->get();
            $caja = session('caja', []);
            $cortar = false;
            $conteo = [];
            foreach ($pagos as $pago) {
                if ($pago->pagado == true) {
                    $conteo[] = $pago;
                    continue;
                }

                // Verificar si el admin tiene una caja abierta
                $cajaDB = Caja::where('owner_id', $admin_id)
                    ->where('pago_estado', 'pendiente')
                    ->get();
                if ($cajaDB->count() > 0) {
                    foreach ($caja as $item) {
                        $item['consultaId'] = $pago->consulta_id ? $cortar = true : $cortar = false;
                    }
                    //para cortar el foreach de pagos         
                    // if ($cortar) {
                    //     continue;
                    // }
                    $consultaProductos = ConsultaProducto::where('consulta_id', $pago->consulta_id)
                        ->where('owner_id', $admin_id)
                        ->get();
                    $productos = [];
                    foreach ($consultaProductos as $cProducto) {
                        $producto = Producto::where('id', $cProducto->producto_id)
                            ->where('owner_id', $admin_id)->first();
                        $productos[] = [
                            "productoId" => $producto->id ?? null,
                            "producto" => $producto->nombre ?? null,
                            "cantidad" => $cProducto->cantidad ?? null,
                            "precio" => $producto->precio_interno ?? null,
                            "owner_id" => $admin_id ?? null
                        ];
                    }
                    foreach ($cajaDB as $cajaItem) {
                        if ($cajaItem->owner_id == $admin_id) {

                            $consultaProductos = ConsultaProducto::where('consulta_id', $cajaItem->consulta_id)
                                ->where('owner_id', $admin_id)
                                ->get();
                            $productos = [];
                            if (!empty($consultaProductos)) {
                                foreach ($consultaProductos as $cProducto) {
                                    $producto = Producto::where('id', $cProducto->producto_id)
                                        ->where('owner_id', $admin_id)->first();
                                    $productos[] = [
                                        "productoId" => $producto->id,
                                        "producto" => $producto->nombre,
                                        "cantidad" => $cProducto->cantidad,
                                        "precio" => $producto->precio_interno,
                                        "owner_id" => $admin_id
                                    ];
                                }
                            }
                            $consultaDB = Consulta::where('id', $cajaItem->consulta_id)
                                ->where('owner_id', $admin_id)
                                ->first();
                            $pagoSumar = 0;
                            foreach ($productos as $producto) {
                                $pagoSumar += $producto['precio'] * $producto['cantidad'];
                            }
                            $pagoSumar += $consultaDB->tipoConsulta->precio;
                            $pago->monto = $pagoSumar;
                            $pago->save();
                            $caja[] = [
                                'consultaId' => $cajaItem->consulta_id,
                                'cliente' => $cajaItem->mascota->dueno,
                                'mascota' => $cajaItem->mascota,
                                'productos' => $productos,
                                'consulta' => $consultaDB,
                                'pagoEstado' => $pago->estado,
                                'montoTotal' => $pagoSumar,
                                'ownerId' => $admin_id,
                            ];
                        }
                    }
                    session(['caja' => $caja]);
                }
            }
            // dd($conteo);
        }
    }
    public static function check()
    {
        if (!Auth::check()) {
            return redirect('/');
        }
    }
    public static function checkRol($rol): void
    {
        $permisos = PermisoRol::where('rol_id', $rol)->get();
        $permisosRol = [];
        foreach ($permisos as $permiso) {
            $permisosRol[] = $permiso->permiso_id;
        }
        $permisos = Permiso::all();
        $permisosUsuario = [];
        foreach ($permisos as $permiso) {
            $permisosUsuario[] = $permiso->id;
        }
        $permisosUsuario = array_intersect($permisosRol, $permisosUsuario);
        session(['permisos' => $permisosUsuario]);
    }
    public static function checkPermisos(): void
    {
        $modulos = session('modulos', []);

        if (Auth::user()) {
            $permisosIds = session('permisos');
            foreach ($permisosIds as $permisoId) {
                if ($permisoId == 1) {
                    $modulos['gestionPaciente'] = true;
                }
                if ($permisoId == 2) {
                    $modulos['consulta'] = true;
                }
                if ($permisoId == 3) {
                    $modulos['caja'] = true;
                }
                if ($permisoId == 4) {
                    $modulos['inventario'] = true;
                }
                if ($permisoId == 5) {
                    $modulos['gestionUsuario'] = true;
                }
                if ($permisoId == 6) {
                    $modulos['reportes'] = true;
                }
                if ($permisoId == 7) {
                    $modulos['alertas'] = true;
                }
            }
            session(['modulos' => $modulos]);
        }
    }
    /**
     * 
     */
    public static function updateEstado($consultaID, $estadoNuevo)
    {
        $consultas = Consulta::all();
        try {
            $consulta = Consulta::find($consultaID);
            $nombre = $consulta->mascota->nombre;
            foreach ($consultas as $consultaC) {
                if ($consultaC->mascota_id == $consulta->mascota_id) {
                    if ($consulta->estado == 'Finalizado' or $consulta->estdo == 'Cancelado' or $consulta->estdo == 'No asistió') {
                        if ($estadoNuevo != 'Finalizado' or $estadoNuevo != 'Cancelado' or $estadoNuevo != 'No asistió') {
                            if ($consulta->estado == 'Finalizado' or $consulta->estdo == 'Cancelado' or $consulta->estdo == 'No asistió') {
                                return redirect()->route('consultas')->with('error', 'No se puede cambiar el estado de una consulta finalizada');
                            }
                            return redirect()->route('consultas')->with('error', 'Ya existe una consulta activa para: ' . "$nombre");
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('consultas')->with('error', 'Error al cambiar el estado de la consulta: ' . $e->getMessage());
        }
        return $estadoNuevo;
    }
    /**
     * 
     */
    public static function caja($ownerId, $consultaId)
    {
        return $caja = Caja::where('owner_id', $ownerId)
            ->when($consultaId, function ($query) use ($consultaId) {
                return $query->where('consulta_id', $consultaId);
            })
            ->where('pago_estado', 'pendiente')
            ->first();
    }
    /**
     * 
     */
    public static function ownerId(): mixed
    {
        $requestUserId = Auth::user()->id;
        $user = User::find($requestUserId);
        if ($user->admin) {
            $admin_id = $user->id;
        } else {
            $admin_id = $user->admin_id;
        }
        if ($admin_id == null) {
            return back()->with('error', 'No tienes permisos para agregar una mascota');
        }
        return $admin_id;
    }
}
