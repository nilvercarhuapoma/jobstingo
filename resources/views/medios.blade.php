<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medios de Comunicación - JOBSTINGO</title>
    <link rel="stylesheet" href="{{ asset('css/medios.css') }}">
</head>
<body>
    <header>
        <div class="header-container">
            <a href="{{ route('welcome') }}" class="inicio-icon">
                <img src="{{ asset('images/iconinicio.png') }}" alt="Inicio" class="icon">
                <span>Inicio</span>
            </a>
            <div>
                <h1 class="titulo">JOBSTINGO</h1>
                <p class="subtitulo">Plataforma líder para conectar talentos y oportunidades.</p>
            </div>
        </div>
    </header>

    <!-- Sección de medios de comunicación -->
    <div class="slideshow-container">
        <!-- WhatsApp -->
        <div class="slide">
            <div class="media-icon">
                <img src="{{ asset('images/whatsapp.png') }}" alt="WhatsApp" class="icon">
            </div>
            <h2>WhatsApp</h2>
            <p>Si quieres ver más sobre nosotros, no dudes en enviarnos un mensaje a nuestro WhatsApp. Estaremos encantados de atenderte.</p>
            <a href="https://wa.me/920067138" class="contact-btn">Enviar mensaje</a>
        </div>

        <!-- TikTok -->
        <div class="slide">
            <div class="media-icon">
                <img src="{{ asset('images/tik-tok.png') }}" alt="TikTok" class="icon">
            </div>
            <h2>TikTok</h2>
            <p>Aquí puedes encontrar más información sobre nuestra plataforma y videos cortos que te mostrarán todo lo que hacemos.</p>
            <a href="https://www.tiktok.com/@nilver_lil0604" class="contact-btn">Ver videos</a>
        </div>

        <!-- Correo -->
        <div class="slide">
            <div class="media-icon">
                <img src="{{ asset('images/iconemail.png') }}" alt="Correo" class="icon">
            </div>
            <h2>Correo</h2>
            <p>Puedes enviarnos un mensaje directamente a nuestro correo, y estaremos encantados de responderte.</p>
            <a href="{{ route('contactanos') }}" class="contact-btn">Envia un mensaje</a>
        </div>
    </div>

    <script>
        // Si necesitas JavaScript para interactuar con las diapositivas, puedes agregarlo aquí.
    </script>
</body>
</html>
