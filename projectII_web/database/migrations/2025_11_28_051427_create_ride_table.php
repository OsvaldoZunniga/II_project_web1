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
        Schema::create('ride', function (Blueprint $table) {
            $table->integer('idRide')->autoIncrement()->primary();
            $table->integer('idVehiculo')->notNull();
            $table->string('nombre', 100)->notNull();
            $table->string('salida', 150)->notNull();
            $table->string('llegada', 150)->notNull();
            $table->time('hora')->notNull();
            $table->date('fecha')->notNull();
            $table->integer('espacios')->notNull();
            $table->decimal('costo_espacio', 10, 2)->notNull();
            $table->string('estado', 30)->default('Pendiente');
            $table->foreign('idVehiculo', 'fk_ride_vehiculos')->references('idVehiculo')->on('vehiculos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ride');
    }
};
