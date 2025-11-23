<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Roles extends Model{
        use HasFactory;

        protected $table = 'roles';
        protected $primaryKey = 'idRoles';
        public $timestamps = false;

        protected $fillable = [
            'nombreRol'
        ];
        protected $hidden = [];
        protected $casts = [
            'idRoles' => 'integer',
            'nombreRol' => 'string'
        ];
    }
?>