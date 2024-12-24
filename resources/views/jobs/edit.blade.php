<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Trabajo</title>
    <link rel="stylesheet" href="{{ asset('css/editjob.css') }}">
</head>
<body>
    <header>
        <h1>Editar Trabajo</h1>
    </header>

    <section class="form-container">
        <form action="{{ route('jobs.update', $job->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-columns">
                <!-- Columna izquierda -->
                <div class="form-column">
                    <label for="title">Título del Trabajo</label>
                    <input type="text" id="title" name="title" value="{{ $job->title }}" required>

                    <label for="description">Descripción</label>
                    <textarea id="description" name="description" required>{{ $job->description }}</textarea>

                    <label for="location">Ubicación</label>
                    <input type="text" id="location" name="location" value="{{ $job->location }}" required>

                    <label for="company_name">Nombre de la Empresa</label>
                    <input type="text" id="company_name" name="company_name" value="{{ $job->company_name }}" required>
                </div>

                <!-- Columna derecha -->
                <div class="form-column">
                    <label for="salary">Salario</label>
                    <input type="text" id="salary" name="salary" value="{{ $job->salary }}">

                    <label for="status">Estado</label>
                    <select id="status" name="status" required>
                        <option value="open" {{ $job->status == 'open' ? 'selected' : '' }}>Abierto</option>
                        <option value="closed" {{ $job->status == 'closed' ? 'selected' : '' }}>Cerrado</option>
                        <option value="pending" {{ $job->status == 'pending' ? 'selected' : '' }}>Pendiente</option>
                    </select>

                    <!-- Campo para cargar una imagen (si el usuario no desea cambiarla, se mantiene la imagen actual) -->
                    <label for="image">Imagen (opcional)</label>
                    <input type="file" id="image" name="image" onchange="previewImage(event)">

                    <div id="image-preview-container">
                        @if($job->image)
                            <img id="image-preview" src="{{ Storage::url($job->image) }}" alt="Vista previa de la imagen" />
                        @else
                            <p>No se ha cargado ninguna imagen.</p>
                        @endif
                    </div>

                    <!-- Campo para ingresar el número de WhatsApp -->
                    <label for="numero_whatsapp">Número de WhatsApp (opcional)</label>
                    <input type="text" id="numero_whatsapp" name="numero_whatsapp" value="{{ $job->numero_whatsapp }}" placeholder="Ingrese el número de WhatsApp" pattern="^9\d{8}$" title="Por favor ingrese un número de teléfono válido" /> 

                    <!-- Enlace para contactar por WhatsApp -->
                    <label for="whatsapp-link">Contacto por WhatsApp</label>
                    <a href="https://wa.me/{{ $job->numero_whatsapp }}" id="whatsapp-link" target="_blank" class="btn">Contactar por WhatsApp</a>

                    <button type="submit" class="btn">Actualizar Trabajo</button>
                </div>
            </div>
        </form>
    </section>

    <script>
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

        // Modificar el enlace de WhatsApp dinámicamente
        document.getElementById('numero_whatsapp').addEventListener('input', function () {
            const whatsappNumber = this.value.replace(/\D/g, '');  // Eliminar caracteres no numéricos
            const whatsappLink = document.getElementById('whatsapp-link');

            if (whatsappNumber) {
                whatsappLink.href = `https://wa.me/${whatsappNumber}`;
                whatsappLink.style.display = 'inline-block';
            } else {
                whatsappLink.style.display = 'none';
            }
        });
    </script>
</body>
</html>
