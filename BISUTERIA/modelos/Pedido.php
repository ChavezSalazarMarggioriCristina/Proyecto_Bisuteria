<?php
require_once "Conn.php";

class Pedido {
    private $id;
    private $cliente;
    private $fecha;
    private $total;
    private $estado;

    public function __construct($id, $cliente, $fecha, $total, $estado) {
        $this->id = $id;
        $this->cliente = $cliente;
        $this->fecha = $fecha;
        $this->total = $total;
        $this->estado = $estado;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getCliente() {
        return $this->cliente;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getTotal() {
        return $this->total;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function calcularTotal() {
         $carrito = $this->cliente->getCarrito();
    
        $total = 0;
        foreach ($carrito->getProductos() as $producto) {
            $total += $producto->getPrecio();
        }
        $this->total = $total;
    }

    public function confirmarPago() {
        $this->estado = 'pagado';
    
        try {
            $conn = new Conn();
            $conexion = $conn->conectar();
    
            $sql = "UPDATE pedido SET estado = 'pagado' WHERE id = :pedido_id";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':pedido_id', $this->id, PDO::PARAM_INT);
            $stmt->execute();
    
            $conn->cerrar();
        } catch (PDOException $e) {
            throw new Exception("Error al actualizar el estado del pedido: " . $e->getMessage());
        }
    
        $clienteEmail = $this->cliente->getEmail();
        $mensaje = "Hola " . $this->cliente->getNombre() . ", tu pedido ha sido pagado y confirmado.";
    
        $enviado = $this->enviarCorreo($clienteEmail, 'Confirmación de Pago', $mensaje);
    
        if ($enviado) {
            echo "Se ha enviado un correo de confirmación al cliente.";
        } else {
            echo "No se pudo enviar el correo de confirmación.";
        }
    }
    
    private function enviarCorreo($email, $asunto, $mensaje) {
        $cabeceras = "From: tu@email.com";
        return mail($email, $asunto, $mensaje, $cabeceras);
    }
}
