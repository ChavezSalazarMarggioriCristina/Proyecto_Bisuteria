<?php
class SistemaDePedidos {
    public function verificarDisponibilidad($producto) {
        return $producto->verificarDisponibilidad();
    }

    public function calcularTotal($carrito) {
        $carrito->calcularTotal();
    }

    public function confirmarPago($pedido) {
        $pedido->confirmarPago();
    }

    public function enviarConfirmacion($pedido) {
        // Lógica para enviar confirmación del pedido
    }
}
