<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run() :void {
        DB::table('users')->insert([
            'name' => 'master',
            'email' => 'master@master.com',
            'admin' => true,
            'admin_id' => null,
            'email_verified_at' => now(),
            'password' => Hash::make('masterpassword23042025MasteR'),
            'rol_id' => 1,
        ]);
    }
}
