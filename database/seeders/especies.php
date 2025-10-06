<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class especies extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('especie')->insert([
            ['nombre' => 'Gallina', 'descripcion' => 'Ave doméstica criada por sus huevos y carne'],
            ['nombre' => 'Cerdo', 'descripcion' => 'Mamífero omnívoro criado para consumo y compostaje'],
            ['nombre' => 'Vaca', 'descripcion' => 'Rumiantes grandes criados por leche y carne'],
            ['nombre' => 'Caballo', 'descripcion' => 'Animal de carga y transporte en zonas rurales'],
            ['nombre' => 'Cabra', 'descripcion' => 'Mamífero ágil criado por leche y carne'],
            ['nombre' => 'Oveja', 'descripcion' => 'Animal lanudo criado por lana y carne'],
            ['nombre' => 'Pato', 'descripcion' => 'Ave acuática criada por huevos y carne'],
            ['nombre' => 'Burro', 'descripcion' => 'Animal de carga resistente y dócil'],
        ]);
    }
}
