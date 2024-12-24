<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Trabajo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
</head>
<body>
    <!-- Navbar con estructura de Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <!-- Menú hamburguesa -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sideNavbar" aria-controls="sideNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

          

            <!-- Sidebar desplegable -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="sideNavbar" aria-labelledby="sideNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="sideNavbarLabel">Menú</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <a class="nav-link" href="{{ route('welcome') }}">
                         <img src="{{ asset('images/iconinicio.png') }}" alt="Inicio" style="width: 30px; height: 30px; margin-right: 10px;">INICIO
                    </a>   
                    <a class="nav-link active" href="{{ route('jobs.create') }}">CREA UN TRABAJO</a>
                    <a class="nav-link" href="{{ route('jobs.myjobs') }}">VER MIS TRABAJOS</a>
                    <a class="nav-link" href="{{ route('jobs.index') }}">VER TRABAJOS</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Formulario -->
    <section class="form-container">
        <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-columns">
                <!-- Columna izquierda -->
                <div class="form-column">
                    <label for="title">Título del Trabajo</label>
                    <input type="text" id="title" name="title" required>

                    <label for="description">Descripción</label>
                    <textarea id="description" name="description" required></textarea>

                    <label for="location">Ubicación</label>
                    <input type="text" id="location" name="location" required>

                    <label for="company_name">Nombre de la Empresa</label>
                    <input type="text" id="company_name" name="company_name" required>
                </div>

                <!-- Columna derecha -->
                <div class="form-column">
                    <label for="salary">Salario</label>
                    <input type="text" id="salary" name="salary">

                    <label for="status">Estado</label>
                    <select id="status" name="status" required>
                        <option value="open">Abierto</option>
                        <option value="closed">Cerrado</option>
                        <option value="pending">Pendiente</option>
                    </select>

                    <label for="image">Imagen (Opcional)</label>
                    <input type="file" id="image" name="image" onchange="previewImage(event)">

                    <div id="image-preview-container">
                        <img id="image-preview" src="" alt="Vista previa de la imagen" />
                    </div>

                    <label for="numero_whatsapp">Número de WhatsApp (Obligatorio)</label>
                    <input type="text" id="numero_whatsapp" name="numero_whatsapp" placeholder="Ingrese el número de WhatsApp" pattern="^9\d{8}$" title="Por favor ingrese un número de teléfono válido" />

                    <button type="submit" class="btn btn-primary">Guardar Trabajo</button>
                </div>
            </div>
        </form>
    </section>

    <script>
        // Función para previsualizar la imagen
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('image-preview');
            const reader = new FileReader();
            reader.onload = function () {
                preview.src = reader.result;
                document.getElementById('image-preview-container').style.display = 'block';
            };
            if (file) {
                reader.readAsDataURL(file);
            }
        }

        // Cierra el menú hamburguesa cuando se hace clic fuera de la barra
        document.addEventListener('click', function(event) {
            const offCanvas = document.getElementById('sideNavbar');
            const toggler = document.querySelector('.navbar-toggler');
            if (!offCanvas.contains(event.target) && !toggler.contains(event.target)) {
                offCanvas.classList.remove('show');
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
