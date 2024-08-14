<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con Tailwind CSS</title>
    <!-- Incluye Tailwind CSS -->
    <link href="../../styles/tailwind.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <!-- Barra de navegación -->
    <?php include ('../../components/navigation.php'); ?>

    <div class="container mx-auto max-w-md py-8">
        <!-- Encabezado -->
        <div class="flex items-center justify-between mb-4 text-justify">
            <h1 class="text-3xl font-bold text-gray-800">Actualizar productos</h1>
        </div>

        <form id="actualizarProductoForm" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <input type="hidden" id="id" name="id" value="">    
        <div class="mb-4">
                <label for="nombre_producto" class="block text-gray-700 text-sm font-bold mb-2">Nombre producto:</label>
                <input type="text" id="nombre_producto" name="nombre_producto" placeholder=" Ingrese su nombre"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="descripcion_producto" class="block text-gray-700 text-sm font-bold mb-2">Descripcion producto:</label>
                <input type="text" id="descripcion_producto" name="descripcion_producto" placeholder="Ingrese su apellido"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                    <label for="precio_producto" class="block text-[#191d20] font-bold mb-2">Precio del Producto:</label>
                    <input type="number" step="0.01" id="precio_producto" name="precio_producto" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                </div>
            <div class="mb-6">
                <label for="imagen_producto" class="block text-gray-700 text-sm font-bold mb-2">Imagen producto:</label>
                <input type="file" id="imagen_producto" name="imagen_producto" accept="image/*"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="categoria_id" class="block text-[#191d20] font-bold mb-2">Categoría:</label>
                <select id="categoria_id" name="categoria_id" required class="w-full px-3 py-2 border rounded-lg text-[#2E2E2E] focus:outline-none focus:border-blue-500">
                </select>
                </div> 
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Actualizar Usuario</button>
            </div>

        </form>
    </div>
    </form>
    <script src="../../scripts/producto/actualizar-producto.js"></script>
</body>

</html>