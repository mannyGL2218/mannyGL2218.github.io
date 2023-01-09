<?php 
session_start();
if($_SESSION['rol'] == "Vendedor" || $_SESSION['rol'] == "Supervisor"){
    include_once("/xampp/htdocs/tienda/db/database.php");
    $objeto = new DataBase();
}else{
    session_unset();
    session_destroy();
    header("location: http://localhost/tienda/index.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <link rel="stylesheet" href="/tienda/css/bootstrap.min.css">
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container text-center mt-5">
        <h1 class="titulo">Factura</h1>
        <?php
        $factura = $objeto -> consultaFactura($_GET["id"]);
        foreach($factura as $datosfactura){
        ?>
        <div>
            <h2>Datos de la factura</h2>
            <label>Nombre del comprador: <?php echo $datosfactura["nombre"]; ?></label><br>
            <label>Direccion del comprador: <?php echo $datosfactura["direccion"]; ?></label><br>
            <label>Telefono del comprador: <?php echo $datosfactura["telefono"];?></label><br>
            <label>RFC del comprador: <?php echo $datosfactura["rfc"]; ?></label><br>
            <label>Correo del comprador: <?php echo $datosfactura["correo"]; ?></label><br>
            <label>ID de la Venta: <?php echo $datosfactura["idVenta"]; ?></label><br>
        </div>
        <?php } ?>
    </div>

    <script src="/tienda/js/bootstrap.bundle.min.js"></script>
</body>
</html>