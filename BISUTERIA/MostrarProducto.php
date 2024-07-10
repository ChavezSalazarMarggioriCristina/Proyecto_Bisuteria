<?php
require_once "layout/header.php";

if(!isset($_SESSION["id"])){
    header("location: login.php");
}
?>

<?php
require_once "controladores/ProductoController.php";
$ProductoController = new ProductoController();
$productos = $ProductoController->mostrar();

echo "<h1>Bienvenido, " . $_SESSION["usuario"] . " (" . $_SESSION["tipo"] . ")</h1>";
?>

<table border="3">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
    </tr>
    <?php
    foreach($productos as $producto){
        echo "<tr>";
        echo "<td>" . $producto['id'] . "</td>";
        echo "<td>" . $producto['nombre'] . "</td>";
        echo "<td>" . $producto['precio'] . "</td>";
        echo "<td>" . $producto['stock'] . "</td>";
        echo "</tr>";
    }
    ?>
</table>

<?php   
require_once "layout/footer.php"; 
?>

