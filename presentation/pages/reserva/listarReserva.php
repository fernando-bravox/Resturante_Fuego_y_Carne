<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Reservas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@latest/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <?php include('../../components/navigation.php');?>

    <!-- Sección de reservas -->
    <section class="container mx-auto py-16">
        <h2 class="text-4xl text-white font-bold mb-8 text-center">Todas las Reservas</h2>
        <div id="reservas-list" class="bg-white p-6 rounded-lg shadow-lg space-y-4">
            <!-- Las reservas se cargarán aquí dinámicamente -->
        </div>
    </section>

    <script src="../../scripts/user/listarReservas.js"></script>
</body>
</html>