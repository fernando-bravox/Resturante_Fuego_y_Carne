<?php

$status = isset($_GET['status']) ? urldecode($_GET['status']) : '';
$error = !empty($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="./css/tailwind.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-center bg-cover" style="background-image: url('./img/fondo.jpg'); background-size: 40%; background-position: center;">
    <nav class="bg-[#dfded9] shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="../index.html">
                            <img class="h-12 w-auto rounded-full border-2 border-[#ed2839]" src="./img/logo.jpg" alt="Logo">
                        </a>
                        <h1 class="text-3xl font-bold text-[#191d20] text-center ml-4">Carne al Fuego</h1>
                    </div>
                </div>
                <div class="flex items-center">
                    <a href="registro.html" class="inline-flex items-center">
                        <img src="./img/logo2.png" alt="Registrar Usuario" class="h-12 w-auto rounded-full border-2 border-[#ed2839]">
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-md mx-auto py-12 sm:px-6 lg:px-8 text-[#191d20]">
        <div id="form-container" class="bg-white rounded-lg overflow-hidden shadow-md">
            <div class="bg-[#191d20] text-white rounded-t-lg p-4">
                <h2 class="text-2xl font-bold text-center">Iniciar Sesión</h2>
            </div>
            <?php include './php/verificar_inicio.php'; ?>
            <?php if (!empty($error)): ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: '<?php echo $error; ?>',
                    });
                </script>
            <?php endif; ?>
            <?php if (!empty($status)): ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: '<?php echo $status; ?>',
                    });
                </script>
            <?php endif; ?>
            <form method="POST" action="" class="p-6">
                <div class="mb-4">
                    <label for="correo" class="block text-[#191d20] font-bold mb-2">Correo Electrónico:</label>
                    <input type="email" name="correo" id="correo" required class="w-full px-3 py-2 border rounded-lg text-[#2E2E2E] focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="contrasena" class="block text-[#191d20] font-bold mb-2">Contraseña:</label>
                    <input type="password" name="contrasena" id="contrasena" required class="w-full px-3 py-2 border rounded-lg text-[#2E2E2E] focus:outline-none focus:border-blue-500">
                </div>
                <div class="text-center">
                    <button type="submit" class="px-4 py-2 bg-[#ed2839] text-white rounded-lg cursor-pointer hover:bg-[#4A4A4A]">Iniciar Sesión</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
