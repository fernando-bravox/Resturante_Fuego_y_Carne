<?php
include ('../dataAccess/conexion/Conexion.php');

class Usuario
{
    private int $id;
    private string $cedula;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $password;
    private string $telefono;
    private string $perfil;

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
    public function setCedula(string $cedula): void
    {
        $this->cedula = $cedula;
    }

    public function getCedula(): string
    {
        return $this->cedula;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setTelefono(string $telefono): void
    {
        $this->telefono = $telefono;
    }

    public function getTelefono(): string
    {
        return $this->telefono;
    }

    public function setPerfil(string $perfil): void
    {
        $this->perfil = $perfil;
    }

    public function getPerfil(): string
    {
        return $this->perfil;
    }

    public function registrarUsuario(): bool
    {
        try {
            $sql = "INSERT INTO usuarios (cedula, firstName, lastName, email, password, telefono, perfil) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connectionDB->prepare($sql);
            $stmt->execute(array($this->getCedula(), $this->getFirstName(), $this->getLastName(), $this->getEmail(), $this->getPassword(), $this->getTelefono(), $this->getPerfil()));
            $count = $stmt->rowCount();
            return $this->affectedColumns($count);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function listarUsuario()
    {
        try {
            $sql = "SELECT * FROM usuarios";
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

    public function eliminarUsuario(): bool
    {
        try {
            $sql = "DELETE FROM usuarios WHERE id=?";
            $stmt = $this->connectionDB->prepare($sql);
            $stmt->execute(array($this->getId()));
            $count = $stmt->rowCount();
            return $this->affectedColumns($count);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function editarUsuario(): bool
    {
        try {
            $sql = "UPDATE usuarios SET cedula = ?, firstName = ?, lastName = ?, password = ?, telefono = ?, perfil = ? WHERE id = ?";
            $stmt = $this->connectionDB->prepare($sql);
            $stmt->execute(array($this->getCedula(), $this->getFirstName(), $this->getLastName(), $this->getPassword(), $this->getTelefono(), $this->getPerfil(), $this->getId()));
            $count = $stmt->rowCount();
            return $this->affectedColumns($count);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateField(string $field, string $newValue): bool
    {
        try {
            $sql = "UPDATE usuarios SET $field = ? WHERE id = ?";
            $stmt = $this->connectionDB->prepare($sql);
            $stmt->execute(array($newValue, $this->getId()));
            $count = $stmt->rowCount();
            return $this->affectedColumns($count);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function affectedColumns($numer): bool
    {
        return ($numer <> null && $numer > 0);
    }

    public function login(string $email, string $password)
    {
        try {
            $sql = "SELECT * FROM usuarios WHERE email = ? AND password = ?";
            $stmt = $this->connectionDB->prepare($sql);
            $stmt->execute(array($email, $password));
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
?>
