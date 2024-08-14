<?php
include 'conexion.php'; // Asegúrate de que la ruta al archivo de conexión es correcta

$categoria_id = $_POST["categoria_id"];
$status_message = "";

// Verificar si se ha enviado el formulario y los campos obligatorios están presentes
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_FILES["imagen"]["name"]) && !empty($_POST["nombre"]) && !empty($_POST["descripcion"]) && !empty($_POST["precio"]) && !empty($_POST["categoria_id"])) {
    // Preparar datos para la inserción
    $nombre = $conn->real_escape_string($_POST["nombre"]);
    $descripcion = $conn->real_escape_string($_POST["descripcion"]);
    $precio = $conn->real_escape_string($_POST["precio"]);
    $categoria_id = $conn->real_escape_string($_POST["categoria_id"]);
    $imagen_nombre = $_FILES["imagen"]["name"];
    $imagen_tmp = $_FILES["imagen"]["tmp_name"];
    $imagen_tipo = $_FILES["imagen"]["type"];

    // Directorio donde se guardará la imagen (asegúrate de que exista)
    $upload_dir = '../img/';

    // Verificar si el directorio de carga existe, si no, crearlo
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Guardar la imagen en una ubicación específica y obtener la ruta
    $ruta_imagen = $upload_dir . basename($imagen_nombre);
    if (move_uploaded_file($imagen_tmp, $ruta_imagen)) {
        // Insertar datos en la base de datos
        $sql = "INSERT INTO productos (nombre_producto, descripcion_producto, precio_producto, imagen_producto, categoria_id) 
                VALUES ('$nombre', '$descripcion', '$precio', '$ruta_imagen', '$categoria_id')";

        if ($conn->query($sql) === TRUE) {
            $status_message = "El producto se registró correctamente.";
        } else {
            $status_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $status_message = "Error al subir el archivo.";
    }
} else {
    $status_message = "Todos los campos son obligatorios.";
}

// Cerrar conexión
$conn->close();

// Redirigir de vuelta al formulario con el mensaje de estado
header("Location: ../registro_producto.php?categoria_id=$categoria_id&status=" . urlencode($status_message));
exit;
?>
