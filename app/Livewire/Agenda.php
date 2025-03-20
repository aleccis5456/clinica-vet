<?php

namespace App\Livewire;

use App\Models\Evento;
use Livewire\Component;
use Carbon\Carbon;

class Agenda extends Component
{
    public $mes;
    public $anio;
    public $dias = [];
    public $eventos = [];

    public function mount() {
        $this->mes = now()->month;
        $this->anio = now()->year;
        $this->generarCalendario();
    }

    public function generarCalendario() : void {
        $primerDia = Carbon::create($this->anio, $this->mes, 1);
        $ultimoDia = $primerDia->copy()->endOfMonth()->day;
        $inicioSemana = $primerDia->dayOfWeekIso; // 1 = Lunes, 7 = Domingo                
        $this->dias = [];
        $fila = [];        
        // Espacios vacíos antes del primer día
        for ($i = 1; $i < $inicioSemana; $i++) {
            $fila[] = null;
        }

        // Llenar los días con eventos
        for ($dia = 1; $dia <= $ultimoDia; $dia++) {
            $fecha = Carbon::create($this->anio, $this->mes, $dia)->format('Y-m-d');            
            $fila[] = ['dia' => $dia, 'fecha' => $fecha, 'eventos' => $this->obtenerEventos($fecha)];        
            if (count($fila) == 7) {
                $this->dias[] = $fila;
                $fila = [];
            }
        }            
        // Agregar los días restantes para completar la última fila
        while (count($fila) < 7) {
            $fila[] = null;
        }

        $this->dias[] = $fila;
    }

    public function obtenerEventos($fecha)
    {
        return Evento::whereDate('fecha_hora', $fecha)->get();
    }

    public function cambiarMes($cambio)
    {
        $this->mes += $cambio;
        if ($this->mes < 1) {
            $this->mes = 12;
            $this->anio--;
        } elseif ($this->mes > 12) {
            $this->mes = 1;
            $this->anio++;
        }

        $this->generarCalendario();
    }

    public function update(){
        $eventos = Evento::all();

        foreach($eventos as $evento){
            if($evento->fecha_hora < Carbon::now()->format('Y-m-d H:i:s')){
                $evento->delete();
            }
        }        
    }

    public function render()
    {
        return view('livewire.agenda');
    }
}
