<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Vehicle extends Model{
        use HasFactory;

        protected $table = 'vehiculos';
        protected $primaryKey = 'idVehiculo';
        public $timestamps = false;

        protected $fillable = [
            'idUsuario',
            'placa',
            'color',
            'marca',
            'modelo',
            'anio',
            'capacidad',
            'foto'
        ];
        protected $hidden = [];
        protected $casts = [
            'idVehiculo' => 'integer',
            'idUsuario' => 'integer',
            'placa' => 'string',
            'foto' => 'string'
        ];
        public function user(){
            return $this->belongsTo(User::class, 'idUsuario', 'idUsuario');
        }
    }

?>