<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros - JOBSTINGO</title>
    <link rel="stylesheet" href="{{ asset('css/nosotros.css') }}">
</head>
<body>
    <header>
        <div class="header-container">
            <a href="{{ route('welcome') }}" class="inicio-icon">
                <img src="{{ asset('images/iconinicio.png') }}" alt="Inicio" class="icon">
                <span><H3>INICIO</H3></span>
            </a>
            <div>
                <h1 class="titulo">JOBSTINGO</h1>
                <p class="subtitulo">Plataforma líder para conectar talentos y oportunidades.</p>
            </div>
        </div>
    </header>

    <!-- Contenedor de diapositivas con scroll vertical -->
    <div class="slideshow-container">
        <!-- Diapositiva 1 -->
        <div class="slide">
            <h2>¿Quiénes Somos?</h2>
            <p>En JOBSTINGO, somos una plataforma diseñada para conectar a empleadores con personas que buscan oportunidades laborales. 
            Nuestra misión es simplificar el proceso de búsqueda de trabajo y contratación, creando un espacio accesible y eficiente 
            tanto para empresas como para candidatos.</p>
            <img src="{{ asset('images/introduccion.jfif') }}" alt="Introducción">
        </div>

        <!-- Diapositiva 2 -->
        <div class="slide">
            <h2>Nuestra Visión</h2>
            <p>En JOBSTINGO, creemos en un mundo donde cada persona tenga acceso a un empleo digno y donde las empresas puedan descubrir 
            talentos excepcionales sin barreras. Nuestra visión es ser el puente que transforma la contratación en una experiencia 
            transparente y efectiva para todos.</p>
            <img src="{{ asset('images/vision.jfif') }}" alt="Visión">
        </div>

        <!-- Diapositiva 3 -->
        <div class="slide">
            <h2>Aportamos a la Sostenibilidad</h2>
            <p>Entendemos que el trabajo va más allá del empleo. En JOBSTINGO, apoyamos iniciativas sostenibles promoviendo trabajos 
            en sectores verdes y fomentando prácticas empresariales responsables. Juntos construimos un futuro más sostenible.</p>
            <img src="{{ asset('images/sostenibilidad.png') }}" alt="Sostenibilidad">
        </div>
        @include('welcome3')
    </div>
</body>
</html>
