<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../dataAccess/dataAccessLogic/Reservas.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $objConexion = new ConexionDB();
    $objReserva= new Reservas($objConexion);
    $array = $objReserva->listarReservas();
    echo json_encode($array);
    exit;
}
?>
