<?php
include ('../dataAccess/dataAccessLogic/Producto.php');

// Manejar método DELETE - Eliminar producto
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $id = intval($_GET['id']);
    $objConexion = new ConexionDB();
    $objProducto = new Producto($objConexion);
    $objProducto->setId($id);
    if ($objProducto->eliminarProducto()) {
        $response = array('success' => true, 'message' => 'Producto eliminado correctamente');
    } else {
        $response = array('success' => false, 'message' => 'Error al eliminar el producto');
    }
    echo json_encode($response);
    exit();
}

// Manejar método POST - Agregar producto
else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $directorio = "imagenes/";
    $nombreArchivo = $_FILES['imagen_producto']['name'];
    $rutaTemporal = $_FILES['imagen_producto']['tmp_name'];
    $rutaDefinitiva = $directorio . $nombreArchivo;

    if (!file_exists($directorio)) {
        mkdir($directorio, 0777);
    }

    move_uploaded_file($rutaTemporal, $rutaDefinitiva);

    $nombre_producto = $_POST['nombre_producto'];
    $descripcion_producto = $_POST['descripcion_producto'];
    $precio_producto = $_POST['precio_producto'];
    $imagen_producto = $rutaDefinitiva;
    $categoria_id = $_POST['categoria_id'];

    $objConexion = new ConexionDB();
    $objProducto = new Producto($objConexion);

    $objProducto->setNombre($nombre_producto);
    $objProducto->setDescripcion($descripcion_producto);
    $objProducto->setPrecio($precio_producto);
    $objProducto->setImagen($imagen_producto);
    $objProducto->setCategoriaId($categoria_id);

    if ($objProducto->agregarProducto()) {
        $response = array('success' => true, 'message' => 'Producto agregado correctamente');
    } else {
        $response = array('success' => false, 'message' => 'Error al agregar el producto');
    }
    echo json_encode($response);
    exit();
}

// Manejar método GET - Listar productos
else if ($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_GET['id'])) {
    $objConexion = new ConexionDB();
    $objProducto = new Producto($objConexion);
    $array = $objProducto->listarProductos();
    echo json_encode($array);
    exit();
}

// Manejar método GET con ID - Obtener un producto específico
else if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $objConexion = new ConexionDB();
    $objProducto = new Producto($objConexion);
    $objProducto->setId($id);
    $producto = $objProducto->listarProductos();
    echo json_encode($producto[0]);
    exit();
}

// Manejar método PUT - Actualizar producto
else if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);

    $id = isset($data['id']) ? intval($data['id']) : null;
    $nombre_producto = isset($data['nombre_producto']) ? $data['nombre_producto'] : null;
    $descripcion_producto = isset($data['descripcion_producto']) ? $data['descripcion_producto'] : null;
    $precio_producto = isset($data['precio_producto']) ? $data['precio_producto'] : null;
    $imagen_producto = isset($data['imagen_producto']) ? $data['imagen_producto'] : null;
    $categoria_id = isset($data['categoria_id']) ? $data['categoria_id'] : null;

    if (is_null($id) || is_null($nombre_producto) || is_null($descripcion_producto) || is_null($precio_producto) || is_null($imagen_producto) || is_null($categoria_id)) {
        $response = array('success' => false, 'message' => 'Faltan datos para actualizar el producto');
        echo json_encode($response);
        exit();
    }

    $objConexion = new ConexionDB();
    $objProducto = new Producto($objConexion);

    $objProducto->setId($id);
    $objProducto->setNombre($nombre_producto);
    $objProducto->setDescripcion($descripcion_producto);
    $objProducto->setPrecio($precio_producto);
    $objProducto->setImagen($imagen_producto);
    $objProducto->setCategoriaId($categoria_id);

    if ($objProducto->actualizarProducto()) {
        $response = array('success' => true, 'message' => 'Producto actualizado correctamente');
    } else {
        $response = array('success' => false, 'message' => 'Error al actualizar el producto');
    }
    echo json_encode($response);
    exit();
}
?>
