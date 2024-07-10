<?php
require_once "Conn.php";

class Administrador {
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

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getEmail() {
        return $this->email;
    }

    public function revisarPedido($pedido) {
        echo "Pedido revisado por " . $this->nombre . " " . $this->apellido . ".";
    }
}
?>
