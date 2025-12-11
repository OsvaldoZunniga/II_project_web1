<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login AventonesCR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}?v=2">
</head>
<body>
    <!-- Alertas que muestra diferentes mensajes según lo que se reciba en la URL -->
    @if($message || session('msg'))
        @php
            $msg = $message ?? session('msg');
        @endphp
        <div class="container mt-3">
            @if($msg == 'pending')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Tu cuenta está pendiente de activación. Revisa tu correo para activarla.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif($msg == 'activated')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Tu cuenta ha sido activada correctamente. Ahora puedes iniciar sesión.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif($msg == 'inactive')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Tu cuenta está inactiva. Contacta al administrador.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif($msg == 'invalid')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Enlace inválido o cuenta ya activada.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif($msg == 'user_not_found')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Usuario no encontrado.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif($msg == 'wrong_pass')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Contraseña incorrecta.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif($msg == 'passwrd_!match')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Las contraseñas no coinciden.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif($msg == 'img_upload_error')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Error al subir la imagen. Por favor, intenta de nuevo.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif($msg == 'logout_success')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    Has cerrado sesión exitosamente. ¡Hasta pronto!
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif($msg == 'link_sent')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-envelope me-2"></i>
                    Te hemos enviado un link de acceso a tu correo electrónico. Revisa tu bandeja de entrada.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif($msg == 'invalid_token')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    El link de acceso es inválido o ya fue utilizado.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif($msg == 'token_expired')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    El link de acceso ha expirado. Solicita un nuevo link.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif($msg == 'inactive_account')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Tu cuenta no está activa. Contacta al administrador.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif($msg == 'email_error')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Error al enviar el correo electrónico. Intenta de nuevo más tarde.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @elseif($msg == 'login_success')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    ¡Bienvenido! Has iniciado sesión correctamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>
    @endif

    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card fondo text-white" style="width:400px; padding:2.5rem 2rem;">
            
            <h2 class="text-center mb-3 fw-bold">BIENVENIDO</h2>
            <p class="text-center mb-4 text-white-50">Inicia sesión aquí</p>
            <form action="{{ route('login.process') }}" method="POST">
                @csrf
                <input type="email" name="correo" class="form-control mb-3" placeholder="Email" required />
                <input type="password" name="contrasena" class="form-control mb-3" placeholder="Contraseña" required />
                <button class="btn btn-outline-light" type="submit">Iniciar Sesión</button>
            </form>
            
            <!-- Passwordless Login -->
            <div class="mt-3 text-center">
                <button type="button" class="btn btn-link text-white-50 p-0" data-bs-toggle="modal" data-bs-target="#passwordlessModal">
                    📧 Enviarme link de Login
                </button>
            </div>
            
            <div class="mt-4">
                <p class="mb-2">¿No tienes una cuenta? <a href="{{ route('register') }}" class="text-white-50 fw-bold">Regístrate aquí</a></p>
                <p class="mb-0 text-center"><a href="{{ route('public.rides') }}" class="text-white-50 fw-bold"><i class="fas fa-eye me-1"></i>Ver Rides Disponibles</a></p>
            </div>
        </div>
    </div>

    <!-- Modal Passwordless Login -->
    <div class="modal fade" id="passwordlessModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">Acceso sin contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('passwordless.send') }}" method="POST">
                        @csrf
                        <p class="text-dark mb-3">Te enviaremos un link especial a tu correo para que puedas ingresar sin contraseña:</p>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Tu email" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar Link de Acceso</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>