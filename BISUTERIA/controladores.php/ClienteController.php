<?php
class ClienteController {
    public function crearCliente($data) {
        $cliente = new Cliente($data['id'], $data['nombres'], $data['apellido'], $data['email'], $data['telefono']);
        // Guardar el cliente en la base de datos
    }

    public function agregarProductoAlCarrito($clienteId, $productoId) {
        $cliente = $this->obtenerClientePorId($clienteId);
        $producto = $this->obtenerProductoPorId($productoId);
        $cliente->agregarAlCarrito($producto);
        // Actualizar carrito en la base de datos
    }

    private function obtenerClientePorId($id) {
        // Lógica para obtener el cliente por ID
    }

    private function obtenerProductoPorId($id) {
        // Lógica para obtener el producto por ID
    }
}
