<?php 
session_start();
if($_SESSION['rol'] != "Supervisor"){
    session_unset();
    session_destroy();
    header("location: http://localhost/tienda/index.php");
}
include_once("/xampp/htdocs/tienda/db/database.php");
$objeto = new DataBase();
//echo $_POST['producto'] . $_POST['cantidad'];
$temporal = $objeto->seleccionAlmacen($_POST['producto']);
foreach($temporal as $producto){
    $objeto -> solicitarTransferencia($producto['idProducto'], $_POST['cantidad']);
}
echo "<script>window.alert('La solicitud se realizo con exito')</script>";
header("location: http://localhost/tienda/Supervisor/supervisor.php");
?>