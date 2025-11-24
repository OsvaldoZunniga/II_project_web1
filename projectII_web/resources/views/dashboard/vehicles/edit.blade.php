{{-- Formulario para editar vehículo --}}
<div class="container-fluid py-4">
  <div class="row justify-content-center">
    <div class="col-lg-10 col-md-12">
      <div class="card fondo text-white shadow border-0" style="border-radius: 20px; box-shadow: 0 4px 24px rgba(39, 174, 96, 0.12);">
        <div class="card-body p-4">
          <h2 class="fw-bold mb-4 text-center" style="color: #eaf7d2;">Editar Vehículo</h2>
          <p class="text-center mb-4" style="color: #d6e5c0;">Actualiza la información de tu vehículo.</p>
          
          <div class="mb-3">
            <a href="{{ route('vehicles.my') }}" class="btn btn-outline-light">
              <i class="fas fa-arrow-left me-2"></i>Volver a Mis Vehículos
            </a>
          </div>
          
          <form action="{{ route('vehicles.update', $vehicle['idVehiculo']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Placa</label>
                <input type="text" name="placa" class="form-control form-control-lg" 
                       value="{{ old('placa', $vehicle['placa']) }}" required 
                       style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Color</label>
                <input type="text" name="color" class="form-control form-control-lg" 
                       value="{{ old('color', $vehicle['color']) }}" required
                       style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Marca</label>
                <input type="text" name="marca" class="form-control form-control-lg" 
                       value="{{ old('marca', $vehicle['marca']) }}" required
                       style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Modelo</label>
                <input type="text" name="modelo" class="form-control form-control-lg" 
                       value="{{ old('modelo', $vehicle['modelo']) }}" required
                       style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Año</label>
                <input type="number" name="anio" class="form-control form-control-lg" 
                       value="{{ old('anio', $vehicle['anio']) }}" required
                       style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Capacidad de Asientos</label>
                <input type="number" name="capacidad" class="form-control form-control-lg" 
                       min="1" max="10" value="{{ old('capacidad', $vehicle['capacidad']) }}" required
                       style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
              </div>
            </div>
            
            <div class="mb-4">
              <label class="form-label" style="color: #eaf7d2;">Cambiar Fotografía (opcional)</label>
              <input type="file" name="foto" class="form-control form-control-lg" 
                     accept="image/*"
                     style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
              @if($vehicle['foto'])
                <small class="text-muted d-block mt-1">
                  <i class="fas fa-info-circle me-1"></i>
                  Imagen actual: {{ basename($vehicle['foto']) }}
                </small>
              @endif
            </div>
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <button type="submit" class="btn btn-outline-light btn-lg w-100">
                  <i class="fas fa-save me-2"></i>Actualizar Vehículo
                </button>
              </div>
              <div class="col-md-6 mb-3">
                <button type="button" class="btn btn-outline-danger btn-lg w-100" onclick="confirmarEliminar()">
                  <i class="fas fa-trash me-2"></i>Eliminar Vehículo
                </button>
              </div>
            </div>
          </form>

          {{-- Formulario oculto para eliminar --}}
          <form id="formEliminar" action="{{ route('vehicles.destroy', $vehicle['idVehiculo']) }}" method="POST" style="display: none;">
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
  if (confirm('¿Estás seguro de que quieres eliminar este vehículo? Esta acción eliminará también todos los rides y reservas asociadas. Esta acción no se puede deshacer.')) {
    document.getElementById('formEliminar').submit();
  }
}
</script>