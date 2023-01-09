<?php
session_start();
if($_SESSION['rol'] != "Supervisor"){
    session_unset();
    session_destroy();
    header("location: http://localhost/tienda/index.php");
}
include_once("/xampp/htdocs/tienda/db/database.php");
$objeto = new DataBase();
$almacen = $objeto->mostrarAlmacen();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisor</title>
    <link rel="stylesheet" href="/tienda/css/bootstrap.min.css">
    <link rel="stylesheet" href="/tienda/css/supervisor.css">
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <header class="d-flex flex-wrap justify-content-center mb-4 border-bottom">
        <a href="#" class="d-flex align-items-center mb-1 mt-1 me-md-auto text-decoration-none">
            <img src="../img/logo.png" class="bi me-2">
        </a>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a href="#" id="btnS">Solicitar Producto</a>
                <a href="#" id="btnT">Tienda</a>
                <a href="#" id="btnV">Ventas</a>
                <a href="../php/desconectar.php">Cerrar sesión</a>
            </li>
        </ul>
    </header>

<div class="container text-center">
    <main id="formS" style="display: none;">
        <div>
            <div class="form-floating">
            <h1>Solicitar al almacen</h1>
            <form action="solicitar.php" method="post">
                <div class="form-floating">
                    <select name="producto" id="producto" class="form-select">
                        <?php 
                        foreach($almacen as $items){
                        ?>
                        <option value="<?php echo $items['nombreProducto'];?>">
                            <?php echo $items['nombreProducto'];?>
                        </option>
                        <?php } ?>
                    </select>
                    <label for="producto">Producto</label>
                </div>
                <div class="form-floating">
                    <input type="number" name="cantidad" id="cantidad" placeholder="Cajas a pedir" class="form-control" required>
                    <label for="cantidad">Cajas a pedir</label>
                </div>
                <input type="submit" value="Solicitar" class="w-100 btn btn-lg btn-success">
            </form>
            </div>
            <h2>Almacen</h2>
            <table class="table table-sm table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Cantidad por caja</th>
                        <th>Disponibilidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $contenido = $objeto->mostrarAlmacen();
                    $bandera = false;
                    foreach($contenido as $almacen){ ?>
                    <tr>
                        <td><?php echo $almacen["idProducto"];?></td>
                        <td><?php echo $almacen["nombreProducto"];?></td>
                        <td><?php echo $almacen["cantidadPorCaja"];?></td>
                        <td><?php echo $almacen["numCajasExisten"];?></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            <h2>Solicitudes pendientes</h2>
            <table class="table table-sm table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>fecha</th>
                        <th>idProducto</th>
                        <th>Cajas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $solicitudes = $objeto->mostrarSolicitudes();
                    $i = 0;
                    foreach($solicitudes as $pan){
                        $i++;
                    ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $pan['fecha'];?></td>
                        <td><?php echo $pan['idProducto'];?></td>
                        <td><?php echo $pan['cantidadcajas'];?></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </main>

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
                    <th>Comprar</th>
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
                        <a href="comprar.php?id=<?php echo $datos["idProducto"];?>" class='btn btn-success'>Comprar</a>
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
        const $btnS = document.querySelector("#btnS"),
	        $btnT = document.querySelector("#btnT"),
	        $btnV = document.querySelector("#btnV");
        //formularios
        const $formS = document.querySelector("#formS"),
            $formT = document.querySelector("#formT"),
            $formV = document.querySelector("#formV");
        
        //acciones
        $btnS.addEventListener("click", () => {
	        $formS.style.display = "block";
            $formT.style.display = "none";
            $formV.style.display = "none";
        });
        $btnT.addEventListener("click", () => {
	        $formS.style.display = "none";
            $formT.style.display = "block";
            $formV.style.display = "none";
        });
        $btnV.addEventListener("click", () => {
	        $formS.style.display = "none";
            $formT.style.display = "none";
            $formV.style.display = "block";
        });
    </script>
    <script src="/tienda/js/bootstrap.bundle.min.js"></script>
</body>
</html>