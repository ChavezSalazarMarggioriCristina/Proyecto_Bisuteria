<?php
require_once "Conn.php";

class Empleado {
    private $id;
    private $nombre;
    private $apellido;
    private $email;

    public function __construct($id, $nombre, $apellido, $email) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
    }

    public function verificarPedido($pedidoId) {
        $conn = new Conn();
        $conexion = $conn->conectar();

        $sql = "SELECT * FROM pedido WHERE id = :pedido_id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':pedido_id', $pedidoId, PDO::PARAM_INT);
        $stmt->execute();

        $pedido = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($pedido) {
            if ($pedido['estado'] == 'pendiente') {
                $this->asignarPedidoAOtroEmpleado($pedidoId);
                return true; 
            } else {
                throw new Exception("El pedido no está pendiente.");
            }
        } else {
            throw new Exception("Pedido no encontrado.");
        }
    }

    private function asignarPedidoAOtroEmpleado($pedidoId) {
        $conn = new Conn();
        $conexion = $conn->conectar();

        $sql = "UPDATE pedido SET asignado_a = :empleado_id WHERE id = :pedido_id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':empleado_id', $this->id, PDO::PARAM_INT);
        $stmt->bindParam(':pedido_id', $pedidoId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
}
?>
