<?php
session_start();
include 'conexion.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Consulta para verificar el correo y la contraseña
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verificar contraseña sin hash
        if ($contrasena == $row['password']) {
            // Verificar el rol del usuario
            $perfil = $row['perfil'];
            $_SESSION['correo'] = $correo;  // Guardar correo en sesión
            $_SESSION['cedula'] = $row['cedula']; // Guardar cédula en sesión si es necesario

            if ($perfil == 'Administrador') {
                $_SESSION['rol'] = 'administrador';
                header("Location: ./inicio.html"); // Redirigir al panel de administrador
                exit();
            } elseif ($perfil == 'Cliente') {
                $_SESSION['rol'] = 'cliente';
                header("Location: php/cliente_usuario.php"); // Redirigir al panel de cliente
                exit();
            } elseif ($perfil == 'Empleado') {
                $_SESSION['rol'] = 'empleado';
                header("Location: php/ver_categorias.php"); // Redirigir al panel de empleado
                exit();
            } else {
                $error = "El rol del usuario no está definido.";
            }
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Correo no registrado. Por favor, registrese.";
    }
}
?>
