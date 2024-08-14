<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@latest/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-center bg-cover" style="background-image: url('../../styles/img/fondo.jpg'); background-size: 40%; background-position: center;">

    <!-- Barra de navegación -->
    <?php include('../../components/navigationCliente.php');?>

    <!-- Contenido del perfil del usuario -->
    <div class="max-w-4xl mx-auto py-12 sm:px-6 lg:px-8 text-gray-900" data-user-id="<?php echo $user['id']; ?>">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-8 text-center bg-gray-900 text-white p-4 rounded">Perfil del Cliente</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <?php
                $fields = [
                    'cedula' => 'Cédula',
                    'firstName' => 'Nombre',
                    'lastName' => 'Apellido',
                    'telefono' => 'Teléfono'
                ];
                foreach ($fields as $field => $label) {
                    echo '<div class="bg-gray-50 p-4 rounded-lg shadow-inner">';
                    echo '<div class="flex flex-col">';
                    echo '<div class="bg-blue-500 text-white p-4 rounded-t">';
                    echo '<div class="flex justify-between items-center">';
                    echo '<p class="text-lg font-semibold">' . $label . '</p>';
                    echo '<button onclick="editField(\'' . $field . '\', \'' . $user[$field] . '\')" class="ml-2">';
                    echo '<img src="../../styles/img/lapiz.png" class="h-6 w-6" alt="Editar">';
                    echo '</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="bg-gray-200 p-4 rounded-b">';
                    echo '<p id="' . $field . '-value" class="text-lg">' . $user[$field] . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
            <!-- Botón de eliminación -->
            <div class="mt-8 text-center">
                <form id="delete-form" method="post">
                    <button type="button" onclick="confirmDeletion()" class="bg-red-500 text-white px-4 py-2 rounded">Eliminar Cuenta</button>
                    <input type="hidden" name="delete" value="1">
                </form>
            </div>
        </div>
    </div>

    <script src="../../scripts/perfil/actualizar-perfil.js"></script>
    <script src="../../scripts/perfil/borrar-perfil.js"></script>
</body>
</html>
