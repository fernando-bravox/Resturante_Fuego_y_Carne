<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ('../dataAccess/dataAccessLogic/Reservas.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['comprobante']) && isset($_POST['reserva_id'])) {
        $reservaId = intval($_POST['reserva_id']);
        $comprobante = $_FILES['comprobante'];

        // Verificar y subir el archivo
        $directorio = "comprobantes/"; // Ruta relativa correcta
        $nombreArchivo = time() . "_" . basename($comprobante['name']);
        $rutaTemporal = $comprobante['tmp_name'];
        $rutaDefinitiva = $directorio . $nombreArchivo;

        if (!file_exists($directorio)) {
            mkdir($directorio, 0777, true);
        }

        if (move_uploaded_file($rutaTemporal, $rutaDefinitiva)) {
            $rutaParaBD = $directorio . $nombreArchivo; // Ruta que se guardará en la base de datos

            $objConexion = new ConexionDB();
            $objReservas = new Reservas($objConexion);

            if ($objReservas->actualizarComprobante($reservaId, $rutaParaBD)) {
                $response = array('success' => true, 'message' => 'Comprobante subido correctamente');
            } else {
                $response = array('success' => false, 'message' => 'Error al actualizar el comprobante en la base de datos');
            }
        } else {
            $response = array('success' => false, 'message' => 'Error al subir el comprobante');
        }
    } else {
        $response = array('success' => false, 'message' => 'Faltan datos para subir el comprobante');
    }

    echo json_encode($response);
    exit();
}
?>
