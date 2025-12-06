--Muestra info detallada de un ride haciendo joins 
--en reservas y usuarios para consultar campos y
--saber vehiculo y conductor
SELECT 
    r.idRide,
    r.nombre,
    r.salida,
    r.llegada,
    r.hora,
    r.fecha,
    r.espacios AS espacios_totales,
    r.costo_espacio,
    COUNT(res.idReserva) AS espacios_reservados,
    (r.espacios - COUNT(res.idReserva)) AS espacios_disponibles,
    v.placa,
    v.marca,
    v.modelo,
    v.color,
    u.nombre AS conductor_nombre,
    u.apellido AS conductor_apellido,
    u.telefono AS conductor_telefono
FROM ride r
INNER JOIN vehiculos v ON r.idVehiculo = v.idVehiculo
INNER JOIN usuarios u ON v.idUsuario = u.idUsuario
LEFT JOIN reserva res ON r.idRide = res.idRide
WHERE r.estado = 'Pendiente' 
  
GROUP BY r.idRide
HAVING espacios_disponibles > 0
ORDER BY r.fecha ASC, r.hora ASC;