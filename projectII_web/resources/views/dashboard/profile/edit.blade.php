{{-- Formulario para editar perfil de usuario --}}
<div class="container-fluid py-4">
  <div class="row justify-content-center">
    <div class="col-lg-9 col-md-11 col-12">
      <div class="card fondo text-white shadow border-0" style="border-radius: 20px; box-shadow: 0 4px 24px rgba(39, 174, 96, 0.12);">
        <div class="card-body p-4">
          <h2 class="fw-bold mb-4 text-center" style="color: #eaf7d2;">Actualización de datos</h2>

          <div class="mb-3">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-light">
              <i class="fas fa-arrow-left me-2"></i>Volver al Dashboard
            </a>
          </div>

          <ul class="nav nav-tabs mb-4 justify-content-center" id="registroTabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="tab" data-bs-toggle="tab" type="button" role="tab" 
                      style="color: #1A281E; background-color: rgba(255,255,255,0.1);">
                Perfil
              </button>
            </li>
          </ul>

          <div class="tab-content" id="registroTabsContent">
            <div class="tab-pane fade show active" role="tabpanel">
              <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label" style="color: #eaf7d2;">Nombre</label>
                    <input type="text" name="nombre" class="form-control form-control-lg" 
                           value="{{ old('nombre', $profileData['nombre']) }}" required
                           style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label" style="color: #eaf7d2;">Apellido</label>
                    <input type="text" name="apellido" class="form-control form-control-lg" 
                           value="{{ old('apellido', $profileData['apellido']) }}" required
                           style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label" style="color: #eaf7d2;">Fecha de Nacimiento</label>
                    <input type="date" name="nacimiento" class="form-control form-control-lg" 
                           value="{{ old('nacimiento', $profileData['nacimiento']) }}" required
                           style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label" style="color: #eaf7d2;">Correo Electrónico</label>
                    <input type="email" name="correo" class="form-control form-control-lg" 
                           value="{{ old('correo', $profileData['correo']) }}" required
                           style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label" style="color: #eaf7d2;">Teléfono</label>
                    <input type="text" name="telefono" class="form-control form-control-lg" 
                           value="{{ old('telefono', $profileData['telefono']) }}" required
                           style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label" style="color: #eaf7d2;">Fotografía</label>
                  <input type="file" name="fotografia" class="form-control form-control-lg" 
                         accept="image/*"
                         style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
                  @if($profileData['fotografia'])
                    <small class="text-muted d-block mt-1">
                      <i class="fas fa-info-circle me-1"></i>
                      Imagen actual: {{ basename($profileData['fotografia']) }}
                    </small>
                  @endif
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label" style="color: #eaf7d2;">Contraseña</label>
                    <input type="password" name="contrasena" class="form-control form-control-lg" required
                           style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label" style="color: #eaf7d2;">Confirmar Contraseña</label>
                    <input type="password" name="contrasena_confirm" class="form-control form-control-lg" required
                           style="background-color: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.3);">
                  </div>
                </div>

                <div class="d-grid mb-3">
                  <button type="submit" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-save me-2"></i>Actualizar info
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>