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
        $this->total = $this->cliente->getCarrito()->calcularTotal();
    }

    public function confirmarPago() {
        $this->estado = 'pagado';
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
}
?>
