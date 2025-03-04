<?php

namespace App\Helpers;

use Carbon\Carbon;

class Helper{    
    public static function formatearFecha($fecha){        
        return Carbon::parse($fecha)->format('d-m-Y');
    }   
    
    public static function formatearMonto($monto){
        return number_format(round($monto, -2), 0, ',', '.');
    }

    public static function edad($fecha){
        return Carbon::parse($fecha)->age;        
    }

}