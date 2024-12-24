<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contáctanos - Jobstingo</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS personalizado -->
    <link rel="stylesheet" href="{{ asset('css/contactanos.css') }}">

    <!-- Fuentes y otros recursos -->
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Spice&display=swap" rel="stylesheet">

    <script>
        // Función para mostrar u ocultar el campo de pregunta
        function toggleQuestionField() {
            var issue = document.getElementById("issue").value;
            var questionField = document.getElementById("questionField");
            if (issue === "pregunta") {
                questionField.style.display = "block";
            } else {
                questionField.style.display = "none";
            }
        }
    </script>
</head>
<body>

    <!-- Barra de navegación con el icono de regreso al inicio -->
    <nav class="navbar navbar-expand-lg" style="background-color: #5c6bc0;">
        <div class="container-fluid">
            <a href="{{ route('welcome') }}" class="navbar-brand">
                <img src="{{ asset('images/iconinicio.png') }}" alt="Inicio" class="icon-inicio">
            </a>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="contact-form-container">
                    <div class="contact-form">
                        <h3>¿Cómo te podemos ayudar?</h3>

                        <!-- Mensaje de éxito -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Mensaje de error -->
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Formulario de contacto -->
                        <form action="{{ route('send.contact') }}" method="POST" id="contactForm">
                            @csrf

                            <label for="issue">Selecciona una opción:</label>
                            <select name="issue" id="issue" class="form-input" onchange="toggleQuestionField()">
                                <option value="pregunta">Haz una pregunta</option>
                                <option value="problema">Informar algún problema</option>
                                <option value="sugerencia">Sugerir una característica</option>
                            </select>

                            <!-- Campo adicional para la pregunta -->
                            <div id="questionField" style="display: none;">
                                <label for="question">Escribe tu pregunta:</label>
                                <textarea name="question" id="question" class="form-input" rows="4" placeholder="Escribe tu pregunta..."></textarea>
                            </div>

                            <label for="message">¿Qué podemos hacer por usted?</label>
                            <textarea name="message" id="message" class="form-input" rows="4" placeholder="Escribe tu mensaje..."></textarea>

                            <label for="email">Tu correo electrónico:</label>
                            <input type="email" name="email" id="email" class="form-input" required placeholder="Tu correo">

                            <!-- Indicador de carga -->
                            <div id="loadingSpinner" class="d-none text-center my-3">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Enviando...</span>
                                </div>
                                <p>Enviando tu mensaje...</p>
                            </div>

                            <button type="submit" class="form-btn">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Lógica del indicador de carga -->
    <script>
        const form = document.getElementById('contactForm');
        const loadingSpinner = document.getElementById('loadingSpinner');

        form.addEventListener('submit', function () {
            loadingSpinner.classList.remove('d-none'); // Muestra el spinner
            form.querySelector('button[type="submit"]').disabled = true; // Desactiva el botón
        });
    </script>
</body>
</html>
