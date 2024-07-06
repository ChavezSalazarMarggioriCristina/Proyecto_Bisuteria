<form method="post" action=<?php echo $_SERVER["PHP_SELF"];?>>
    <input type="text" name="nombre" placeholder="Ingrese su nombre"> <br>
    <input type="password" name="apellido" placeholder="Ingrese su apellido"> <br>
    <input type="text" name="email" placeholder="Ingrese email"> <br>
    <input type="text" name="telefono" placeholder="Ingrese telefono"> <br>
    <select name="tipo" >
    <option value="cliente">cliente</option>  
    <option value="administrador">administrador</option>  
    </select>
    <input type="submit" name="submit" value="guardar" >
</form>


<?php
if (isset($_POST['submit'])) {
    $username = $_POST["nombre"];
    $password = $_POST["apellido"];
    $nombres = $_POST["email"];
    $apellidos = $_POST["telefono"];
    $tipo = $_POST["tipo"];
    require_once "ClienteController.php";
    $uc = new UsuarioController();
    $uc->guardar($username,$password,$nombres,$apellidos,$tipo);
}



private $id;
    private $nombres;
    private $apellido;
    private $email;
    private $telefono;