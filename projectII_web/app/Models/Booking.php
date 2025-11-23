<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Booking extends Model{
        use HasFactory;

        protected $table = 'reserva';
        protected $primaryKey = 'idReserva';
        public $timestamps = false;

        protected $fillable = [
            'idRide',
            'idUsuario',
            'estado',
            'fecha'
        ];
        public $casts = [
            'idReserva' => 'integer',
            'idRide' => 'integer',
            'idUsuario' => 'integer',
            'fecha' => 'datetime'
        ];
        public function ride(){
            return $this->belongsTo(Ride::class, 'idRide', 'idRide');
        }
    }
?>