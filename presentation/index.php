<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$userId = $_SESSION['user']['id']; // Asegúrate de que esta línea obtiene correctamente el ID del usuario desde la sesión
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@latest/dist/tailwind.min.css" rel="stylesheet">

</head>
<body class="bg-gray-100">
<nav class="bg-gray-800 p-2">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <a href="index.php" class="flex items-center">
                    <img src="./styles/img/logo3.png" alt="Logo" class="h-12 w-12 mr-4">
                    <h1 class="text-white text-xl font-bold">Restaurante Carne al Fuego </h1>
                </a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="index.php" class="text-white hover:text-gray-300 px-3 py-2 rounded-md text-sm font-medium">
                    <i class="fas fa-home mr-1"></i> Página Principal
                </a>
            
                
            </div>            
        </div>
        </div>
    </nav>
    <!-- Sección de bienvenida -->
    <section class="relative bg-cover bg-center h-screen" style="background-image: url('./styles/img/fondoinicio.jpeg');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10 flex items-center justify-center h-full">
            <div class="text-center text-white">
                <h1 class="text-5xl font-bold mb-4">Bienvenido a Carne al Fuego</h1>
                <p class="text-2xl">Donde cada bocado es una experiencia única</p>
            </div>
        </div>
    </section>

    <!-- Sección de productos -->
    <section class="relative bg-cover bg-center py-16" style="background-image: url('./styles/img/fondoproduc.jpeg');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10 container mx-auto text-white text-center">
            <h2 class="text-4xl font-bold mb-8">Nuestros Productos</h2>
            <p class="text-xl mb-8">Debes iniciar sesión para ver nuestros productos y otras funcionalidades.</p>
            <a href="./pages/user/login.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Iniciar Sesión</a>
        </div>
    </section>
     <!-- Sección de información -->
     <section class="relative bg-cover bg-center py-16" style="background-image: url('./styles/img/fondo.jpg');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10 container mx-auto text-white text-center">
            <h2 class="text-4xl font-bold mb-8">Información del Restaurante</h2>
            <p class="text-2xl mb-4">Nombre del Restaurante: Carne al Fuego</p>
            <p class="text-xl mb-4">Redes Sociales: Facebook, Instagram, Twitter</p>
            <p class="text-xl mb-4">Teléfono: +123 456 7890</p>
            <p class="text-xl mb-4">Horarios: Lunes a Domingo - 10:00 AM a 10:00 PM</p>
        </div>
    </section>

    <!-- Ventana del carrito -->
    <div class="fixed bottom-0 right-0 m-8 bg-white rounded-lg shadow-lg p-4 z-50 max-h-96 overflow-y-auto" id="carrito" style="display: none;">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Carrito</h2>
            <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-2 rounded" id="minimizar-carrito">Minimizar</button>
        </div>
        <div id="carrito-productos" class="space-y-4">
            <!-- Productos del carrito se cargarán aquí dinámicamente -->
        </div>
        <div class="flex justify-between items-center mt-4">
            <span class="text-xl font-bold">Total:</span>
            <span class="text-xl font-bold" id="carrito-total">$0.00</span>
        </div>
        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">Pagar</button>
    </div>

    <!-- Botones para mostrar el carrito y las reservas -->
    <button class="fixed bottom-0 right-0 m-8 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded z-40 mb-20" id="mostrar-reservas">
        Ver Reservas
    </button>
    <button class="fixed bottom-0 right-0 m-8 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded z-40" id="mostrar-carrito">
        Ver Carrito
    </button>

    <!-- Ventana emergente de reservas -->
    <div id="reservas-modal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50" style="display: none;">
        <div class="bg-white p-6 rounded-lg shadow-lg w-3/4 max-h-screen overflow-y-auto">
            <h2 class="text-4xl font-bold mb-8 text-center">Mis Reservas</h2>
            <div id="reservas-grid" class="space-y-8">
                <!-- Reservas se cargarán aquí dinámicamente -->
            </div>
            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-4" onclick="cerrarModal()">Cerrar</button>
        </div>
    </div>

    <script>
        const userId = <?php echo $userId; ?>; // Pasamos el ID del usuario a JavaScript
    </script>
    <script src="../../scripts/user/carrito.js"></script>
    <script src="../../scripts/user/reservas.js"></script>
</body>
</html>
