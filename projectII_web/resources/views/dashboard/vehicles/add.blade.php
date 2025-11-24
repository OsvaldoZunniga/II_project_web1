{{-- Formulario para agregar vehículo --}}
<div class="container-fluid py-4">
  <div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
      <div class="card fondo text-white shadow border-0" style="border-radius: 20px;">
        <div class="card-body p-5">
          <h2 class="text-center mb-3 fw-bold" style="color: #eaf7d2;">Registrar Vehículo</h2>
          <p class="text-center mb-4" style="color: #d6e5c0;">Completa la información de tu vehículo.</p>
          
          <form action="{{ route('vehicles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Placa</label>
                <input type="text" name="placa" class="form-control form-control-lg" 
                       value="{{ old('placa') }}" required 
                       style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Color</label>
                <input type="text" name="color" class="form-control form-control-lg" 
                       value="{{ old('color') }}" required
                       style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Marca</label>
                <input type="text" name="marca" class="form-control form-control-lg" 
                       value="{{ old('marca') }}" required
                       style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Modelo</label>
                <input type="text" name="modelo" class="form-control form-control-lg" 
                       value="{{ old('modelo') }}" required
                       style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Año</label>
                <input type="text" name="anio" class="form-control form-control-lg" 
                       value="{{ old('anio') }}" required
                       style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label" style="color: #eaf7d2;">Capacidad de Asientos</label>
                <input type="number" name="capacidad" class="form-control form-control-lg" 
                       min="1" max="10" value="{{ old('capacidad', 1) }}" required
                       style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
              </div>
            </div>
            
            <div class="mb-4">
              <label class="form-label" style="color: #eaf7d2;">Fotografía del Vehículo</label>
              <input type="file" name="foto" class="form-control form-control-lg" 
                     accept="image/*"
                     style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
            </div>
            
            <div class="d-grid mb-3">
              <button type="submit" class="btn btn-outline-light btn-lg">
                <i class="fas fa-save me-2"></i>Registrar Vehículo
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