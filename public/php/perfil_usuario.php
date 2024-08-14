<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['correo'])) {
    header('Location: ../inicio_Secion.php');
    exit();
}

// Conectar a la base de datos
include 'conexion.php';
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Usar el correo de la sesión para buscar los datos del usuario
$correo = $_SESSION['correo'];

$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $cedula = $row['cedula'];
    $firstName = $row['firstName'];
    $lastName = $row['lastName'];
    $email = $row['email'];
    $telefono = $row['telefono'];
    $perfil = $row['perfil'];
} else {
    echo "No se encontraron datos para el usuario.";
    exit();
}

// Eliminar usuario si se ha solicitado
if (isset($_POST['delete'])) {
    $sql = "DELETE FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    if ($stmt->execute()) {
        session_destroy();
        header('Location: ../inicio_sesion.php?status=' . urlencode('Cuenta eliminada exitosamente'));
        exit();
    } else {
        header('Location: perfil_usuario.php?status=' . urlencode('Error al eliminar la cuenta'));
        exit();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Usuario</title>
    <link href="../css/tailwind.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                <div class="flex items-center">
                    <a href="perfil_usuario.php" class="inline-flex items-center">
                        <img src="../img/logo2.png" alt="Registrar Usuario" class="h-12 w-auto rounded-full border-2 border-[#ed2839]">
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido del perfil del usuario -->
    <div class="max-w-7xl mx-auto py-12 sm:px-6 lg:px-8 text-[#191d20]">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-8 text-center bg-[#191d20] text-white p-4 rounded">Perfil del Usuario</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <?php
                $fields = [
                    'cedula' => 'Cédula',
                    'firstName' => 'Nombre',
                    'lastName' => 'Apellido',
                    'email' => 'Email',
                    'telefono' => 'Teléfono',
                    'perfil' => 'Perfil'
                ];
                foreach ($fields as $field => $label) {
                    echo '<div class="bg-gray-50 p-4 rounded-lg shadow-inner">';
                    echo '<p class="text-lg font-semibold bg-blue-500 text-white p-4 rounded flex justify-between">';
                    echo $label;

                    if ($field !== 'perfil' && $field !== 'email') {
                        echo '<button onclick="editField(\'' . $field . '\', \'' . $row[$field] . '\')" class="ml-2 text-gray-800">';
                        echo '<img src="../img/lapiz.png" class="h-4 w-4" alt="Editar">';
                        echo '</button>';
                    }

                    echo '</p>';
                    echo '<p id="' . $field . '-value" class="text-lg bg-gray-200 p-4 rounded">' . $row[$field] . '</p>';
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

    <script>
        function confirmDeletion() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form').submit();
                }
            })
        }
        
        const fieldTranslations = {
            'cedula': 'Cédula',
            'firstName': 'Nombre',
            'lastName': 'Apellido',
            'email': 'Email',
            'telefono': 'Teléfono',
            'perfil': 'Perfil'
        };

        function editField(field, currentValue) {
            const fieldLabel = fieldTranslations[field] || field;

            let inputAttributes = {};

            if (field === 'cedula' || field === 'telefono') {
                inputAttributes = {
                    maxlength: 10,
                    pattern: "\\d*"
                };
            } else if (field === 'firstName' || field === 'lastName') {
                inputAttributes = {
                    pattern: "^[a-zA-ZÀ-ÿ\\s]+$"
                };
            }

            Swal.fire({
                title: 'Editar ' + fieldLabel,
                input: 'text',
                inputValue: currentValue,
                inputAttributes: inputAttributes,
                showCancelButton: true,
                confirmButtonText: 'Guardar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    let value = result.value;
                    
                    if ((field === 'firstName' || field === 'lastName') && !/^[a-zA-ZÀ-ÿ\s]+$/.test(value)) {
                        Swal.fire({
                            title: 'Error',
                            text: 'El campo solo debe contener letras y espacios.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                        return;
                    }

                    if ((field === 'cedula' || field === 'telefono') && !/^\d{1,10}$/.test(value)) {
                        Swal.fire({
                            title: 'Error',
                            text: 'El campo debe ser un número de hasta 10 dígitos.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                        return;
                    }

                    // Actualizar el valor en el DOM
                    document.getElementById(field + '-value').innerText = value;

                    // Enviar los datos al servidor para actualizar en la base de datos
                    fetch('actualizar_usuario.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            field: field,
                            value: value
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            Swal.fire({
                                title: '¡Modificado con éxito!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: data.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Error',
                            text: 'Ocurrió un error al actualizar los datos',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
                }
            });
        }
    </script>
</body>
</html>
