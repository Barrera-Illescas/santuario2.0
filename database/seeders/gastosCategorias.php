<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class gastosCategorias extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('gastos_categorias')->insert([
            ['nombre' => 'Alimentación'],
            ['nombre' => 'Medicina'],
            ['nombre' => 'Mantenimiento'],
            ['nombre' => 'Servicios'],
        ]);
    }
}
