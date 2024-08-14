<?php
// Conexión a la base de datos
include 'conexion.php';

$status = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener todas las variables POST y realizar la conexión a la base de datos
    $cedula = $_POST['cedula'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $telefono = $_POST['telefono'];
    $perfil = $_POST['perfil'];

    // Verificar si el perfil es Administrador y validar el código de registro
    if ($perfil === 'Administrador') {
        $codigo = $_POST['codigo'];

        // Validar el código de registro
        if ($codigo !== '1234567k') {
            // Redirigir con mensaje de error si el código no es correcto
            header('Location: ../registro.html?error=Código de registro incorrecto');
            exit;
        }
    }

    // Insertar nuevo usuario
    $stmt = $conn->prepare('INSERT INTO Usuarios (cedula, firstName, lastName, email, password, telefono, perfil) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->bind_param('sssssss', $cedula, $firstName, $lastName, $email, $password, $telefono, $perfil);

    if ($stmt->execute()) {
        // Registro exitoso
        $status = "Usuario registrado exitosamente";
    } else {
        // Error en el registro
        $status = "Error al registrar usuario";
        echo 'Error: ' . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

// Redirigir con el mensaje de estado
header('Location: ../registro.html?status=' . urlencode($status));
exit;
?>
