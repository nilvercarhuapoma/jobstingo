<!-- resources/views/contact_section.blade.php -->

<div class="contact-section">
    <!-- Información de la empresa y desarrollador -->
    <div class="info-section">
        <p>Diseñado por <strong>Nilver Leimer</strong></p>
        <p>Universidad: <strong>Universidad Nacional Agraria de la Selva (UNAS)</strong></p>
    </div>

    <div class="social-links">
        <a href="https://www.tiktok.com/@nilver_lil0604" target="_blank" class="social-icon">
            <img src="images/tik-tok.png" alt="TikTok">
        </a>
        <a href="https://wa.me/920067138" target="_blank" class="social-icon">
            <img src="images/whatsapp.png" alt="WhatsApp">
        </a>
        <a href="mailto:carhuapomapenanilverleimer@gmail.com" class="social-icon">
            <img src="images/iconemail.png" alt="Email">
        </a>
        <a class="contact-btn" href="{{ route('contactanos') }}">Envia un mensaje</a>

    </div>

   
</div>



<script>
    // Establecer el año dinámicamente
    document.getElementById('year').textContent = new Date().getFullYear();

    // Script para abrir el formulario de contacto
    document.getElementById('contactUsBtn').addEventListener('click', function() {
        document.getElementById('contactFormContainer').classList.toggle('show');
    });
</script>
