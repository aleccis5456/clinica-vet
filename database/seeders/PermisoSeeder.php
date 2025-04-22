<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisoSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table('permisos')->insert([            
            'name' => 'gestionPaciente',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('permisos')->insert([            
            'name' => 'consulta',
            'created_at' => now(),
            'updated_at' => now(),
        ]); 
        DB::table('permisos')->insert([            
            'name' => 'caja',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('permisos')->insert([            
            'name' => 'inventario',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('permisos')->insert([            
            'name' => 'gestionUsuario',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('permisos')->insert([            
            'name' => 'reportes',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('permisos')->insert([            
            'name' => 'alertas',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
