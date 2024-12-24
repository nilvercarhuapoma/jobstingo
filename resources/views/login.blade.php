<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <script>
        // Función para alternar la visibilidad de la contraseña
        function togglePassword() {
            var passwordField = document.getElementById('password');
            var icon = document.getElementById('password-icon');
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.src = "images/iconojo.png"; // Cambiar el ícono cuando la contraseña es visible
            } else {
                passwordField.type = "password";
                icon.src = "images/iconcandado.png"; // Icono original de candado
            }
        }
    </script>
</head>
<body>
    <main>
        <!-- Título de bienvenida en la parte superior -->
        <div class="welcome-text">
            <h1>Iniciar sesión en <span>JOBSTINGO</span></h1>
        </div>
        
        <!-- Mostrar errores de validación -->
        @if ($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <!-- Caja de opciones -->
            <div class="option-box">
                <label for="job-option">¿Qué desea hacer?</label>
                <select id="job-option" name="job-option" required>
                    <option value="dar-trabajo">Dar trabajo</option>
                    <option value="buscar-trabajo">Buscar trabajo</option>
                </select>
            </div>
            
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required aria-describedby="email-help">
            
            <label for="password">Contraseña:</label>
            <div class="password-container">
                <input type="password" id="password" name="password" required aria-describedby="password-help">
                <img src="images/iconcandado.png" alt="Icono Contraseña" class="password-icon" onclick="togglePassword()" id="password-icon" role="button">
            </div>
            
            <button type="submit">Entrar</button>
        </form>

        <!-- Mensaje para usuarios sin cuenta -->
        <div class="no-account">
            <p><em>¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a></em></p>
        </div>
    </main>
</body>
</html>
