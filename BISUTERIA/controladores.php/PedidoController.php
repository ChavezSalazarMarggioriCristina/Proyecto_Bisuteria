<?php
class PedidoController {
    public function crearPedido($data) {
        $cliente = $this->obtenerClientePorId($data['clienteId']);
        $pedido = new Pedido($data['id'], $cliente, $data['fecha'], $data['total'], $data['estado']);
        // Guardar el pedido en la base de datos
    }

    public function confirmarPago($pedidoId) {
        $pedido = $this->obtenerPedidoPorId($pedidoId);
        $pedido->confirmarPago();
        // Actualizar estado del pedido en la base de datos
    }

    private function obtenerPedidoPorId($id) {
        // Lógica para obtener el pedido por ID
    }

    private function obtenerClientePorId($id) {
        // Lógica para obtener el cliente por ID
    }
}
