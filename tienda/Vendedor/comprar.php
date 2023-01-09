<?php
session_start();
if($_SESSION['rol'] != "Vendedor"){
    session_unset();
    session_destroy();
    header("location: http://localhost/tienda/index.php");
}
include_once("/xampp/htdocs/tienda/db/database.php");
$objeto = new DataBase();
$producto = $objeto->vender($_GET['id']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendiendo</title>
    <link rel="stylesheet" href="/tienda/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/vendedor.css">
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <header class="d-flex flex-wrap justify-content-center mb-4 border-bottom">
        <a href="#" class="d-flex align-items-center mb-1 mt-1 me-md-auto text-decoration-none">
            <img src="../img/logo.png" class="bi me-2">
        </a>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a href="vendedor.php">Regresar</a>
                <a href="../php/desconectar.php">Cerrar sesión</a>
            </li>
        </ul>
    </header>

    <div class="container text-center">
    <h1>Detalles de la compra</h1><br>

    <table class="table table-sm table-striped">
        <thead class="table-dark">
            <tr><th colspan="2">Porcentaje de IVA por cantidad de productos</th></tr>
        </thead>
        <tbody>
            <tr>
                <td>menos de 100</td>
                <td>0%</td>
            </tr>
            <tr>
                <td>de 100 a 500</td>
                <td>5%</td>
            </tr>
            <tr>
                <td>de 500 a 1,000</td>
                <td>8%</td>
            </tr>
            <tr>
                <td>más de 1,000</td>
                <td>10%</td>
            </tr>
        </tbody>
    </table>

    <h2>Informacion del producto</h2>
    <?php 
    foreach($producto as $datos){
    ?>
    <form action="../php/transaccion.php" method="post">
        <input type="hidden" value="<?php echo $datos['idProducto'];?>" name="idproducto">

        <input type="text" value="<?php echo $datos["nombreProducto"];?>" name="nombrepr" readonly>
        <label for="nombrepr">Producto</label>

        <label for="">Precio por Producto: $</label>
        <input type="text" value="<?php echo $datos["precio"];?>" name="precio" readonly><br>

        <label for="">Cajas disponibles:</label>
        <input type="text" value="<?php echo $datos["existenciasxCaja"];?>" name="total" readonly><br>

        <label for="">Cantidad a Vender:</label>
        <input type="number" name="cantidad" required>
        
        <h3>Informacion del comprador</h3>
        <label for="">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label for="">Direción:</label>
        <input type="text" name="direccion" required><br>

        <label for="">Telefono:</label>
        <input type="tel" name="telefono" required><br>

        <label for="">RFC:</label>
        <input type="text" name="rfc" required><br>

        <label for="">Correo:</label>
        <input type="email" name="correo" required><br>

        <label for="">Generar factura</label>
        <input type="checkbox" name="factura" value="1"><br>
        <input type="submit" value="Vender" class="btn btn-success">
    </form>
    <?php }?>
    </div>

    <script src="/tienda/js/bootstrap.bundle.min.js"></script>
</body>
</html>
