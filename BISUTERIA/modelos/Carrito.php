<?php
require_once "Conn.php";

class Carrito {
    private $productos = [];

    public function agregarProducto($producto) {
        $this->productos[] = $producto;
    }

    public function calcularTotal() {
        $total = 0;
        foreach ($this->productos as $producto) {
            $total += $producto->getPrecio();
        }
        return $total;
    }

    public function getProductos() {
        return $this->productos;
    }
}
?>
