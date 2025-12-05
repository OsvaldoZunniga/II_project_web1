@php
    $usuarios = is_array($usersList) ? $usersList : $usersList->toArray();
@endphp

<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-start h-100">
      <div class="col-12 col-md-11 col-lg-10 col-xl-9 mt-4">
        <div class="card fondo text-white p-4" style="border-radius: 20px; box-shadow: 0 4px 24px rgba(39, 174, 96, 0.12);">
          <h3 class="fw-bold mb-4 text-center" style="color: #eaf7d2;">Usuarios Activos</h3>
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead style="background-color: #2ECC71; color: #fffde8;">
                <tr>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Cédula</th>
                  <th>Correo</th>
                  <th>Rol</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody style="background-color: #fffde8; color: #13281F;">
                @foreach($usuarios as $user)
                <tr>
                  <td>{{ $user['nombre'] }}</td>
                  <td>{{ $user['apellido'] }}</td>
                  <td>{{ $user['cedula'] }}</td>
                  <td>{{ $user['correo'] }}</td>
                  <td>{{ $user['nombreRol'] }}</td>
                  <td>
                    @if($user['estado'] === 'Inactivo' || $user['estado'] === 'Pendiente')
                      <form method="POST" action="{{ route('admin.activate.user', $user['idUsuario']) }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Activar</button>
                      </form>
                    @else
                      <form method="POST" action="{{ route('admin.desactivate.user', $user['idUsuario']) }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Desactivar</button>
                      </form>
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>