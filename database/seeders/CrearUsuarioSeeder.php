<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CrearUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = 'admin';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('Seiscerotres1$');
        $user->timestamps = now();
        $user->save();
    }
}
