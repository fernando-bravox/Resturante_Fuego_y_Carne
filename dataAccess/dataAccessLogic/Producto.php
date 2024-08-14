<?php
include ('../dataAccess/conexion/Conexion.php');

class Producto
{
    // Atributos
    private $id;
    private $nombre_producto;
    private $descripcion_producto;
    private $precio_producto;
    private $imagen_producto;
    private $categoria_id;

    private $connectionDB;

    // Constructor para conectar a la db
    public function __construct(ConexionDB $connectionDB)
    {
        $this->connectionDB = $connectionDB->connect();
    }

    // Métodos Get y Set para cada atributo
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setNombre(string $nombre_producto): void
    {
        $this->nombre_producto = $nombre_producto;
    }

    public function getNombre(): string
    {
        return $this->nombre_producto;
    }

    public function setDescripcion(string $descripcion_producto): void
    {
        $this->descripcion_producto = $descripcion_producto;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion_producto;
    }

    public function setPrecio(float $precio_producto): void
    {
        $this->precio_producto = $precio_producto;
    }

    public function getPrecio(): float
    {
        return $this->precio_producto;
    }

    public function setImagen(string $imagen_producto): void
    {
        $this->imagen_producto = $imagen_producto;
    }

    public function getImagen(): string
    {
        return $this->imagen_producto;
    }

    public function setCategoriaId(int $categoria_id): void
    {
        $this->categoria_id = $categoria_id;
    }

    public function getCategoriaId(): int
    {
        return $this->categoria_id;
    }

    // Método para agregar un producto Osea para que detecte el sql y execute, 
    // que sirve para que decte los get, es dond creamos las funciones. Que aga cambios en la tabla de la db
    public function agregarProducto(): bool
    {
        try {
            $sql = "INSERT INTO productos (nombre_producto, descripcion_producto, precio_producto, imagen_producto, categoria_id) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->connectionDB->prepare($sql);
            $stmt->execute([$this->getNombre(), $this->getDescripcion(), $this->getPrecio(), $this->getImagen(), $this->getCategoriaId()]);
            $count = $stmt->rowCount();
            return $this->affectedColumns($count);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Método para listar todos los productos
    public function listarProductos()
    {
        try {
            $sql = "SELECT * FROM productos";
            $stmt = $this->connectionDB->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $arrayQuery = $stmt->fetchAll();
            return $arrayQuery;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return [];
    }

    // Método para eliminar un producto
    public function eliminarProducto(): bool
    {
        try {
            $sql = "DELETE FROM productos WHERE id=?";
            $stmt = $this->connectionDB->prepare($sql);
            $stmt->execute([$this->getId()]);
            $count = $stmt->rowCount();
            return $this->affectedColumns($count);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Método para actualizar un producto, el set dirve para asignar un valor nuevo para la db
    public function actualizarProducto(): bool
    {
        try {
            $sql = "UPDATE productos SET nombre_producto = ?, descripcion_producto = ?, precio_producto = ?, imagen_producto = ?, categoria_id = ? WHERE id = ?";
            $stmt = $this->connectionDB->prepare($sql);
            $stmt->execute([$this->getNombre(), $this->getDescripcion(), $this->getPrecio(), $this->getImagen(), $this->getCategoriaId(), $this->getId()]);
            $count = $stmt->rowCount();
            return $this->affectedColumns($count);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Método auxiliar para verificar columnas afectadas
    private function affectedColumns($numer): bool
    {
        return ($numer !== null && $numer > 0);
    }
}
?>