{{-- Formulario para agregar ride --}}
<div class="container-fluid py-4">
  <div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
      <div class="card fondo text-white shadow border-0" style="border-radius: 20px;">
        <div class="card-body p-5">
          <h2 class="text-center mb-3 fw-bold" style="color: #eaf7d2;">Registrar Ride</h2>
          <p class="text-center mb-4" style="color: #d6e5c0;">Completa la información del ride</p>
          
          <form action="{{ route('rides.store') }}" method="POST">
            @csrf
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Vehículo</label>
                <select name="vehiculo" class="form-control form-control-lg" required
                        style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
                  <option value="">Seleccione un vehículo</option>
                  @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle['idVehiculo'] }}" style="color: black;">
                      {{ $vehicle['marca'] }} {{ $vehicle['modelo'] }} - {{ $vehicle['color'] }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Nombre</label>
                <input type="text" name="nombre" class="form-control form-control-lg" 
                       value="{{ old('nombre') }}" required
                       style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Salida</label>
                <input type="text" name="salida" class="form-control form-control-lg" 
                       value="{{ old('salida') }}" required
                       style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Llegada</label>
                <input type="text" name="llegada" class="form-control form-control-lg" 
                       value="{{ old('llegada') }}" required
                       style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Hora</label>
                <input type="time" name="hora" class="form-control form-control-lg" 
                       value="{{ old('hora') }}" required
                       style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Fecha</label>
                <input type="date" name="fecha" class="form-control form-control-lg" 
                       value="{{ old('fecha') }}" required
                       style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Espacios</label>
                <input type="number" name="espacios" class="form-control form-control-lg" 
                       min="1" max="10" value="{{ old('espacios', 1) }}" required
                       style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Precio por Espacio</label>
                <input type="number" name="precio_espacio" class="form-control form-control-lg" 
                       min="1" value="{{ old('precio_espacio') }}" required
                       style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
              </div>
            </div>
            
            <div class="d-grid mb-3">
              <button type="submit" class="btn btn-outline-light btn-lg">
                <i class="fas fa-save me-2"></i>Registrar Ride
              </button>
            </div>
            
            <div class="text-center">
              <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Volver al Dashboard
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>