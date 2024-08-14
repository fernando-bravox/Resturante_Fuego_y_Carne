<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal</title>
    <link href="../../styles/tailwind.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <?php include ('../../components/navigation.php'); ?>
    <div class="container mx-auto py-12 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Menú Principal</h1>
        <div id="productos" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Los productos se cargarán aquí mediante JavaScript -->
        </div>
    </div>
    <script src="../../scripts/menu/menu.js"></script>
</body>
</html>
