<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class metodoPago extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('metodos_pagos')->insert([
            ['nombre' => 'Efectivo'],
            ['nombre' => 'Transferencia Bancaria'],
            ['nombre' => 'PayPal'],
            ['nombre' => 'Tarjeta de Crédito'],
        ]);
    }
}
