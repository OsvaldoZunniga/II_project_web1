<?php

    namespace App\Services;
     use App\Models\Audit;
     use App\Models\User;

    class AuditService
    {
        /*
        Guardar auditoria de busqueda de rides        
            - Fecha de búsqueda
            - Nombre del usuario que realizó la búsqueda
            - Filtros aplicados (origen, destino)
            - Cantidad de resultados obtenidos
        */
        public function guardarAuditoriaBusqueda($user, $filtros, $rides)
        {
            $cantidadResultados = $rides->count();
            $fechaBusqueda = now();
            $salida = $filtros['salida'] ?? 'N/A';
            $llegada = $filtros['llegada'] ?? 'N/A';

            // insertar registro de auditoria
            Audit::create([
                'fecha' => $fechaBusqueda,
                'idUsuario' => $user['idUsuario'],
                'salida' => $salida,
                'llegada' => $llegada,
                'cantidadResultados' => $cantidadResultados
            ]);

        }
        //Obtiene datos de auditoria con usuario relacionado
        public function getAuditData()
        {
            return Audit::with('user')->get();           
        }
            
    }
?>