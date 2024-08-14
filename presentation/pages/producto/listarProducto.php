<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Completo con Tailwind CSS</title>
    <!-- Incluye Tailwind CSS -->
    <link href="../../styles/tailwind.css" rel="stylesheet">
    <!-- Enlace a Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Barra de navegación -->
    <?php include('../../components/navigation.php');?>

    <div class="container mx-auto py-2">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-3xl font-bold text-gray-800">Gestión de Categorías</h1>
            <a href="addProducto.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Agregar Producto</a>
        </div>

        <!-- Tabla de Categorías -->
        <div class="bg-white shadow-md rounded my-6 ">
            <table class="min-w-full bg-white mx-auto" id="table-productos">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-2 px-6 text-left">ID</th>
                        <th class="py-2 px-6 text-left">Nombre Producto</th>
                        <th class="py-2 px-6 text-left">Descripción Producto</th>
                        <th class="py-2 px-6 text-left">Precio Producto</th>
                        <th class="py-2 px-6 text-left">Imagen Producto</th>
                        <th class="py-2 px-6 text-left">Categoría ID Producto</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <!-- Aquí se llenarán dinámicamente los datos de los usuarios -->
                </tbody>
            </table>
        </div>
    </div>

    <script src="../../scripts/producto/main.js"></script>
</body>
</html>
