<?php
class Cliente {
    private $id;
    private $nombres;
    private $apellido;
    private $email;
    private $telefono;

    public function __construct($id, $nombres, $apellido, $email, $telefono) {
        $this->id = $id;
        $this->nombres = $nombres;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->telefono = $telefono;
    }

    public function seleccionarProducto() {
        /$conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "INSERT INTO usuario(username,password,nombres,apellidos,tipo,id_escuela) VALUES ('$username','$password','$nombres','$apellidos','$tipo','$id_escuela')";
        $resultado = $conexion->exec($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function agregarAlCarrito($producto) {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "INSERT INTO usuario(username,password,nombres,apellidos,tipo,id_escuela) VALUES ('$username','$password','$nombres','$apellidos','$tipo','$id_escuela')";
        $resultado = $conexion->exec($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function confirmarPedido() {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "INSERT INTO usuario(username,password,nombres,apellidos,tipo,id_escuela) VALUES ('$username','$password','$nombres','$apellidos','$tipo','$id_escuela')";
        $resultado = $conexion->exec($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function realizarPago() {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "INSERT INTO usuario(username,password,nombres,apellidos,tipo,id_escuela) VALUES ('$username','$password','$nombres','$apellidos','$tipo','$id_escuela')";
        $resultado = $conexion->exec($sql);
        $conn->cerrar();
        return $resultado;
    }
}
