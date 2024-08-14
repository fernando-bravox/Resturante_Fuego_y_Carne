<?php
include ('../dataAccess/dataAccessLogic/Categoria.php');

// Manejar método DELETE - Eliminar categoría
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Obtener el ID de la categoría a eliminar
    $id = intval($_GET['id']);
    $objConexion = new ConexionDB();
    $objCategoria = new Categoria($objConexion);


    // Establecer el ID en el objeto de categoría
    $objCategoria->setId($id);
    // Llamar al método para eliminar la categoría
    $objCategoria->eliminarCategoria();
    $response = array('sucess'=>true,'message'=>'Categoria eliminado correctamente');
    exit();
}

// Manejar método POST - Agregar categoría
else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $directorio="imagenes/";
    $nombreArchivo=$_FILES['imagen_categoria']['name'];
    $rutaTemporal=$_FILES['imagen_categoria']['tmp_name'];

    $rutaDefinitiva=$directorio.$nombreArchivo;

   

    if(!file_exists($directorio)){
        mkdir($directorio,0777);
    }

    move_uploaded_file($rutaTemporal,$rutaDefinitiva);



    // Obtener datos del formulario
    $nombre_categoria = $_POST['nombre_categoria'];
    $descripcion_categoria = $_POST['descripcion_categoria'];
    $imagen_categoria = $rutaDefinitiva; // Aquí deberías manejar la lógica de subir y guardar la imagen si es necesario

    $objConexion = new ConexionDB();
    $objCategoria = new Categoria($objConexion);


    // Setear datos en el objeto de categoría
    $objCategoria->setNombre($nombre_categoria);
    $objCategoria->setDescripcion($descripcion_categoria);
    $objCategoria->setImagen($imagen_categoria);
    // Llamar al método para agregar la categoría
    $objCategoria->agregarCategoria();
    exit();
}

// Manejar método GET - Listar categorías
else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $objConexion = new ConexionDB();
    $objCategoria= new Categoria($objConexion);
    $array = $objCategoria->listarCategorias();
    echo json_encode($array);
    exit;
}

// Manejar método PUT - Actualizar categoría
else if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    // Obtener datos JSON enviados
    $data = json_decode(file_get_contents('php://input'), true);

    // Obtener el ID de la categoría y otros datos a actualizar
    $id = intval($data['id']);
    $nombre_categoria = $data['nombre_categoria'];
    $descripcion_categoria = $data['descripcion_categoria'];
    $imagen_categoria = $data['imagen_categoria']; // Aquí también deberías manejar la lógica de la imagen si es necesaria+

    $objConexion = new ConexionDB();
    $objCategoria = new Categoria($objConexion);

    // Setear datos en el objeto de categoría
    $objCategoria->setId($id);
    $objCategoria->setNombre($nombre_categoria);
    $objCategoria->setDescripcion($descripcion_categoria);
    $objCategoria->setImagen($imagen_categoria);
    $objCategoria->actualizarCategoria();
    exit;
}

// Si no coincide con ningún método de solicitud, devolver Bad Request
header("HTTP/1.1 400 Bad Request");