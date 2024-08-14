<?php
include 'conexion.php';

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
    <title>Lista de Productos</title>
    <!-- Incluir Tailwind CSS -->
    <link rel="stylesheet" href="../css/tailwind.css"> <!-- Asegúrate de que este enlace apunte correctamente a Tailwind CSS -->
    
  
   
</head>
<body class="bg-center bg-cover" style="background-image: url('../img/fondo.jpg'); background-size: 40%; background-position: center;">
    <!-- Barra de navegación -->
    <nav class="bg-[#dfded9] shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="cliente_usuario.php">
                            <img class="h-12 w-auto rounded-full border-2 border-[#ed2839]" src="../img/logo.jpg" alt="Logo">
                        </a>
                        <h1 class="text-3xl font-bold text-[#191d20] text-center ml-4">Carne al Fuego</h1>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="max-w-4xl mx-auto py-12 sm:px-6 lg:px-8 text-[#191d20] space-y-8">
      

        
        <!-- Productos de la categoría -->
        <div class="bg-[#dfded9] rounded-lg overflow-hidden shadow-md">
            <div class="bg-[#ed2839] text-white rounded-t-lg p-4">
                <h3 class="text-xl font-bold text-center">Productos en la categoría</h3>
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
                                <img src="../img/<?php echo basename($producto["imagen_producto"]); ?>" class="max-w-full max-h-full object-contain">
                            </div>
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
        
    <?php } ?>
</body>
</html>
