<div class="user-welcome-box mt-5 p-4 rounded shadow-lg">
    @if(Auth::check()) <!-- Verifica si el usuario está autenticado -->
        <h2 class="welcome-heading">¡Hola, {{ Auth::user()->name }}!</h2>
        <p class="welcome-message">¡Bienvenido a <strong>JOBSTINGO</strong>, la plataforma ideal para publicar tus trabajos!</p>

        @if(Auth::user()->job_option == 'dar-trabajo') <!-- Verifica si el usuario tiene la opción 'dar-trabajo' -->
            <div class="dat-trabajo-box">
                <p><strong>¿Estás listo para conseguir personal rápido y añadir tu trabajo?</strong></p>
                <p>¡Pues estás en el lugar correcto! <br> Haz clic en el botón de abajo para publicar tu trabajo y conectar con profesionales.</p>
                <a href="{{ route('jobs.create') }}" class="btn btn-action">Añadir trabajo</a>
            </div>
        @elseif(Auth::user()->job_option == 'buscar-trabajo') <!-- Verifica si el usuario tiene la opción 'buscar-trabajo' -->
            <div class="buscar-trabajo-box">
                <p><strong>¡Hola, {{ Auth::user()->name }}!</strong></p>
                <p>Estás buscando trabajo, ¡ve y explora todos los trabajos disponibles en nuestra plataforma! <br> Encuentra empleo rápido y contáctalos.</p>
                <a href="{{ route('jobs.index') }}" class="btn btn-action">Ver trabajos</a>
            </div>
        @else
            <p>¡Explora las oportunidades disponibles y comienza tu búsqueda hoy mismo!</p>
        @endif
    @else
        <h2 class="welcome-heading">¡Bienvenido a JOBSTINGO!</h2>
        <p>Por favor, inicia sesión para acceder a tu cuenta y explorar las oportunidades disponibles.</p>
    @endif
</div>
