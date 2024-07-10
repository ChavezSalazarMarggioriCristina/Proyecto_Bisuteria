<?php
require_once "layout/header.php";

if(!isset($_SESSION["id"])){
    header("location: login.php");
}
?>

<?php
require_once "controladores/ClienteController.php";
$ClienteController = new ClienteController();
$clientes = $ClienteController->mostrar();

echo "<h1>Bienvenido, " . $_SESSION["usuario"] . " (" . $_SESSION["tipo"] . ")</h1>";
?>

<table border="3">
    <tr>
        <th>ID</th>
        <th>Nombres</th>
        <th>apellido</th>
        <th>email</th>
        <th>telefono</th>
        <th>carrito</th>
    </tr>
    <?php
    foreach($clientes as $clientes){
        echo "<tr>";
        echo "<td>" . $clientes['id'] . "</td>";
        echo "<td>" . $clientes['nombres'] . "</td>";
        echo "<td>" . $clientes['apellido'] . "</td>";
        echo "<td>" . $clientes['email'] . "</td>";
        echo "<td>" . $clientes['telefono'] . "</td>";
        echo "<td>" . $clientes['carrito'] . "</td>";
        echo "</tr>";
    }
    ?>
</table>

<?php   
require_once "layout/footer.php"; 
?>
