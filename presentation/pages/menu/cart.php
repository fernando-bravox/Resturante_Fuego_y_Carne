<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link href="../../styles/tailwind.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <?php include ('../../components/navigationcli.php'); ?>
    <div class="container mx-auto py-12 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Carrito de Compras</h1>
        <div id="carrito" class="bg-white rounded-lg shadow-md p-6">
            <!-- Los productos del carrito se cargarán aquí mediante JavaScript -->
        </div>
        <div class="mt-4 text-right">
            <button onclick="reservar()" class="px-4 py-2 bg-green-500 text-white rounded-lg">Reservar</button>
        </div>
    </div>
    <script src="../../scripts/menu/cart.js"></script>
</body>
</html>
