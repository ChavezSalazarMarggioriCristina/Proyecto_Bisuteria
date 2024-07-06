<?php
class Carrito {
    private $id;
    private $productos = [];
    private $total;

    public function __construct($id, $total) {
        $this->id = $id;
        $this->total = $total;
    }

    public function agregarProducto($producto) {
        $this->productos[] = $producto;
        $this->calcularTotal();
    }

    public function calcularTotal() {
        $this->total = 0;
        foreach ($this->productos as $producto) {
            $this->total += $producto->getPrecio();
        }
    }
}
