<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Usuario extends Model{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'idUsuario';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellido',
        'cedula',
        'nacimiento',
        'correo',
        'telefono',
        'fotografia',
        'estado',
        'contrasena',
        'token',
        'idRoles'
    ];
    protected $hidden = [
        'contrasena',
        'token'
    ];
    public $casts = [
        'idUsuario' => 'integer',
        'nacimiento' => 'date',
        'idRoles' => 'integer'
    ];
    public function role(){
        return $this->belongsTo(Roles::class, 'idRoles', 'idRoles');
    }

}