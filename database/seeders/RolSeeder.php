<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Rol;

class RolSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table('roles')->insert([
            'name' => 'admin',
            'owner_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
