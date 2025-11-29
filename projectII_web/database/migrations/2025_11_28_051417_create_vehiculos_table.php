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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->integer('idVehiculo')->autoIncrement()->primary();
            $table->integer('idUsuario')->notNull();
            $table->string('placa', 20)->notNull();
            $table->string('color', 20)->notNull();
            $table->string('marca', 20)->notNull();
            $table->string('modelo', 20)->notNull();
            $table->string('anio', 10)->notNull();
            $table->integer('capacidad')->notNull();
            $table->string('foto', 300)->nullable();
            $table->foreign('idUsuario', 'fk_vehiculos_usuarios')->references('idUsuario')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
