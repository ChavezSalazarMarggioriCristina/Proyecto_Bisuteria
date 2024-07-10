<?php
require_once __DIR__ . "/modelos/SeleccionarProducto.php";

class ProductoController {
    private $seleccionarProducto;

    public function __construct() {
        $this->seleccionarProducto = new SeleccionarProducto();
    }

    public function mostrar() {
        return $this->seleccionarProducto->obtenerTodosLosProductos();
    }
}
?>

