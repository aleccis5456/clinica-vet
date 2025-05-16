<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoConsultaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_consultas')->insert([
                'nombre' => '',
                'descripcion' => 'Consulta general para mascotas.',
                'precio' => 50,
                'veces_realizadas' => 0,
                'owner_id' => 1,
            ]);
            
    }
}
