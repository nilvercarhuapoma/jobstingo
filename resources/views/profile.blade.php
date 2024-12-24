<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet"> <!-- Estilos personalizados -->
    <script>
        // JavaScript para manejar la apertura y cierre del modal
        function closeProfilePage() {
            window.location.href = "{{ route('welcome') }}"; // Redirigir a la página principal o cualquier página deseada
        }
    </script>
</head>
<body>
    <!-- Contenedor de perfil -->
    <div class="profile-container">
        <!-- Ícono de regreso a inicio -->
        <div class="back-to-home">
            <a href="{{ route('welcome') }}">
                <img src="{{ asset('images/iconinicio.png') }}" alt="Inicio" class="back-icon">
            </a>
        </div>
        
        <div class="profile-header text-center">
            <h4>¡Bienvenido, {{ Auth::user()->name }}!</h4>
            <!-- Foto de perfil -->
            <img src="{{ asset('storage/' . (Auth::user()->profile_picture ?? 'profiles/acceso.png')) }}" alt="Foto de perfil" class="img-fluid rounded-circle">
        </div>

        <!-- Formulario para actualizar la foto -->
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="profile_picture">Cambiar foto de perfil:</label>
            <input type="file" name="profile_picture" id="profile_picture" accept="image/*" class="form-control">
            <button type="submit" class="btn btn-primary mt-2">Actualizar foto</button>
        </form>


        <!-- Información del perfil -->
        <div class="profile-info mt-3">
            <p>Nombre: {{ Auth::user()->name }}</p>
            <p>Email: {{ Auth::user()->email }}</p>
           <!--<p>Teléfono: {{ Auth::user()->phone }}</p>-->
            <p>Rol: {{ Auth::user()->job_option }}</p>
        </div>

        <!-- Descripción del rol -->
        <div class="role-description mt-3">
            @if(Auth::user()->job_option == 'dar-trabajo')
                <div class="role-box" style="background-color: #4CAF50; color: black;">
                    <p>¡Tu rol es de dar trabajo! Tienes la oportunidad de ofrecer trabajos a diferentes usuarios y conseguir personas interesadas de manera rápida.</p>
                </div>
            @elseif(Auth::user()->job_option == 'buscar-trabajo')
                <div class="role-box" style="background-color: #2196F3; color: black;">
                    <p>¡Hola, {{ Auth::user()->name }}! Tu rol te permitirá ver trabajos disponibles y buscar nuevas oportunidades. Podrás contactarte de manera rápida con los empleadores.</p>
                </div>
            @endif
        </div>

        <!-- Botón para cerrar sesión -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger mt-3">Cerrar sesión</button>
        </form>
    </div>
</body>
</html>
