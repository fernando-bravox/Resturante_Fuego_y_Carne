<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <!-- Incluir Tailwind CSS -->
     
    <link href="../../styles/tailwind.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Barra de navegación -->
    <?php include ('../../components/navigation.php'); ?>
    <!-- Contenido principal -->
    <div class="max-w-4xl mx-auto py-12 sm:px-6 lg:px-8 text-[#191d20] space-y-8">
        <!-- Formulario de Registro de Producto -->
        <div class="bg-white rounded-lg overflow-hidden shadow-md">
            <div class="bg-[#191d20] text-white rounded-t-lg p-4">
                <h2 class="text-2xl font-bold text-center">Agregar Producto</h2>
            </div>
    <form id="productoForm" enctype="multipart/form-data" class="p-6">
        
    <div class="mb-4">
                    <label for="nombre_producto" class="block text-[#191d20] font-bold mb-2">Nombre del Producto:</label>
                    <input type="text" id="nombre_producto" name="nombre_producto" required class="w-full px-3 py-2 border rounded-lg text-[#2E2E2E] focus:outline-none focus:border-blue-500" maxlength="50">
                </div>

                <div class="mb-4">
                    <label for="descripcion_producto" class="block text-[#191d20] font-bold mb-2">Descripción del Producto:</label>
                    <textarea id="descripcion_producto" name="descripcion_producto" rows="4" required class="w-full px-3 py-2 border rounded-lg text-[#2E2E2E] focus:outline-none focus:border-blue-500" maxlength="200"></textarea>
                </div>


                <div class="mb-4">
                    <label for="precio_producto" class="block text-[#191d20] font-bold mb-2">Precio del Producto:</label>
                    <input type="number" step="0.01" id="precio_producto" name="precio_producto" required class="w-full px-3 py-2 border rounded-lg text-[#2E2E2E] focus:outline-none focus:border-blue-500">
                </div>


                <div class="mb-4">
                    <label for="imagen_producto" class="block text-[#191d20] font-bold mb-2">Imagen del Producto:</label>
                    <input type="file" id="imagen_producto" name="imagen_producto" accept="image/*" class="w-full px-3 py-2 border rounded-lg text-[#2E2E2E] focus:outline-none focus:border-blue-500">
                </div>

                
                <div class="mb-4">
                <label for="categoria_id" class="block text-[#191d20] font-bold mb-2">Categoría:</label>
                <select id="categoria_id" name="categoria_id" required class="w-full px-3 py-2 border rounded-lg text-[#2E2E2E] focus:outline-none focus:border-blue-500">
                </select>
                </div> 
            <!-- Las opciones se cargarán aquí mediante JavaScript -->
        </select><br>
        <div class="text-center">
        <input type="submit" value="Agregar Producto" class="px-4 py-2 bg-[#ed2839] text-white rounded-lg cursor-pointer hover:bg-[#4A4A4A]">
        </div>  
    </form>
    <script src="../../scripts/producto/add-producto.js"></script>

</body>
</html>