<?php
require_once "Conn.php";

class Cliente {
    private $id;
    private $nombres;
    private $apellido;
    private $email;
    private $telefono;
    private $carrito;

    public function __construct($id = null, $nombres = null, $apellido = null, $email = null, $telefono = null) {
        $this->id = $id;
        $this->nombres = $nombres;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->carrito = new Carrito();
    }

    public function seleccionarProducto($productoId) {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM producto WHERE id = " . $productoId;
        $stmt = $conexion->query($sql);

        $producto = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn->cerrar();

        if ($producto && $producto['stock'] > 0) {
            return $producto;
        } else {
            throw new Exception("El producto no está disponible.");
        }
    }

    public function agregarAlCarrito($productoId) {
        $producto = $this->seleccionarProducto($productoId);
        $this->carrito->agregarProducto(new Producto($producto['id'], $producto['nombre'], $producto['precio'], $producto['stock']));
    }

    public function guardar(string $nombres, string $apellido, string $email, string $telefono) {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "INSERT INTO cliente (nombres, apellido, email, telefono) VALUES ('" . $nombres . "', '" . $apellido . "', '" . $email . "', '" . $telefono . "')";
        $resultado = $conexion->exec($sql);
        $conn->cerrar();
        if ($resultado) {
            $this->id = $conexion->lastInsertId(); 
        }
        return $resultado;
    }

    public function confirmarPedido() {
        $total = $this->carrito->calcularTotal();
        if ($total > 0) {
            $conn = new Conn();
            $conexion = $conn->conectar();

            $sql = "INSERT INTO pedido (cliente_id, total, estado) VALUES (" . $this->id . ", " . $total . ", 'pendiente')";
            $resultado = $conexion->exec($sql);
            $pedidoId = $conexion->lastInsertId();
            $conn->cerrar();

            if ($resultado) {
                foreach ($this->carrito->getProductos() as $producto) {
                    $this->guardarDetallePedido($pedidoId, $producto);
                }
                echo "Pedido confirmado. Total: $total";
            } else {
                throw new Exception("Error al confirmar el pedido.");
            }
        } else {
            throw new Exception("El carrito está vacío.");
        }
    }

    private function guardarDetallePedido($pedidoId, Producto $producto) {
        $conn = new Conn();
        $conexion = $conn->conectar();

        $sql = "INSERT INTO detalle_pedido (pedido_id, producto_id, precio) VALUES (" . $pedidoId . ", " . $producto->getId() . ", " . $producto->getPrecio() . ")";
        $conexion->exec($sql);
        $conn->cerrar();
    }

    public function realizarPago($metodoPago) {
        $total = $this->carrito->calcularTotal();
        if ($total > 0) {
            $conn = new Conn();
            $conexion = $conn->conectar();

            $sql = "INSERT INTO pago (cliente_id, monto, metodo, estado) VALUES (" . $this->id . ", " . $total . ", '" . $metodoPago . "', 'completado')";
            $resultado = $conexion->exec($sql);
            $conn->cerrar();

            if ($resultado) {
                echo "Pago realizado con $metodoPago por un total de $total.";
            } else {
                throw new Exception("Error al realizar el pago.");
            }
        } else {
            throw new Exception("No hay productos en el carrito para pagar.");
        }
    }

    public function login($email, $password) {
        $conn = new Conn();
        $conexion = $conn->conectar();

        $sql = "SELECT * FROM cliente WHERE email = '" . $email . "' AND password = '" . $password . "'";
        $stmt = $conexion->query($sql);
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn->cerrar();

        if ($cliente) {
            $this->id = $cliente['id'];
            $this->nombres = $cliente['nombres'];
            $this->apellido = $cliente['apellido'];
            $this->email = $cliente['email'];
            $this->telefono = $cliente['telefono'];
            return true;
        } else {
            throw new Exception("Email o contraseña incorrectos.");
        }
    }

    public function obtenerClientePorId($id) {
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
}
