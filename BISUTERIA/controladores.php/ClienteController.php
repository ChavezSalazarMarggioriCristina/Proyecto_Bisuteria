<?php
    require_once "modelos/Cliente.php";
    require_once "modelos/Administrador.php";

    /*class ClienteController {
    public function crearCliente($data) {
        $cliente = new Cliente(null, $data['nombres'], $data['apellido'], $data['email'], $data['telefono']);
        $cliente->guardar($data['nombres'], $data['apellido'], $data['email'], $data['telefono']);
        return $cliente;
    }*/


    class ClienteController {
        public function guardar($nombre, $apellido, $email, $telefono, $tipo) {
            if ($tipo == 'cliente') {
                $cliente = new Cliente($nombre, $apellido, $email, $telefono);
                $cliente->registrar();
            } else if ($tipo == 'administrador') {
                $administrador = new Administrador($nombre, $apellido, $email, $telefono);
                $administrador->registrar();
            }
        }
    }

    public function agregarProductoAlCarrito($clienteId, $productoId) {
        $cliente = $this->obtenerClientePorId($clienteId);
        $cliente->agregarAlCarrito($productoId);
    }

    public function confirmarPedido($clienteId) {
        $cliente = $this->obtenerClientePorId($clienteId);
        $cliente->confirmarPedido();
    }

    public function realizarPago($clienteId, $metodoPago) {
        $cliente = $this->obtenerClientePorId($clienteId);
        $cliente->realizarPago($metodoPago);
    }

    public function login($email, $password) {
        $cliente = new Cliente();
        return $cliente->login($email, $password);
    }

    private function obtenerClientePorId($id) {
        $conn = new Conn();
        $conexion = $conn->conectar();

        $sql = "SELECT * FROM cliente WHERE id = " . $id;
        $stmt = $conexion->query($sql);
        $clienteData = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn->cerrar();

        if ($clienteData) {
            return new Cliente($clienteData['id'], $clienteData['nombres'], $clienteData['apellido'], $clienteData['email'], $clienteData['telefono']);
        } else {
            throw new Exception("Cliente no encontrado.");
        }
    }

    private function obtenerProductoPorId($id) {
        $conn = new Conn();
        $conexion = $conn->conectar();

        $sql = "SELECT * FROM producto WHERE id = " . $id;
        $stmt = $conexion->query($sql);
        $productoData = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn->cerrar();

        if ($productoData) {
            return new Producto($productoData['id'], $productoData['nombre'], $productoData['precio'], $productoData['stock']);
        } else {
            throw new Exception("Producto no encontrado.");
        }
    }
    
?>

