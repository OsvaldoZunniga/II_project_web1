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
        Schema::create('reserva', function (Blueprint $table) {
            $table->integer('idReserva')->autoIncrement()->primary();
            $table->integer('idRide')->notNull();
            $table->integer('idUsuario')->notNull();
            $table->string('estado', 20)->notNull()->default('Pendiente');
            $table->dateTime('fecha')->default(DB::raw('(CURRENT_DATE)'));
            $table->foreign('idUsuario', 'fk_reserva_usuarios')->references('idUsuario')->on('usuarios');
            $table->foreign('idRide', 'fk_reserva_ride')->references('idRide')->on('ride');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserva');
    }
};
