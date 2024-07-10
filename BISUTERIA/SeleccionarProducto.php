<?php
require_once "Conn.php";
require_once "Producto.php";

class SeleccionarProducto {
    public function obtenerProductoPorId($id) {
        $conn = new Conn();
        $conexion = $conn->conectar();

        $sql = "SELECT * FROM productos WHERE id = " . $id;
        $stmt = $conexion->query($sql);
        $productoData = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn->cerrar();

        if ($productoData) {
            return new Producto($productoData['id'], $productoData['nombre'], $productoData['precio'], $productoData['stock']);
        } else {
            throw new Exception("Producto no encontrado.");
        }
    }

    public function obtenerTodosLosProductos() {
        $conn = new Conn();
        $conexion = $conn->conectar();

        $sql = "SELECT * FROM productos";
        $stmt = $conexion->query($sql);
        $productosData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn->cerrar();

        $productos = [];
        foreach ($productosData as $productoData) {
            $productos[] = new Producto($productoData['id'], $productoData['nombre'], $productoData['precio'], $productoData['stock']);
        }
        return $productos;
    }
}
?>

