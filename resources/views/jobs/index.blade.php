<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRABAJOS DISPONIBLES</title>
    <link rel="stylesheet" href="{{ asset('css/job.css') }}">
    <style>
        /* Estilo para el mensaje flotante */
        #tooltipMessage {
            display: none;
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
            z-index: 1000;
        }
    </style>
    <script>
        // Función para mostrar el mensaje de alerta si el usuario no tiene el rol 'buscar-trabajo'
        function handleContactClick(event) {
            // Verificar si el usuario tiene el rol 'dar-trabajo'
            @if(Auth::user()->job_option == 'dar-trabajo')
                event.preventDefault(); // Evita que se abra el enlace

                // Muestra el mensaje flotante
                var tooltipMessage = document.getElementById('tooltipMessage');
                tooltipMessage.style.display = 'block'; // Muestra el mensaje

                // Ocultar el mensaje después de 5 segundos
                setTimeout(function() {
                    tooltipMessage.style.display = 'none';
                }, 5000); // 5000 milisegundos = 5 segundos
            @endif
        }
    </script>
</head>
<body>
    <header>
        <h1>TRABAJOS DISPONIBLES</h1>
    </header>

    <!-- Barra flotante -->
    <nav class="floating-bar">
        <button class="hamburger" id="hamburger-btn">☰</button>
        <div class="menu" id="menu">
            <!-- Icono de inicio -->
            <a href="{{ url('/') }}" class="btn icon-btn">
                <img src="{{ asset('images/iconinicio.png') }}" alt="Inicio" class="icon"> INICIO
            </a>

            <!-- Selector de ordenamiento y formulario de búsqueda -->
            <div class="search-order-container">
                <form method="GET" action="{{ route('jobs.index') }}" class="order-form">
                    <label for="order" class="btn">Ordenar por:</label>
                    <select name="order" id="order" class="btn" onchange="this.form.submit()">
                        <option value="recientes" {{ request('order') == 'recientes' ? 'selected' : '' }}>Más recientes</option>
                        <option value="relevantes" {{ request('order') == 'relevantes' ? 'selected' : '' }}>Relevantes</option>
                    </select>
                </form>

                <form class="search-form" method="GET" action="{{ route('jobs.index') }}">
                    <input type="text" name="search" placeholder="Buscar trabajo" value="{{ request('search') }}" class="search-input">
                    <button type="submit" class="btn">Buscar</button>
                </form>
            </div>

            <!-- Botón para agregar trabajo -->
            <a href="{{ route('jobs.create') }}" class="btn">Agregar trabajo</a>
        </div>
    </nav>

    <!-- Lista de trabajos -->
    <section class="job-list">
        @forelse ($jobs as $job)
            <div class="job-card">
                <div class="job-user">
                    <p>
                        Publicado por: {{ $job->user->name }} 
                        <span class="job-date">{{ $job->created_at->diffForHumans() }}</span>
                    </p>
                </div>
                <div class="job-details">
                    <h3>{{ $job->title }}</h3>
                    <div class="job-image">
                        @if ($job->image)
                            <img src="{{ Storage::url($job->image) }}" alt="Imagen del trabajo">
                        @else
                            <p>Sin imagen</p>
                        @endif
                    </div>
                    <p><strong>Ubicación:</strong> {{ $job->location }}</p>
                    <p><strong>Descripción:</strong> {{ $job->description }}</p>
                    <p><strong>Estado:</strong> {{ ucfirst($job->status) }}</p>

                    <!-- Enlace de WhatsApp siempre visible -->
                    <p><strong>WhatsApp:</strong> 
                        <a href="https://wa.me/{{ $job->numero_whatsapp }}" target="_blank" onclick="handleContactClick(event)">[Contactar]</a>
                    </p>
                </div>
            </div>
        @empty
            <p>No se encontraron trabajos disponibles.</p>
        @endforelse
    </section>

    <!-- Mensaje flotante (inicialmente oculto) -->
    <div id="tooltipMessage">
        Solo los usuarios buscando trabajo pueden contactar.
    </div>

    <script src="{{ asset('js/job.js') }}"></script>
</body>
</html>
