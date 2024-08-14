<?php
include 'conexion.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías Registradas</title>
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
    <div class="max-w-4xl mx-auto py-12 sm:px-6 lg:px-8 text-[#191d20]">
        <div class="bg-[#dfded9] rounded-lg overflow-hidden shadow-md">
            <h2 class="text-2xl font-bold text-center p-4 bg-[#ed2839] text-white">Categorías Registradas</h2>
            <div class="p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php
                // Consultar categorías registradas
                $sql = "SELECT id, nombre_categoria, descripcion_categoria, imagen_categoria FROM categorias";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Mostrar cada categoría como una tarjeta
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <div class="border rounded-lg p-4 bg-white shadow relative">
                            <a href="./productos_cliente.php?categoria_id=<?php echo $row['id']; ?>" class="block hover:bg-gray-100 p-4">
                                <h3 class="text-xl font-bold mb-2 text-[#191d20] break-words"><?php echo $row["nombre_categoria"]; ?></h3>
                                <p class="text-[#404040] mb-2"><?php echo $row["descripcion_categoria"]; ?></p>
                                <div class="w-full h-48 flex justify-center items-center">
                                    <img src="../img/<?php echo basename($row["imagen_categoria"]); ?>" class="max-w-full h-auto object-contain">
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p class='text-[#404040] text-center'>No hay categorías registradas aún.</p>";
                }

                // Cerrar conexión
                $conn->close();
                ?>
            </div>
        </div>
    </div>

</body>

</html>
