<?php
include ('../dataAccess/dataAccessLogic/User.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $objConexion = new ConexionDB();
    $objUser = new Usuario($objConexion);

    $user = $objUser->login($email, $password);
    if ($user) {
        session_start();
        $_SESSION['user'] = $user;
        $response = array('success' => true, 'user' => $user);
    } else {
        $response = array('success' => false, 'message' => 'Credenciales incorrectas');
    }
    echo json_encode($response);
    exit;
}

?>
