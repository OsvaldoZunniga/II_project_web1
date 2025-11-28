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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->integer('idUsuario')->autoIncrement()->primary();
            $table->string('nombre', 50)->notNull();
            $table->string('apellido', 50)->notNull();
            $table->string('cedula', 20)->unique()->notNull();
            $table->date('nacimiento')->notNull();
            $table->string('correo', 50)->unique()->notNull();
            $table->string('telefono', 20)->notNull();
            $table->string('fotografia', 300)->nullable();
            $table->string('estado', 30)->default('Pendiente');
            $table->string('contrasena', 300)->notNull();
            $table->string('token', 255)->nullable();
            $table->integer('idRoles')->notNull();
            $table->foreign('idRoles', 'fk_usuarios_roles')->references('idRoles')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
