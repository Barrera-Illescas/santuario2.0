<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class categoriaPortafolio extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias_portafolio')->insert([
            ['nombre' => 'Rescate'],
            ['nombre' => 'Educación'],
            ['nombre' => 'Conservación'],
            ['nombre' => 'Eventos'],
        ]);
    }
}
