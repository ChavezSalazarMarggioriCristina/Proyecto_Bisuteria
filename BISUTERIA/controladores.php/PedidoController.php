<?php
class PedidoController {
    public function crearPedido($data) {
        $cliente = $this->obtenerClientePorId($data['clienteId']);
        $pedido = new Pedido(null, $cliente, $data['fecha'], $data['total'], 'pendiente');
        $this->guardarPedido($pedido);
        return $pedido;
    }

    public function confirmarPago($pedidoId) {
        $pedido = $this->obtenerPedidoPorId($pedidoId);
        $pedido->confirmarPago();
        $this->actualizarEstadoPedido($pedidoId, 'pagado');
    }

    private function obtenerPedidoPorId($id) {
        $conn = new Conn();
        $conexion = $conn->conectar();

        $sql = "SELECT * FROM pedido WHERE id = " . $id;
        $stmt = $conexion->query($sql);
        $pedidoData = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn->cerrar();

        if ($pedidoData) {
            $cliente = $this->obtenerClientePorId($pedidoData['cliente_id']);
            return new Pedido($pedidoData['id'], $cliente, $pedidoData['fecha'], $pedidoData['total'], $pedidoData['estado']);
        } else {
            throw new Exception("Pedido no encontrado.");
        }
    }

    private function obtenerClientePorId($id) {
        $conn = new Conn();
        $conexion = $conn->conectar();

        $sql = "SELECT * FROM cliente WHERE id = " . $id;
        $stmt = $conexion->query($sql);
        $clienteData = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn->cerrar();

        if ($clienteData) {
            return new Cliente($clienteData['id'], $clienteData['nombres'], $clienteData['apellido'], $clienteData['email'], $clienteData['telefono']);
        } else {
            throw new Exception("Cliente no encontrado.");
        }
    }

    private function guardarPedido(Pedido $pedido) {
        $conn = new Conn();
        $conexion = $conn->conectar();

        $sql = "INSERT INTO pedido (cliente_id, fecha, total, estado) VALUES (" .
            $pedido->getCliente()->getId() . ", '" .
            $pedido->getFecha() . "', " .
            $pedido->getTotal() . ", '" .
            $pedido->getEstado() . "')";

        $resultado = $conexion->exec($sql);
        $conn->cerrar();

        if ($resultado) {
            $pedido->setId($conexion->lastInsertId());
        } else {
            throw new Exception("Error al guardar el pedido.");
        }
    }

    private function actualizarEstadoPedido($pedidoId, $estado) {
        $conn = new Conn();
        $conexion = $conn->conectar();

        $sql = "UPDATE pedido SET estado = '" . $estado . "' WHERE id = " . $pedidoId;
        $resultado = $conexion->exec($sql);
        $conn->cerrar();

        if (!$resultado) {
            throw new Exception("Error al actualizar el estado del pedido.");
        }
    }
}
?>
