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
        Schema::create('portafolios', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('subtitulo')->nullable();
            $table->string('imagen_url')->nullable();
            $table->text('descripcion')->nullable();
            $table->unsignedBigInteger('categoria_id');
            $table->date('fecha_publicacion')->nullable();
            $table->unsignedBigInteger('usuario_id');
            $table->integer('estado')->default(1);
            $table->timestamps();

            $table->foreign('categoria_id')
                ->references('id')
                ->on('categorias_portafolio')
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
        Schema::dropIfExists('portafolios');
    }
};
