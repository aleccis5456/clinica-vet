<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
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

            $cajasDB = Caja::where('owner_id', $admin_id)
                    ->where('pago_estado', '!=', 'pagado')
                    ->get();
            
       
            $caja = session('caja', []);
            $cortar = false;
            if ($cajasDB->count() == 0) {
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
                
                $pago = Pago::where('consulta_id', $cajadb->consulta_id)
                        ->where('owner_id', $admin_id)
                        ->first();
                
                $caja[] = [
                    'consultaId' => $consultadb->id,
                    'cliente' => $cajadb->consulta->mascota->dueno,
                    'mascota' => $cajadb->consulta->mascota,
                    'productos' => $productos,
                    'consulta' => $consultadb,
                    'pagoEstado' => $pago->estado ?? null,
                    'montoTotal' => $cajadb->monto_total,
                    'ownerId' => $admin_id,
                ];
            }
            session(['caja' => $caja]);
        }
    }

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

    public static function check()
    {
        if (!Auth::check()) {
            return redirect('/');
        }
    }
    public static function checkRol($rol, $ownerId): void {
        $permisos = PermisoRol::where('rol_id', $rol)->where('owner_id', $ownerId)->get();
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

    public static function checkPermisos(): void {
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
    public static function caja($ownerId, $consultaId) {
        return Caja::where('owner_id', $ownerId)
            ->where('consulta_id', $consultaId)
            ->where('pago_estado', 'Pendiente')
            ->first();
    }
    /**
     * 
     */
    public static function ownerId(): mixed {
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

    public static function getProductos($ownerId) {
        return Cache::remember('productos', 60, function () use ($ownerId) {
            return Producto::where('owner_id', $ownerId)->get();
        });
    }
    public static function forgetProductos() {
        Cache::forget('productos');
    }

    public static function crearConsulta($consultas, $ownerId, $mascotaId, $fecha, $hora, $estado, $veterinarioId, $codigo, $tipoId){
        try {
            foreach ($consultas as $consulta) {
                if ($consulta->mascota_id == $mascotaId) {
                    if ($consulta->estado != 'Finalizado' && $consulta->estado != 'Cancelado') {
                        return redirect()->route('add.mascota')->with('error', "Ya existe una consulta pendiente para esta mascota, Consulta Pendiente: $consulta->tipo" . " - " . "Fecha:  $consulta->fecha" . " - " . "Codigo: $consulta->codigo");
                    }
                }
            }
            // if ($fecha < now()->format('Y-m-d')) {
            //     if ($hora < now()->format('H:i')) {
            //         return redirect()->route('add.mascota')->with('error', 'La fecha y hora de la consulta no puede ser menor a la fecha y hora actual');
            //     }
            // }

            // if ($fecha != now()->format('Y-m-d') or $hora != now()->format('H:i')) {
            //     $estado = 'Agendado';
            // }
            $consultas = Consulta::where('owner_id', $ownerId)
                                 ->where('estado', 'En consultorio')
                                ->get();                    
            $estado = '';
            if($consultas->count() > 0) {
                $estdo = 'En recepcion';
            }
            $consulta = Consulta::create([
                'mascota_id' => $mascotaId,
                'veterinario_id' => $veterinarioId,
                'fecha' => now()->format('Y-m-d'),
                'tipo_id' => $tipoId,
                'sintomas' => null,
                'diagnostico' => null,
                'tratamiento' => null,
                'notas' => null,
                'hora' => now()->format('H:i'),
                'estado' => !empty($estdo) ? $estado : 'En consultorio',
                'codigo' => $codigo,
                'owner_id' => $ownerId,
            ]);  
            
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
        return $consulta;
    }
}
