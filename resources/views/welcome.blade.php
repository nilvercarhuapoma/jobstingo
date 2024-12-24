<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Jobstingo</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS personalizado -->
    <link rel="stylesheet" href="{{ asset('css/welcom.css') }}">
    
    <!-- Fuentes y otros recursos -->
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Spice&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar general -->
    <nav class="navbar navbar-expand-lg" style="background-color: #5c6bc0;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>

            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="background-color: #5c6bc0;">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title text-white" id="offcanvasNavbarLabel">Menú</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-start flex-grow-1">
                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold" aria-current="page" href="{{ route('welcome') }}">Inicio</a>
                        </li>
                        <li class="nav-item"><a class="nav-link text-white fw-bold" href="{{ route('nosotros') }}">Nosotros</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Acción</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('medios') }}">Medios</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('contactanos') }}">Envia un mensaje</a></li>
                            </ul>
                        </li>
                    </ul>

                    <div class="d-flex">
                        @auth
                            <div class="profile-container">
                                <a href="#" class="d-flex align-items-center gap-2" onclick="toggleProfileModal(event)">
                                    <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/acceso.png') }}" alt="Foto de perfil" class="rounded-circle" width="30" height="30">
                                    <span class="profile-name">{{ Auth::user()->name }}</span>
                                </a>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Iniciar sesión</a>
                            <a href="{{ route('register') }}" class="btn btn-light">Registrarse</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Modal flotante del perfil -->
    <div id="profileModal" class="profile-modal">
        <div class="profile-modal-content">
            <span class="close" onclick="toggleProfileModal(event)">&times;</span>
            @if (Auth::check())
                <img src="{{ asset('storage/' . (Auth::user()->profile_picture ?? 'profiles/acceso.png')) }}" alt="Foto de perfil" class="img-fluid rounded-circle">
                <h4>{{ Auth::user()->name }}</h4>
                <p>{{ Auth::user()->email }}</p>
                <p>Rol:{{ Auth::user()->job_option }}</p>
                @include('welcome2')
            @else
                <p>No hay usuario autenticado.</p>
            @endif
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Cerrar sesión</button>
            </form>
            <form action="{{ route('profile') }}" method="GET">
                @csrf
                <button type="submit" class="btn btn-danger">Ver perfil</button>
            </form>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="container mt-5 pt-5">
        <header class="text-center mb-4">
            <h1 class="jobstingo-title">
                <img src="{{ asset('images/iconjob.png') }}" alt="Logo de Jobstingo" class="logo">
                JOBSTINGO
            </h1>
        </header>

        <div class="row align-items-center">
            <div class="col-md-6 text-center">
                <h1 class="mb-3">Bienvenido a Jobstingo</h1>
                <p>¡Tu plataforma para encontrar los mejores trabajos y aplicar fácilmente!</p>

                <form class="d-flex mb-3 mx-auto w-75" action="{{ route('jobs.search') }}" method="GET">
                    <div class="input-group">
        <!-- Campo de búsqueda -->
                         <input type="text" class="form-control" name="query" placeholder="Busca un trabajo" value="{{ request('query') }}" style="background-color: white;">
        
        <!-- Botón de búsqueda -->
                         <button class="btn btn-white border" type="submit" style="background-color: white;">
                             <img src="{{ asset('images/lupa.png') }}" alt="Buscar" style="height: 20px;">
                         </button>
                    </div>
                </form>
                <div class="d-flex flex-column gap-3">
                    @if(Auth::check() && Auth::user()->job_option == 'buscar-trabajo')
                        <button class="btn btn-danger w-75 mx-auto" onclick="verificarPermisoAgregarTrabajo(event)">Agregar trabajo</button>
                        <div id="tooltipMessage" class="tooltip-message mt-2 text-danger" style="display:none;">
                            <small>Si deseas agregar un trabajo cambiate al rol {dar-trabajo}.Para ello cierra sesion.</small>
                        </div>
                    @else
                        <a href="{{ route('jobs.create') }}" class="btn btn-success w-75 mx-auto">Agregar trabajo</a>
                    @endif

                    <a href="{{ route('jobs.index') }}" class="btn btn-outline-secondary w-75 mx-auto">Ver trabajos disponibles</a>
                    @if(Auth::check() && Auth::user()->job_option == 'dar-trabajo')
                        <a href="{{ route('jobs.myjobs') }}" class="btn btn-success w-75 mx-auto">Mis trabajos</a>
                    @else
                    @endif
                </div>
            </div>

            <div class="col-md-6 text-center">
                <img src="{{ asset('images/iconjob4.jpg') }}" alt="Personaje de trabajo" class="img-fluid" style="max-height: 500px; object-fit: contain;">
            </div>
        </div>
    </div>

    @include('welcome2')
    @include('welcome3')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // Función para mostrar el mensaje si el usuario no puede agregar trabajos
     function verificarPermisoAgregarTrabajo(event) {
        event.preventDefault(); // Evita la redirección predeterminada
        var tooltipMessage = document.getElementById('tooltipMessage');
        tooltipMessage.style.display = 'block'; // Muestra el mensaje

        // Después de 7 segundos, ocultar el mensaje
         setTimeout(function() {
            tooltipMessage.style.display = 'none'; // Ocultar el mensaje después de 7 segundos
         }, 5000); // 7000 milisegundos = 7 segundos
        }
    </script>

    <script>
        function toggleProfileModal(event) {
            event.preventDefault();
            const modal = document.getElementById('profileModal');
            modal.classList.toggle('active');
        }
    </script>
</body>
</html>
