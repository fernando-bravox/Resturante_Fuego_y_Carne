<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ('../dataAccess/conexion/Conexion.php');

class Reservas
{
    private $id;
    private $usuario_id;
    private $productos;
    private $total;
    private $fecha;
    private $comprobante;

    private $connectionDB;

    public function __construct(ConexionDB $connectionDB)
    {
        $this->connectionDB = $connectionDB->connect();
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setUsuarioId(int $usuario_id): void
    {
        $this->usuario_id = $usuario_id;
    }

    public function getUsuarioId(): int
    {
        return $this->usuario_id;
    }

    public function setProductos(array $productos): void
    {
        $this->productos = json_encode($productos);
    }

    public function getProductos(): array
    {
        return json_decode($this->productos, true);
    }

    public function setTotal(float $total): void
    {
        $this->total = $total;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function setFecha(string $fecha): void
    {
        $this->fecha = $fecha;
    }

    public function getFecha(): string
    {
        return $this->fecha;
    }

    public function setComprobante(string $comprobante): void
    {
        $this->comprobante = $comprobante;
    }

    public function getComprobante(): ?string
    {
        return $this->comprobante;
    }

    public function agregarReserva(): bool
    {
        try {
            $sql = "INSERT INTO reservas (usuario_id, productos, total) VALUES (?, ?, ?)";
            $stmt = $this->connectionDB->prepare($sql);
            $stmt->execute([$this->getUsuarioId(), $this->productos, $this->getTotal()]);
            return true;
        } catch (PDOException $e) {
            echo "Error en agregarReserva: " . $e->getMessage();
            return false;
        }
    }

    public function listarReservas()
    {
        try {
            $sql = "SELECT * FROM reservas";
            $stmt = $this->connectionDB->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $arrayQuery = $stmt->fetchAll();
            return $arrayQuery;
        } catch (PDOException $e) {
            echo "Error en listarReservas: " . $e->getMessage();
        }
        return [];
    }

    public function actualizarComprobante(int $id, string $comprobante): bool
    {
        try {
            $sql = "UPDATE reservas SET comprobante = ? WHERE id = ?";
            $stmt = $this->connectionDB->prepare($sql);
            $stmt->execute([$comprobante, $id]);
            return true;
        } catch (PDOException $e) {
            echo "Error en actualizarComprobante: " . $e->getMessage();
            return false;
        }
    }
}
?>
