<?php
session_start();
if($_SESSION['rol'] != "Vendedor"){
    session_unset();
    session_destroy();
    header("location: http://localhost/tienda/index.php");
}
include_once("/xampp/htdocs/tienda/db/database.php");
$objeto = new DataBase();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendedor</title>
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
                <a href="#" id="btnT">Tienda</a>
                <a href="#" id="btnV">Ventas</a>
                <a href="../php/desconectar.php">Cerrar sesión</a>
            </li>
        </ul>
    </header>
<div class="container text-center">

    <main id="formT">
        <h1>Tienda</h1>
        <table class="table table-sm table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Disponibilidad</th>
                    <th>Cantidad por caja</th>
                    <th>Precio</th>
                    <th>Vender</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $tienda = $objeto->mostrarProducto();
            $flag = false;
            foreach($tienda as $datos){ ?>
                <tr>
                    <td><?php echo $datos["idProducto"];?></td>
                    <td><?php echo $datos["nombreProducto"];?></td>
                    <td><?php 
                    if($datos['existenciasxCaja'] > 0){
                        echo $datos["existenciasxCaja"];
                        $flag = true;
                    }?></td>
                    <td><?php echo $datos["productosxCaja"];?></td>
                    <td><?php echo $datos["precio"];?></td>
                    <td>
                        <?php if($flag == true){ ?>
                        <a href="comprar.php?id=<?php echo $datos["idProducto"];?>" class='btn btn-success'>Vender</a>
                        <?php } else { echo "proximamente"; }?>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
    </main>

    <main id="formV" style="display: none;">
        <h1>Ventas Realizadas</h1>
        <table class="table table-sm table-striped">
            <thead class="table-dark">
                <tr>
                    <td>#</td>
                    <th>Subtotal</th>
                    <th>Total</th>
                    <th>Factura</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $ventas = $objeto->mostrarVentas();
                foreach($ventas as $datos){ ?>
                    <tr>
                        <td><?php echo $datos["idVenta"]; ?></td>
                        <td><?php echo "$".$datos["subTotal"]; ?></td>
                        <td><?php echo "$".$datos["total"]; ?></td>
                        <td><a href="../php/factura.php?id=<?php echo $datos["idVenta"]; ?>" class='btn btn-success'>Factura</a></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </main>

</div>
    
<script>
        //botones
        const $btnT = document.querySelector("#btnT"),
	        $btnV = document.querySelector("#btnV");
        //formularios
        const $formT = document.querySelector("#formT"),
            $formV = document.querySelector("#formV");
        //acciones
        $btnT.addEventListener("click", () => {
            $formT.style.display = "block";
            $formV.style.display = "none";
        });
        $btnV.addEventListener("click", () => {
            $formT.style.display = "none";
            $formV.style.display = "block";
        });
    </script>
    <script src="/tienda/js/bootstrap.bundle.min.js"></script>
</body>
</html>