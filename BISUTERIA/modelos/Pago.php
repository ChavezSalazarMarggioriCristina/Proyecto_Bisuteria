<?php
class Pago {
    private $id;
    private $monto;
    private $metodo;
    private $estado;

    public function __construct($id, $monto, $metodo, $estado) {
        $this->id = $id;
        $this->monto = $monto;
        $this->metodo = $metodo;
        $this->estado = $estado;
    }

    public function realizarPago() {
        // Lógica para realizar el pago
    }

    public function confirmarPago() {
        // Lógica para confirmar el pago
    }
}
