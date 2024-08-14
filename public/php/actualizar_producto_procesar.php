<?php
include 'conexion.php';

$id_producto = $_POST['id'];
$categoria_id = $_POST['categoria_id'];
$status_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["nombre"]) && !empty($_POST["descripcion"]) && !empty($_POST["precio"])) {
    $nombre = $conn->real_escape_string($_POST["nombre"]);
    $descripcion = $conn->real_escape_string($_POST["descripcion"]);
    $precio = $conn->real_escape_string($_POST["precio"]);
    $imagen = isset($_FILES["imagen"]["name"]) ? $_FILES["imagen"]["name"] : "";

    if (!empty($imagen)) {
        $imagen_tmp = $_FILES["imagen"]["tmp_name"];
        $upload_dir = '../img/';
        $ruta_imagen = $upload_dir . basename($imagen);
        if (!move_uploaded_file($imagen_tmp, $ruta_imagen)) {
            $status_message = "Error al subir la imagen.";
            header("Location: actualizar_producto.php?id=$id_producto&categoria_id=$categoria_id&status=" . urlencode($status_message));
            exit;
        }
        $sql = "UPDATE productos SET nombre_producto='$nombre', descripcion_producto='$descripcion', precio_producto='$precio', imagen_producto='$ruta_imagen' WHERE id=$id_producto";
    } else {
        $sql = "UPDATE productos SET nombre_producto='$nombre', descripcion_producto='$descripcion', precio_producto='$precio' WHERE id=$id_producto";
    }

    if ($conn->query($sql) === TRUE) {
        $status_message = "El producto se actualizó correctamente.";
    } else {
        $status_message = "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $status_message = "Todos los campos son obligatorios.";
}

$conn->close();

header("Location: ../registro_producto.php?categoria_id=$categoria_id&status=" . urlencode($status_message));
exit;
?>
