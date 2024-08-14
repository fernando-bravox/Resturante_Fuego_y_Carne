<?php
include 'conexion.php';

// Obtener el id del producto y la categoría de la URL
$id_producto = isset($_GET['id']) ? intval($_GET['id']) : 0;
$categoria_id = isset($_GET['categoria_id']) ? intval($_GET['categoria_id']) : 0;

if ($id_producto == 0 || $categoria_id == 0) {
    die("Error: No se recibió el ID del producto o de la categoría.");
}

// Obtener los datos del producto
$sql_producto = "SELECT nombre_producto, descripcion_producto, precio_producto, imagen_producto FROM productos WHERE id = $id_producto";
$result_producto = $conn->query($sql_producto);
$producto = $result_producto->fetch_assoc();

if (!$producto) {
    die("Error: No se encontró el producto.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Producto</title>
    <!-- Incluir Tailwind CSS -->
    <link rel="stylesheet" href="../css/tailwind.css"> <!-- Asegúrate de que este enlace apunte correctamente a Tailwind CSS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Incluir SweetAlert -->
    <script>
        function showAlert(message, icon) {
            Swal.fire({
                title: 'Estado del Registro',
                text: message,
                icon: icon,
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../registro_producto.php?categoria_id=<?php echo $categoria_id; ?>';
                }
            });
        }

        function validateForm(form) {
            var nombre = form.nombre.value.trim();
            var descripcion = form.descripcion.value.trim();
            var precio = form.precio.value.trim();
            var imagen = form.imagen.value;

            if (nombre === '' || descripcion === '' || precio === '' || (imagen === '' && form.imagen.hasAttribute('required'))) {
                showAlert('Todos los campos son obligatorios.', 'error');
                return false;
            }

            if (isNaN(precio)) {
                showAlert('El precio debe ser un número válido.', 'error');
                return false;
            }

            return true;
        }
    </script>
</head>
<body class="bg-center bg-cover" style="background-image: url('../img/fondo.jpg'); background-size: 40%; background-position: center;">
    <!-- Barra de navegación -->
    <nav class="bg-[#dfded9] shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="../index.html">
                            <img class="h-12 w-auto rounded-full border-2 border-[#ed2839]" src="../img/logo.jpg" alt="Logo">
                        </a>
                        <h1 class="text-3xl font-bold text-[#191d20] text-center ml-4">Carne al Fuego</h1>
                    </div>
                </div>
                <div class="flex items-center">
                    <a href="../registro_usuario.html" class="inline-flex items-center">
                        <img src="../img/logo2.png" alt="Registrar Usuario" class="h-12 w-auto rounded-full border-2 border-[#ed2839]">
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="max-w-4xl mx-auto py-12 sm:px-6 lg:px-8 text-[#191d20] space-y-8">
        <!-- Formulario de Actualización de Producto -->
        <div id="form-container" class="bg-white rounded-lg overflow-hidden shadow-md">
            <div class="bg-[#191d20] text-white rounded-t-lg p-4">
                <h2 class="text-2xl font-bold text-center">Actualizar Producto</h2>
            </div>
            <form action="actualizar_producto_procesar.php" method="post" enctype="multipart/form-data" class="p-4" onsubmit="return validateForm(this);">
                <input type="hidden" name="id" value="<?php echo $id_producto; ?>">
                <input type="hidden" name="categoria_id" value="<?php echo $categoria_id; ?>">
                
                <div class="mb-4">
                    <label for="nombre" class="block text-[#191d20] font-bold mb-2">Nombre del Producto:</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($producto['nombre_producto']); ?>" required class="w-full px-3 py-2 border rounded-lg text-[#2E2E2E] focus:outline-none focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label for="descripcion" class="block text-[#191d20] font-bold mb-2">Descripción del Producto:</label>
                    <textarea id="descripcion" name="descripcion" rows="4" required class="w-full px-3 py-2 border rounded-lg text-[#2E2E2E] focus:outline-none focus:border-blue-500"><?php echo htmlspecialchars($producto['descripcion_producto']); ?></textarea>
                </div>

                <div class="mb-4">
                    <label for="precio" class="block text-[#191d20] font-bold mb-2">Precio del Producto:</label>
                    <input type="number" step="0.01" id="precio" name="precio" value="<?php echo htmlspecialchars($producto['precio_producto']); ?>" required class="w-full px-3 py-2 border rounded-lg text-[#2E2E2E] focus:outline-none focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label for="imagen" class="block text-[#191d20] font-bold mb-2">Imagen del Producto:</label>
                    <input type="file" id="imagen" name="imagen" accept="image/*" class="w-full px-3 py-2 border rounded-lg text-[#2E2E2E] focus:outline-none focus:border-blue-500">
                    <p class="text-sm text-[#2E2E2E] mt-2">Deja este campo vacío si no quieres actualizar la imagen.</p>
                </div>

                <div class="text-center">
                    <input type="submit" value="Guardar Cambios" class="px-4 py-2 bg-[#ed2839] text-white rounded-lg cursor-pointer hover:bg-[#4A4A4A]">
                </div>
            </form>
        </div>
    </div>

    <?php if (!empty($status)) { ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showAlert('<?php echo $status; ?>', '<?php echo strpos($status, "correctamente") !== false ? 'success' : 'error'; ?>');
            });
        </script>
    <?php } ?>
</body>
</html>
