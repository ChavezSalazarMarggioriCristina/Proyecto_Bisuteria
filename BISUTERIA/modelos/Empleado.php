<?php
class Empleado {
    private $id;
    private $nombre;
    private $apellido;
    private $email;

    public function __construct($id, $nombre, $apellido, $email) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
    }

    public function verificarPedido($pedido) {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "INSERT INTO usuario(username,password,nombres,apellidos,tipo,id_escuela) VALUES ('$username','$password','$nombres','$apellidos','$tipo','$id_escuela')";
        $resultado = $conexion->exec($sql);
        $conn->cerrar();
        return $resultado;
    }
}
