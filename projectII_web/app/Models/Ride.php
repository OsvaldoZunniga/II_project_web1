<?php
    namespace App\Models;
 
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
 
    class Ride extends Model{
        use HasFactory;
 
        protected $table = 'ride';
        protected $primaryKey = 'idRide';
        public $timestamps = false;

        protected $fillable = [
            'idVehiculo',
            'nombre',
            'salida',
            'llegada',
            'hora',
            'fecha',
            'espacios',
            'costo_espacio',
            'estado'
        ];
        protected $hidden = [];
        protected $casts = [
            'idRide' => 'integer',
            'idVehiculo' => 'integer',
            'nombre' => 'string',
            'salida' => 'string',
            'llegada' => 'string',
            'fecha' => 'date',
            'espacios' => 'integer',
            'costo_espacio' => 'float',
            'estado' => 'string'
        ];
        public function vehicle(){
            return $this->belongsTo(Vehicle::class, 'idVehiculo', 'idVehiculo');
        }

    }    

?>