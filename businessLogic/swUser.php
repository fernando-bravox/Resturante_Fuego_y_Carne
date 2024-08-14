<?php
include ('../dataAccess/dataAccessLogic/User.php');

// Add User
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cedula = $_POST['cedula'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $telefono = $_POST['telefono'];
    $perfil = $_POST['perfil'];

    $objConexion = new ConexionDB();
    $objUser = new Usuario($objConexion);

    $objUser->setCedula($cedula);
    $objUser->setFirstName($firstName);
    $objUser->setLastName($lastName);
    $objUser->setEmail($email);
    $objUser->setPassword($password);
    $objUser->setTelefono($telefono);
    $objUser->setPerfil($perfil);
    $objUser->registrarUsuario();
    $response = array('success' => true, 'message' => 'Usuario agregado correctamente');
    echo json_encode($response);
    exit;
}

// Listar Usuarios
else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $objConexion = new ConexionDB();
    $objUser = new Usuario($objConexion);
    $array = $objUser->listarUsuario();
    echo json_encode($array);
    exit;
}

// Editar Usuario
else if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);

    error_log(print_r($data, true)); // Agregar esta línea para verificar los datos recibidos

    $id = intval($data['id']);
    $field = $data['field'];
    $newValue = $data['newValue'];

    $objConexion = new ConexionDB();
    $objUser = new Usuario($objConexion);

    $objUser->setId($id);
    $result = $objUser->updateField($field, $newValue);

    if ($result) {
        $response = array('success' => true, 'message' => 'Usuario actualizado correctamente');
    } else {
        $response = array('success' => false, 'message' => 'Error al actualizar el usuario');
    }

    echo json_encode($response);
    exit;
}

// Eliminar Usuario
else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $id = intval($_GET['id']);
    $objConexion = new ConexionDB();
    $objUser = new Usuario($objConexion);

    $objUser->setId($id);
    $result = $objUser->eliminarUsuario();

    if ($result) {
        $response = array('success' => true, 'message' => 'Usuario eliminado correctamente');
    } else {
        $response = array('success' => false, 'message' => 'Error al eliminar el usuario');
    }

    echo json_encode($response);
    exit;
}

// Login Usuario
else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
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
