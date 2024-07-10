<?php
require_once "Conn.php";

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
}
