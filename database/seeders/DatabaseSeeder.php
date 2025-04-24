<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CrearSuscripciones::class);
        $this->call(CrearUsuarioSeeder::class);
        $this->call(CrearCategoriasSeeder::class);
        $this->call(CrearEventosEjemplos::class);
    }
}
