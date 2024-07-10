<?php
require_once "Conn.php";

class Pago {
    private $id;
    private $clienteId;
    private $monto;
    private $metodo;
    private $estado;

    public function __construct($id, $clienteId, $monto, $metodo, $estado) {
        $this->id = $id;
        $this->clienteId = $clienteId;
        $this->monto = $monto;
        $this->metodo = $metodo;
        $this->estado = $estado;
    }

    public function getId() {
        return $this->id;
    }

    public function getClienteId() {
        return $this->clienteId;
    }

    public function getMonto() {
        return $this->monto;
    }

    public function getMetodo() {
        return $this->metodo;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setClienteId($clienteId) {
        $this->clienteId = $clienteId;
    }

    public function setMonto($monto) {
        $this->monto = $monto;
    }

    public function setMetodo($metodo) {
        $this->metodo = $metodo;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function realizarPago() {
        try {
            $conn = new Conn();
            $conexion = $conn->conectar();

            $sql = "INSERT INTO pago (cliente_id, monto, metodo, estado) VALUES (:cliente_id, :monto, :metodo, :estado)";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':cliente_id', $this->clienteId, PDO::PARAM_INT);
            $stmt->bindParam(':monto', $this->monto, PDO::PARAM_STR);
            $stmt->bindParam(':metodo', $this->metodo, PDO::PARAM_STR);
            $stmt->bindParam(':estado', $this->estado, PDO::PARAM_STR);
            $stmt->execute();

            $this->id = $conexion->lastInsertId();

            $conn->cerrar();
        } catch (PDOException $e) {
            throw new Exception("Error al realizar el pago: " . $e->getMessage());
        }
    }

    public function confirmarPago() {
        try {
            $conn = new Conn();
            $conexion = $conn->conectar();

            $sql = "UPDATE pago SET estado = 'confirmado' WHERE id = :pago_id";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':pago_id', $this->id, PDO::PARAM_INT);
            $stmt->execute();

            $this->estado = 'confirmado';

            $conn->cerrar();
        } catch (PDOException $e) {
            throw new Exception("Error al confirmar el pago: " . $e->getMessage());
        }
    }
}
?>
