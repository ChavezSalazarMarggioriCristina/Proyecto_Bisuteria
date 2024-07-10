<?php
require_once "Conn.php";

class Producto {
    private $id;
    private $nombre;
    private $precio;
    private $stock;

    public function __construct($id, $nombre, $precio, $stock) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->stock = $stock;
    }

    public function verificarDisponibilidad() {
        return $this->stock > 0;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getStock() {
        return $this->stock;
    }

    public function reducirStock($cantidad) {
        if ($cantidad > 0 && $cantidad <= $this->stock) {
            $this->stock -= $cantidad;
            return true;
        }
        return false; 
    }

    public function actualizarProducto($nombre, $precio, $stock) {
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->stock = $stock;
    }

    public static function validarDatos($nombre, $precio, $stock) {
        if (empty($nombre) || !is_numeric($precio) || !is_int($stock)) {
            throw new Exception("Los datos del producto no son válidos.");
        }
        return true;
    }

    public function obtenerInformacionDetallada() {
        return "ID: " . $this->id . ", Nombre: " . $this->nombre . ", Precio: " . $this->precio . ", Stock: " . $this->stock;
    }
}
