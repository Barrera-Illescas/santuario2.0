<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('animales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('edad')->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->unsignedBigInteger('especie_id');
            $table->unsignedBigInteger('corral_id')->nullable();
            $table->unsignedBigInteger('usuario_id');
            $table->integer('estado')->default(1);
            $table->timestamps();

            $table->foreign('especie_id')
                ->references('id')
                ->on('especie')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('corral_id')
                ->references('id')
                ->on('corrales')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('usuario_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animales');
    }
};
