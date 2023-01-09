<?php
session_start();
if($_SESSION['rol'] == "Vendedor" || $_SESSION['rol'] == "Supervisor"){
    include_once("/xampp/htdocs/tienda/db/database.php");
    $objeto = new DataBase();

    $id = $_POST["idproducto"];
    $producto = $_POST["nombrepr"];
    $precio = $_POST["precio"];
    $productotal = $_POST["total"];
    $cantidad = $_POST["cantidad"];
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $rfc = $_POST["rfc"];
    $correo = $_POST["correo"];
}else{
    session_unset();
    session_destroy();
    header("location: http://localhost/tienda/index.php");
}

$subtotal = $precio * $cantidad;
if($cantidad<=100){
    $total = $subtotal;
}else if ($cantidad>100 && $cantidad<=500){
    $op = $subtotal * 5;
    $descuento = $op / 100;
    $total = $subtotal - $descuento;
}else if ($cantidad>500 && $cantidad<=1000){
    $op = $subtotal * 8;
    $descuento = $op / 100;
    $total = $subtotal - $descuento;
}else if ($canticantidaddadvender>1000){
    $op = $subtotal * 10;
    $descuento = $op / 100;
    $total = $subtotal - $descuento;
}

if ($cantidad > $productotal || $cantidad <= 0){
    echo "<script>window.alert('La cantidad a comprar no es valida')</script>";
    if($_SESSION['rol'] == "Vendedor"){
        echo "<script>window.location.href='../Vendedor/comprar.php?id=".$_POST['idproducto']."'</script>";
    } else if($_SESSION['rol'] == "Supervisor"){
        echo "<script>window.location.href='../Supervisor/comprar.php?id=".$_POST['idproducto']."'</script>";
    }
} else{
    try{
        $objeto -> venta($subtotal, $total);
        $venta = $objeto -> consultaVenta($subtotal, $total);

        foreach($venta as $datosventa){
            $idventa = $datosventa["idVenta"];
        }
    
        $objeto -> nuevaFactura($nombre, $direccion, $telefono, $rfc, $correo, $idventa);

        $objeto -> productoVendido($id, $cantidad, $idventa);
        $objeto -> descontarProducto($cantidad, $producto, $id);

        echo "<script>window.alert('La venta se realizo con exito')</script>";

        if(isset($_POST["factura"])){    
            echo "<script>window.location.href='../php/factura.php?id=$idventa'</script>";
            echo "facturado";
        }else{
            if($_SESSION['rol'] == "Vendedor"){
                echo "<script>window.location.href='../Vendedor/vendedor.php'</script>";
            } else if($_SESSION['rol'] == "Supervisor"){
                echo "<script>window.location.href='../Supervisor/supervisor.php'</script>";
            }
        }

    }catch(Exception $e){
        echo "<script>window.alert('Ha ocurrido un error al realizar la venta')</script>";
        if($_SESSION['rol'] == "Vendedor"){
            echo "<script>window.location.href='../Vendedor/comprar.php?id=".$_POST['idproducto']."'</script>";
        } else if($_SESSION['rol'] == "Supervisor"){
            echo "<script>window.location.href='../Supervisor/comprar.php?id=".$_POST['idproducto']."'</script>";
        }
    }
}
?>