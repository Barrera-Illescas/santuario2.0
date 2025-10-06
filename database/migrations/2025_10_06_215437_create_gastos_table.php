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
        Schema::create('gastos', function (Blueprint $table) {
            $table->id();
            $table->string('concepto');
            $table->decimal('monto', 10, 2);
            $table->date('fecha');
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('responsable_id');
            $table->unsignedBigInteger('usuario_id');
            $table->timestamps();

            $table->foreign('categoria_id')
                ->references('id')
                ->on('gastos_categorias')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('responsable_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('gastos');
    }
};
