<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-center bg-cover">

    <!-- Barra de navegación -->
    <?php include ('../../components/navigationcli.php'); ?>


    <!-- Sección de bienvenida -->
    <section class="flex flex-col items-center justify-center text-center py-20 h-[600px] relative" style="background-image: url('../../styles/img/fondoinicio.jpeg'); background-size: cover; background-position: center;">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div> <!-- Capa de superposición -->
        <div class="relative z-10">
            <h2 class="text-5xl font-bold text-white mb-4">Carne al Fuego</h2>
            <p class="text-2xl text-white">¡Bienvenidos a nuestro restaurante!</p>
        </div>
    </section>
    <!-- Información adicional -->
    <section class="flex flex-col items-center justify-center text-center py-20 h-[600px] relative" style="background-image: url('../../styles/img/Pie.jpeg'); background-size: cover; background-position: center;">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div> <!-- Capa de superposición -->
        <div class="relative z-10 text-white">
            <h3 class="text-4xl font-bold mb-6">Horarios</h3>
            <p class="text-xl mb-8">Lunes a Viernes: 15:00 PM - 23:00 PM</p>
            <p class="text-xl mb-8">Sábado y Domingo: 10:00 AM - 21:00 PM</p>

            <h3 class="text-4xl font-bold mb-6">Contacto</h3>
            <p class="text-xl mb-4">Correo: carnealfuego@gmail.com</p>
            <p class="text-xl mb-4">Teléfono: 0912345678</p>
            <p class="text-xl mb-4">Dirección: Amazonas y, Fernando Roy, Francisco de Orellana</p>

            <div class="flex justify-center space-x-6 mt-8">
                <a href="https://www.facebook.com/carne.al.fuego.2024/" target="_blank" class="text-white">
                    <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22 12.073C22 5.45 17.521.572 12 .572 6.479.572 2 5.45 2 12.073 2 17.536 5.656 22 11 22v-7.114H8.216v-2.813H11V9.154c0-2.743 1.632-4.243 4.12-4.243 1.194 0 2.439.214 2.439.214v2.66h-1.372c-1.353 0-1.768.844-1.768 1.71v2.058h3.005l-.481 2.814H14.42V22C19.344 22 22 17.536 22 12.073z"/>
                    </svg>
                </a>
                <a href="https://x.com/Carnealfuego03" target="_blank" class="text-white">
                    <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23.953 4.569c-.885.392-1.83.656-2.825.775 1.014-.611 1.794-1.574 2.163-2.724-.951.555-2.005.959-3.127 1.184-.897-.959-2.178-1.56-3.594-1.56-2.825 0-5.111 2.292-5.111 5.115 0 .392.045.773.131 1.142C7.688 8.094 4.064 6.13 1.64 3.161c-.427.729-.666 1.574-.666 2.475 0 1.71.869 3.214 2.188 4.096-.807-.026-1.566-.248-2.229-.616v.061c0 2.385 1.693 4.374 3.946 4.827-.416.11-.853.17-1.305.17-.316 0-.624-.031-.927-.089.631 1.953 2.445 3.376 4.604 3.414-1.68 1.319-3.804 2.105-6.107 2.105-.397 0-.79-.023-1.175-.067 2.182 1.402 4.768 2.221 7.557 2.221 9.054 0 14.001-7.5 14.001-14 0-.214-.004-.426-.015-.637.961-.695 1.8-1.56 2.46-2.548l-.047-.02z"/>
                    </svg>
                </a>
                <a href="https://www.instagram.com/carnealfuego03/" target="_blank" class="text-white">
                    <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.343 3.608 1.318.975.975 1.256 2.242 1.318 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.343 2.633-1.318 3.608-.975.975-2.242 1.256-3.608 1.318-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.343-3.608-1.318-.975-.975-1.256-2.242-1.318-3.608C2.175 15.585 2.163 15.204 2.163 12s.012-3.584.07-4.85c.062-1.366.343-2.633 1.318-3.608C4.526 2.675 5.793 2.394 7.16 2.332 8.425 2.274 8.805 2.163 12 2.163zm0-2.163C8.694 0 8.257.013 7.01.07 5.671.128 4.431.383 3.349 1.466 2.267 2.549 2.012 3.789 1.954 5.128 1.897 6.375 1.884 6.812 1.884 12c0 5.188.013 5.625.07 6.872.058 1.339.313 2.579 1.395 3.661 1.083 1.083 2.323 1.328 3.662 1.386C8.256 23.988 8.694 24 12 24s3.744-.012 4.99-.07c1.339-.058 2.579-.313 3.661-1.395 1.083-1.083 1.328-2.323 1.386-3.662.058-1.247.07-1.684.07-6.872s-.013-5.625-.07-6.872c-.058-1.339-.313-2.579-1.395-3.661-1.083-1.083-2.323-1.328-3.662-1.386C15.744.013 15.306 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zm0 10.162a3.994 3.994 0 110-7.988 3.994 3.994 0 010 7.988zm6.406-11.845a1.44 1.44 0 11-2.88 0 1.44 1.44 0 012.88 0z"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

</body>
</html>
