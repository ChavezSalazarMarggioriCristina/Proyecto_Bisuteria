
<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
    <input type="text" name="nombres" placeholder="Ingrese su nombre"> <br>
    <input type="text" name="apellido" placeholder="Ingrese su apellido"> <br>
    <input type="text" name="email" placeholder="Ingrese email"> <br>
    <input type="text" name="telefono" placeholder="Ingrese telefono"> <br>
    <select name="tipo">
        <option value="cliente">Cliente</option>  
        <option value="administrador">Administrador</option>  
    </select>
    <input type="submit" name="submit" value="Guardar">
</form>


<?php
if (isset($_POST['submit'])) {
    $nombre = $_POST["nombres"];
    $apellido = $_POST["apellido"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];
    $tipo = $_POST["tipo"];

    require_once "controladores/ClienteController.php";
    $uc = new ClienteController();
    $uc->guardar($nombre, $apellido, $email, $telefono, $tipo);
}



