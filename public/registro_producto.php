<?php
include 'php/conexion.php';

// Obtener el id de la categoría de la URL
$categoria_id = isset($_GET['categoria_id']) ? $_GET['categoria_id'] : 0;
$status = isset($_GET['status']) ? $_GET['status'] : '';

if ($categoria_id == 0) {
    die("Error: No se recibió el ID de la categoría.");
}

// Obtener los productos de la categoría
$sql_productos = "SELECT id, nombre_producto, descripcion_producto, precio_producto, imagen_producto FROM productos WHERE categoria_id = $categoria_id";
$result_productos = $conn->query($sql_productos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro y Lista de Productos</title>
    <!-- Incluir Tailwind CSS -->
    <link rel="stylesheet" href="css/tailwind.css"> <!-- Asegúrate de que este enlace apunte correctamente a Tailwind CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Incluir SweetAlert -->
    <script src="./js/Formulario_producto.js"></script>
    <script src="./js/eliminar_producto.js"></script> <!-- Incluir el nuevo archivo JavaScript -->
</head>
<body class="bg-center bg-cover" style="background-image: url('img/fondo.jpg'); background-size: 40%; background-position: center;">
    <!-- Barra de navegación -->
    <nav class="bg-[#dfded9] shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="inicio.html">
                            <img class="h-12 w-auto rounded-full border-2 border-[#ed2839]" src="img/logo.jpg" alt="Logo">
                        </a>
                        <h1 class="text-3xl font-bold text-[#191d20] text-center ml-4">Carne al Fuego</h1>
                    </div>
                </div>
                <div class="flex items-center">
                    <a href="registro_usuario.html" class="inline-flex items-center">
                        <img src="img/logo2.png" alt="Registrar Usuario" class="h-12 w-auto rounded-full border-2 border-[#ed2839]">
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="max-w-4xl mx-auto py-12 sm:px-6 lg:px-8 text-[#191d20] space-y-8">
        <!-- Botón para mostrar/ocultar formulario -->
        <div class="text-center">
            <button id="toggle-form-button" class="px-8 py-4 bg-[#ed2839] text-white rounded-lg cursor-pointer text-2xl font-bold hover:bg-[#4A4A4A]">Registrar un Producto</button>
        </div>

        <!-- Formulario de Registro de Producto -->
        <div id="form-container" class="bg-white rounded-lg overflow-hidden shadow-md">
            <div class="bg-[#191d20] text-white rounded-t-lg p-4">
                <h2 class="text-2xl font-bold text-center">Registrar Nuevo Producto</h2>
            </div>
            <form action="php/guardar_producto.php" method="post" enctype="multipart/form-data" class="p-6">
                <input type="hidden" name="categoria_id" value="<?php echo htmlspecialchars($categoria_id); ?>">

                <div class="mb-4">
                    <label for="nombre" class="block text-[#191d20] font-bold mb-2">Nombre del Producto:</label>
                    <input type="text" id="nombre" name="nombre" required class="w-full px-3 py-2 border rounded-lg text-[#2E2E2E] focus:outline-none focus:border-blue-500"maxlength="50">
                </div>

                <div class="mb-4">
                    <label for="descripcion" class="block text-[#191d20] font-bold mb-2">Descripción del Producto:</label>
                    <textarea id="descripcion" name="descripcion" rows="4" required class="w-full px-3 py-2 border rounded-lg text-[#2E2E2E] focus:outline-none focus:border-blue-500" maxlength="200"></textarea>
                </div>

                <div class="mb-4">
                    <label for="precio" class="block text-[#191d20] font-bold mb-2">Precio del Producto:</label>
                    <input type="number" step="0.01" id="precio" name="precio" required class="w-full px-3 py-2 border rounded-lg text-[#2E2E2E] focus:outline-none focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label for="imagen" class="block text-[#191d20] font-bold mb-2">Imagen del Producto:</label>
                    <input type="file" id="imagen" name="imagen" accept="image/*" required class="w-full px-3 py-2 border rounded-lg text-[#2E2E2E] focus:outline-none focus:border-blue-500">
                </div>

                <div class="text-center">
                    <input type="submit" value="Registrar Producto" class="px-4 py-2 bg-[#ed2839] text-white rounded-lg cursor-pointer hover:bg-[#4A4A4A]">
                </div>
            </form>
        </div>

        <!-- Productos de la categoría -->
        <div class="bg-[#dfded9] rounded-lg overflow-hidden shadow-md">
            <div class="bg-[#ed2839] text-white rounded-t-lg p-4">
                <h3 class="text-xl font-bold text-center">Productos en la Categoría</h3>
            </div>
            <div class="p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php
                if ($result_productos->num_rows > 0) {
                    while ($producto = $result_productos->fetch_assoc()) {
                        ?>
                        <div class="border rounded-lg p-4 bg-white shadow relative">
                            <h3 class="text-xl font-bold mb-2 text-[#191d20] break-words whitespace-normal"><?php echo $producto["nombre_producto"]; ?></h3>
                            <p class="text-[#404040] mb-2 break-words whitespace-normal"><?php echo $producto["descripcion_producto"]; ?></p>
                            <p class="text-[#191d20] font-bold mb-2">$<?php echo $producto["precio_producto"]; ?></p>
                            <div class="w-full h-48 overflow-hidden flex justify-center items-center">
                                <img src="img/<?php echo basename($producto["imagen_producto"]); ?>" class="max-w-full max-h-full object-contain">
                            </div>
                            <div class="flex justify-between mt-4">
                                <!-- Botón Eliminar -->
                                <button class="bg-red-500 hover:bg-red-700 text-black font-bold py-2 px-4 rounded eliminar-producto" data-id="<?php echo $producto['id']; ?>">Eliminar</button>&nbsp
                                <!-- Botón Actualizar -->
                                <a href="php/actualizar_producto.php?id=<?php echo $producto["id"]; ?>&categoria_id=<?php echo $categoria_id; ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Actualizar</a>
                            </div>
                            <!-- Formulario de Actualización (inicialmente oculto) -->
                            <form id="form-<?php echo $producto["id"]; ?>" method="POST" action="actualizar_producto.php" class="form-actualizar bg-gray-100 rounded-lg p-4 mb-4 shadow absolute inset-0 flex flex-col justify-center items-center" style="display: none;" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $producto["id"]; ?>">
                                <input type="text" name="nombre" value="<?php echo htmlspecialchars($producto["nombre_producto"]); ?>" class="form-input bg-gray-200 border-2 border-gray-300 py-2 px-4 rounded-md block w-full mb-2" placeholder="Nombre del producto">
                                <textarea name="descripcion" class="form-textarea bg-gray-200 border-2 border-gray-300 py-2 px-4 rounded-md block w-full mb-2" rows="4" placeholder="Descripción"><?php echo htmlspecialchars($producto["descripcion_producto"]); ?></textarea>
                                <input type="file" name="imagen" class="form-input bg-gray-200 border-2 border-gray-300 py-2 px-4 rounded-md block w-full mb-2">
                                <input type="number" step="0.01" name="precio" value="<?php echo htmlspecialchars($producto["precio_producto"]); ?>" class="form-input bg-gray-200 border-2 border-gray-300 py-2 px-4 rounded-md block w-full mb-2" placeholder="Precio del producto">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Guardar cambios</button>
                                <button type="button" onclick="toggleForm('<?php echo $producto["id"]; ?>')" class="mt-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Cancelar</button>
                            </form>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p class='text-[#404040] text-center'>No hay productos en esta categoría.</p>";
                }

                $conn->close();
                ?>
            </div>
        </div>

    <?php if (!empty($status)) { ?>
        <script>
            function showAlert(message) {
                Swal.fire({
                    title: 'Estado del Registro',
                    text: message,
                    icon: message.includes('correctamente') ? 'success' : 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'registro_producto.php?categoria_id=<?php echo $categoria_id; ?>';
                    }
                });
            }
            document.addEventListener('DOMContentLoaded', function() {
                showAlert('<?php echo $status; ?>');
            });
        </script>
    <?php } ?>
</body>
</html>
