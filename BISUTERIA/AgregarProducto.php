<?php
class AgregarProducto {
    private $producto;

    public function __construct($producto) {
        $this->producto = $producto;
    }

    public function agregar() {
       
        $db = new Conexion();
        $query = "INSERT INTO productos (nombre, precio, cantidad) VALUES ('{$this->producto['nombre']}', '{$this->producto['precio']}', '{$this->producto['cantidad']}')";
        $db->query($query);
    }
}
?>
