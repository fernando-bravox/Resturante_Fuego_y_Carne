<?php
include ('../dataAccess/conexion/Conexion.php');
class Categoria
{
    // Atributos
    private int $id;
    private string $nombre_categoria;
    private string $descripcion_categoria;
    private string $imagen_categoria;

    private $connectionDB;

    // Constructor
    public function __construct(ConexionDB $connectionDB)
    {
        $this->connectionDB = $connectionDB->connect();
    }

    // Métodos Get y Set para cada propiedad
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setNombre(string $nombre_categoria): void
    {
        $this->nombre_categoria = $nombre_categoria;
    }

    public function getNombre(): string
    {
        return $this->nombre_categoria;
    }

    public function setDescripcion(string $descripcion_categoria): void
    {
        $this->descripcion_categoria = $descripcion_categoria;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion_categoria;
    }

    public function setImagen(string $imagen_categoria): void
    {
        $this->imagen_categoria = $imagen_categoria;
    }

    public function getImagen(): string
    {
        return $this->imagen_categoria;
    }

    // Método para agregar una categoría
    public function agregarCategoria(): bool
    {
        try {
            $sql = "INSERT INTO categorias (nombre_categoria, descripcion_categoria, imagen_categoria) VALUES (?, ?, ?)";
            $stmt = $this->connectionDB->prepare($sql);
            $stmt->execute(array($this->getNombre(), $this->getDescripcion(), $this->getImagen()));
            $count = $stmt->rowCount();
            return $this->affectedColumns($count);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Método para listar todas las categorías
    public function listarCategorias()
    {
        try {
            $sql = "SELECT * FROM categorias";
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

    // Método para eliminar una categoría
    public function eliminarCategoria(): bool
    {
        try {
            $sql = "DELETE FROM categorias WHERE id=?";
            $stmt = $this->connectionDB->prepare($sql);
            $stmt->execute(array($this->getId()));
            $count = $stmt->rowCount();
            return $this->affectedColumns($count);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Método para actualizar una categoría
    public function actualizarCategoria(): bool
    {
        try {
            $sql = "UPDATE categorias SET nombre_categoria = ?, descripcion_categoria = ?, imagen_categoria = ? WHERE id = ?";
            $stmt = $this->connectionDB->prepare($sql);
            $stmt->execute(array($this->getNombre(), $this->getDescripcion(), $this->getImagen(), $this->getId()));
            $count = $stmt->rowCount();
            return $this->affectedColumns($count);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Método auxiliar para verificar columnas afectadas
    public function affectedColumns($numer): bool
    {
        if ($numer<>null && $numer>0) {
            $msm=true;
        } else {
            $msm=false;
        }
        return $msm;
    }
}
?>
