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

    public static function crearCajas(): void{
        $pagos = Pago::all();
        $caja = session('caja', []);
        $cortar = false;

        foreach ($pagos as $pago) {
            if ($pago->pagado) {
                continue;
        }
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

            // Verificar si el admin tiene una caja abierta
            $cajaDB = Caja::where('owner_id', $admin_id)
                            ->where('pago_estado',  'pendiente')
                            ->get();
            if ($cajaDB->count() > 0) {
               
                foreach ($caja as $item) {
                    if ($item['consultaId'] == $pago->consulta_id) {
                        $cortar = true;
                    }
                }
                //para cortar el foreach de pagos         
                if ($cortar) {
                    continue;
                }
                $consultaProductos = ConsultaProducto::where('consulta_id', $pago->consulta_id)->get();
                $productos = [];

                foreach ($consultaProductos as $cProducto) {
                    $producto = Producto::find($cProducto->producto_id);
                    $productos[] = [
                        "productoId" => $producto->id,
                        "producto" => $producto->nombre,
                        "cantidad" => $cProducto->cantidad,
                        "precio" => $producto->precio,
                        "owner_id" => $admin_id
                    ];
                }

                $consulta = Consulta::find($pago->consulta_id);

                $pagoSumar = 0;
                foreach ($productos as $producto) {
                    $pagoSumar += $producto['precio'] * $producto['cantidad'];
                }
                $pagoSumar += $consulta->tipoConsulta->precio;
                $pago->monto = $pagoSumar;
                $pago->save();
                
                $caja[] = [
                    'consultaId' => $pago->consulta_id,
                    'cliente' => $consulta->mascota->dueno,
                    'mascota' => $consulta->mascota,
                    'productos' => $productos,
                    'consulta' => $consulta,
                    'pagoEstado' => $pago->estado,
                    'montoTotal' => $pagoSumar,
                    'ownerId' => $admin_id,
                ];
                session(['caja' => $caja]);
                }
            }
        }
    }

    public static function check() {
        if (!Auth::check()) {
            return redirect('/');
        }
    }

    public static function checkRol($rol): void{
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

    public static function checkPermisos(): void{
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

    public static function updateEstado($consultaID, $estadoNuevo){
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
            //throw new \Exception('Error al cambiar el estado de la consulta: ' . $e->getMessage());
        }
        return $estadoNuevo;
    }
}
