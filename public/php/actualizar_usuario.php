<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['correo'])) {
    echo json_encode(['status' => 'error', 'message' => 'Usuario no autenticado']);
    exit();
}

// Conectar a la base de datos
include 'conexion.php';
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Conexión fallida: ' . $conn->connect_error]);
    exit();
}

$correo = $_SESSION['correo'];

// Obtener los datos enviados por AJAX
$data = json_decode(file_get_contents('php://input'), true);
$field = $data['field'];
$value = $data['value'];

// Actualizar el campo correspondiente en la base de datos
$sql = "UPDATE usuarios SET $field = ? WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $value, $correo);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Datos actualizados correctamente']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error al actualizar los datos']);
}

$stmt->close();
$conn->close();
?>
