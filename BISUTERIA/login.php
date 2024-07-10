<form method="post" action=<?php echo $_SERVER["PHP_SELF"];?>>
    <input type="text" name="username" placeholder="Ingrese username" > <br>
    <input type="password" name="password" placeholder="Ingrese password">  <br>
    <input type="submit" name="submit" value="Login" >
</form>

<?php
if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $contadorErrores = 0;
    if($username =="") {
           echo"Ingrese Nombre de usuario <br>";
           $contadorErrores++;
    }      
    if($password =="") {
        echo"Ingrese Contraseña <br>";
    }

    if($contadorErrores == 0) {
    require_once "controladores/ClienteController.php";
    $uc = new ClienteController();
    $uc->login($username, $password);
    }
}