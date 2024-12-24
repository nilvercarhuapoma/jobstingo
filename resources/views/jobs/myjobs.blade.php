<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Trabajos</title>
    <link rel="stylesheet" href="{{ asset('css/myjobs.css') }}">
    <style>
        /* Estilos para el mensaje flotante */
        .confirmation-popup {
            display: none;
            position: fixed; /* Cambiado a fixed para mejor responsividad */
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 10;
            max-width: 90%; /* Adaptable a pantallas pequeñas */
            width: auto;
            text-align: center;
        }
        .confirmation-popup button {
            margin: 5px;
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            border-radius: 3px;
            font-size: 14px;
        }
        .confirmation-popup button.confirm {
            background-color: red;
            color: white;
        }
        .confirmation-popup button.cancel {
            background-color: gray;
            color: white;
        }
        .delete-form {
            position: relative;
        }
    </style>
</head>
<body>

    <header>
        <h1>Mis Trabajos</h1>
        <a href="{{ route('jobs.create') }}" class="btn">Crear Nuevo Trabajo</a>
    </header>

    <section class="job-list">
        @foreach ($jobs as $job)
            <div class="job-card">
                <div class="job-details">
                    <h3>{{ $job->title }}</h3>
                    @if ($job->image)
                        <img src="{{ Storage::url($job->image) }}" alt="Imagen del trabajo" class="job-image">
                    @endif
                    <p><strong>Descripción:</strong> {{ $job->description }}</p>
                    <p><strong>Ubicación:</strong> {{ $job->location }}</p>
                    <p><strong>Estado:</strong> {{ $job->status }}</p>
                    <p><strong>WhatsApp:</strong> <a href="https://wa.me/{{ $job->numero_whatsapp }}" target="_blank">{{ $job->numero_whatsapp }}</a></p>
                </div>
                <div class="job-actions">
                    <a href="{{ route('jobs.edit', $job->id) }}" title="Editar trabajo">
                        <img src="{{ asset('images/edit.png') }}" alt="Editar">
                    </a>
                    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="delete-btn">
                            <img src="{{ asset('images/delete.png') }}" alt="Eliminar">
                        </button>
                        <div class="confirmation-popup">
                            <p>¿Estás seguro que deseas eliminar?</p>
                            <button type="submit" class="confirm">Sí</button>
                            <button type="button" class="cancel">No</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </section>

    <script>
        // JavaScript para mostrar y ocultar el mensaje de confirmación
        document.addEventListener("DOMContentLoaded", () => {
            const deleteButtons = document.querySelectorAll(".delete-btn");

            deleteButtons.forEach((button) => {
                const form = button.closest(".delete-form");
                const popup = form.querySelector(".confirmation-popup");
                const cancelBtn = popup.querySelector(".cancel");

                button.addEventListener("click", (e) => {
                    // Centrar el mensaje flotante en la pantalla
                    const viewportWidth = window.innerWidth;
                    const viewportHeight = window.innerHeight;

                    popup.style.display = "block";
                    popup.style.top = `${(viewportHeight - popup.offsetHeight) / 2}px`;
                    popup.style.left = `${(viewportWidth - popup.offsetWidth) / 2}px`;
                });

                cancelBtn.addEventListener("click", () => {
                    popup.style.display = "none";
                });
            });
        });
    </script>

</body>
</html>
