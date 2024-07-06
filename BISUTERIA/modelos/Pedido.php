<?php
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

    public function calcularTotal() {
        // Lógica para calcular el total
    }

    public function confirmarPago() {
        // Lógica para confirmar el pago
    }
}
