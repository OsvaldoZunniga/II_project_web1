<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-start h-100">

      <div class="col-12 col-md-11 col-lg-10 col-xl-9">
        <div class="card fondo" style="border-radius: 1rem;">
          <div class="card-body p-5">

            <h2 class="fw-bold mb-4 text-center">Registrar Administrador</h2>
            <p class="text-center mb-4">Completa la información para crear una cuenta administrativa.</p>

            <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="idRoles" value="3">

                <div class="row">
                    <div class="col-md-6 mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control form-control-lg" required>
                    </div>
                    <div class="col-md-6 mb-3">
                    <label class="form-label">Apellido</label>
                    <input type="text" name="apellido" class="form-control form-control-lg" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                    <label class="form-label">Cédula</label>
                    <input type="text" name="cedula" class="form-control form-control-lg" required>
                    </div>
                    <div class="col-md-6 mb-3">
                    <label class="form-label">Fecha de Nacimiento</label>
                    <input type="date" name="nacimiento" class="form-control form-control-lg" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" name="correo" class="form-control form-control-lg" required>
                    </div>
                    <div class="col-md-6 mb-3">
                    <label class="form-label">Teléfono</label>
                    <input type="text" name="telefono" class="form-control form-control-lg" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fotografía</label>
                    <input type="file" name="fotografia" class="form-control form-control-lg" accept="image/*">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="contrasena" class="form-control form-control-lg" required>
                    </div>                
                    <div class="col-md-6 mb-3">
                    <label class="form-label">Confirmar Contraseña</label>
                    <input type="password" name="contrasena_confirm" class="form-control form-control-lg" required>
                    </div>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-outline-light btn-lg">Registrar Administrador</button>
                </div>

            </form>

          </div>
        </div>
      </div>      
    </div>
  </div>