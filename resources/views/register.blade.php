<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - JOBSTINGO</title>
    <link rel="stylesheet" href="css/register.css"> <!-- Vincula el archivo CSS -->
</head>
<body>
    <main class="register-container">
        <a href="/" class="back-button">
            <img src="images/iconinicio.png" alt="Volver" class="back-icon">
        </a>

        <h1>Regístrese para acceder a <span>JOBSTINGO</span></h1>
        <form action="{{ route('register') }}" method="POST" onsubmit="return checkForm()">
            @csrf
            <div class="form-columns">
                <!-- Columna de la izquierda -->
                <div class="form-column">
                    <div class="form-group">
                        <label for="name">Nombre(s):</label>
                        <input type="text" id="name" name="name" placeholder="Ingresa tu nombre" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="lastname">Apellido(s):</label>
                        <input type="text" id="lastname" name="lastname" placeholder="Ingresa tu apellido" value="{{ old('lastname') }}" required>
                        @error('lastname')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <div class="input-container">
                            <input type="email" id="email" name="email" placeholder="Ingresa tu email" value="{{ old('email') }}" required>
                            <img src="images/iconemail.png" alt="Icono Email" class="input-icon">
                        </div>
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Columna de la derecha -->
                <div class="form-column">
                    <div class="form-group">
                        <label for="phone">Teléfono:</label>
                        <div class="phone-container">
                            <div class="flag-container">
                                <img src="images/iconbandera.png" alt="Bandera" class="flag-icon">
                                <span>+51</span>
                            </div>
                            <input type="tel" id="phone" name="phone" placeholder="Ingresa tu número" value="{{ old('phone') }}" required>
                        </div>
                        @error('phone')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <div class="input-container">
                            <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                            <img src="images/iconcandado.png" alt="Icono Contraseña" class="input-icon">
                        </div>
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirmar Contraseña:</label>
                        <div class="input-container">
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirma tu contraseña" required>
                            <img src="images/iconcandado.png" alt="Icono Confirmar Contraseña" class="input-icon">
                        </div>
                        @error('password_confirmation')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn-register">Registrarse</button>
        </form>
    </main>
    <script>
        function checkForm() {
            const name = document.getElementById("name").value;
            const lastname = document.getElementById("lastname").value;
            const email = document.getElementById("email").value;
            const phone = document.getElementById("phone").value;
            const password = document.getElementById("password").value;
            const password_confirmation = document.getElementById("password_confirmation").value;
            if (name && lastname && email && phone && password && password_confirmation) {
                return true;
            } else {
                alert("Por favor, complete todos los campos.");
                return false;
            }
           
        }
    </script>
</body>
</html>
