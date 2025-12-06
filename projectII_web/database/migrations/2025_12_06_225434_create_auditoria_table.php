<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('auditoria')) {
            Schema::create('auditoria', function (Blueprint $table) {
                $table->id();
                $table->date('fecha')->default(DB::raw('(CURRENT_DATE)'));
                $table->integer('idUsuario');
                $table->string('salida', 50);
                $table->string('llegada', 50);
                $table->integer('cantidadResultados');
                
                $table->foreign('idUsuario')->references('idUsuario')->on('usuarios');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auditoria');
    }
};
