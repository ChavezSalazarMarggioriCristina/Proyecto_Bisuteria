<?php
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

    public function revisarPedido($pedido) {
    }
}
