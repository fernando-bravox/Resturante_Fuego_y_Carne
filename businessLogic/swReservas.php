<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ('../dataAccess/dataAccessLogic/Reservas.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $usuario_id = isset($data['usuario_id']) ? intval($data['usuario_id']) : null;
    $productos = isset($data['productos']) ? $data['productos'] : null;
    $total = isset($data['total']) ? floatval($data['total']) : null;

    if (is_null($usuario_id) || is_null($productos) || is_null($total)) {
        $response = array('success' => false, 'message' => 'Faltan datos para agregar la reserva');
        echo json_encode($response);
        exit();
    }

    $objConexion = new ConexionDB();
    $objReservas = new Reservas($objConexion);

    $objReservas->setUsuarioId($usuario_id);
    $objReservas->setProductos($productos);
    $objReservas->setTotal($total);

    if ($objReservas->agregarReserva()) {
        $response = array('success' => true, 'message' => 'Reserva agregada correctamente');
    } else {
        $response = array('success' => false, 'message' => 'Error al agregar la reserva');
    }
    echo json_encode($response);
    exit();
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $usuario_id = isset($_GET['usuario_id']) ? intval($_GET['usuario_id']) : null;

    $objConexion = new ConexionDB();
    $objReservas = new Reservas($objConexion);
    $array = $objReservas->listarReservas();

    if ($usuario_id) {
        $array = array_filter($array, function($reserva) use ($usuario_id) {
            return $reserva['usuario_id'] == $usuario_id;
        });
    }

    echo json_encode(array_values($array));
    exit();
}
