<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con Tailwind CSS</title>
    <!-- Incluye Tailwind CSS -->
    <link href="../../styles/tailwind.css" rel="stylesheet">
    <!-- Incluye SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-cover bg-center" >
    <!-- Barra de navegación -->
    <?php include ('../../components/navigation.php'); ?>

    <div class="container mx-auto max-w-md py-8">
        <form id="categoriaForm" class="bg-white shadow-md rounded">
            <!-- Encabezado dentro del formulario -->
            <div class="bg-gray-800 text-white p-3 rounded-t flex justify-center">
                <h1 class="text-xl font-bold">Registro de Nueva Categoría</h1>
            </div>
            <div class="px-8 pt-6 pb-8 mb-4">
                <div class="mb-4">
                    <label for="nombre_categoria" class="block text-gray-700 text-sm font-bold mb-2">Nombre de la Categoría:</label>
                    <input type="text" id="nombre_categoria" name="nombre_categoria" placeholder="Ingrese el nombre"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="descripcion_categoria" class="block text-gray-700 text-sm font-bold mb-2">Descripción de la Categoría:</label>
                    <textarea id="descripcion_categoria" name="descripcion_categoria" placeholder="Ingrese la descripción"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>
                <div class="mb-6">
                    <label for="imagen_categoria" class="block text-gray-700 text-sm font-bold mb-2">Imagen de la Categoría:</label>
                    <input type="file" id="imagen_categoria" name="imagen_categoria" accept="image/*"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="flex items-center justify-center">
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Registrar Categoría</button>
                </div>
            </div>
        </form>
    </div>
</body>
<script src="../../scripts/categoria/add-categoria.js"></script>
</html>
