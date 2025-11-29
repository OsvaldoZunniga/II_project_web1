{{-- Formulario para editar ride --}}
<div class="container-fluid py-4">
  <div class="row justify-content-center">
    <div class="col-lg-10 col-md-12">
      <div class="card fondo text-white shadow border-0" style="border-radius: 20px; box-shadow: 0 4px 24px rgba(39, 174, 96, 0.12);">
        <div class="card-body p-4">
          <h2 class="text-center mb-3 fw-bold" style="color: #eaf7d2;">Editar Ride</h2>
          <p class="text-center mb-4" style="color: #d6e5c0;">Actualiza la información de tu ride.</p>
          
          <div class="mb-3">
            <a href="{{ route('rides.my') }}" class="btn btn-outline-light">
              <i class="fas fa-arrow-left me-2"></i>Volver a Mis Rides
            </a>
          </div>

          <form action="{{ route('rides.update', $ride['idRide']) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Vehículo</label>
                <select name="vehiculo" class="form-control form-control-lg" required
                        style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
                  <option value="">Seleccione un vehículo</option>
                  @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle['idVehiculo'] }}" 
                            {{ $vehicle['idVehiculo'] == $ride['idVehiculo'] ? 'selected' : '' }}
                            style="color: black;">
                      {{ $vehicle['marca'] }} {{ $vehicle['modelo'] }} - {{ $vehicle['color'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Nombre</label>
                <input type="text" name="nombre" class="form-control form-control-lg" 
                       value="{{ $ride['nombre'] }}" required
                       style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Salida</label>
                <input type="text" name="salida" class="form-control form-control-lg" 
                       value="{{ $ride['salida'] }}" required
                       style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Llegada</label>
                <input type="text" name="llegada" class="form-control form-control-lg" 
                       value="{{ $ride['llegada'] }}" required
                       style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Hora</label>
                <input type="time" name="hora" class="form-control form-control-lg" 
                       value="{{ $ride['hora'] }}" required
                       style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Fecha</label>
                <input type="date" name="fecha" class="form-control form-control-lg" 
                       value="{{ $ride['fecha'] }}" required
                       style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Espacios</label>
                <input type="number" name="espacios" class="form-control form-control-lg" 
                       min="1" max="10" value="{{ $ride['espacios'] }}" required
                       style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Precio por Espacio</label>
                <input type="number" name="precio_espacio" class="form-control form-control-lg" 
                       min="1" value="{{ $ride['costo_espacio'] }}" required
                       style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <button type="submit" class="btn btn-outline-light btn-lg w-100">
                  <i class="fas fa-save me-2"></i>Actualizar Ride
                </button>
              </div>
              <div class="col-md-6 mb-3">
                <button type="button" class="btn btn-outline-danger btn-lg w-100" onclick="confirmarEliminar()">
                  <i class="fas fa-trash me-2"></i>Eliminar Ride
                </button>
              </div>
            </div>
          </form>

          <form id="formEliminar" action="{{ route('rides.destroy', $ride['idRide']) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<script>
function confirmarEliminar() {
  if (confirm('¿Estás seguro de que quieres eliminar este ride? Esta acción no se puede deshacer.')) {
    document.getElementById('formEliminar').submit();
  }
}
</script>