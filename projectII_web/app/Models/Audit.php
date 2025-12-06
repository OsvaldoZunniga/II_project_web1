<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Audit extends Model{
        use HasFactory;

        protected $table = 'auditoria';
        protected $primaryKey = 'id';
        public $timestamps = false;

        protected $fillable = [
            'fecha',
            'idUsuario',
            'salida',
            'llegada',
            'cantidadResultados'
        ];
        public $casts = [
            'idUsuario' => 'integer',
            'fecha' => 'datetime',
            'cantidadResultados' => 'integer'
        ];
        public function user(){
            return $this->belongsTo(User::class, 'idUsuario', 'idUsuario');
        }
    }
?>