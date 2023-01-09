<?php
class DataBase{
    private $user = "root";
    private $password = "";
    function Conectar() {
        try{
            $conexion = new PDO("mysql:host=localhost;dbname=tienda", $this->user, $this->password);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexion->exec("set names utf8");
            return$conexion;
        } catch (PDOException $error){
            echo "Error " . $error->getMessage() . " al conectar con la base de datos";
        }
    }
    function RegistrarUsuario($usuario, $contrasena, $fecha, $rol){
        try {
            $c = $this->Conectar();
            $nuevoUsuario = $c -> prepare("INSERT INTO usuario(idUsuario, usuario, contrasena, fecha, rol) VALUES (NULL, :usuario_reg, :contrasena_reg, :fecha_reg, :rol_reg)");
            $nuevoUsuario -> bindParam(':usuario_reg', $usuario, PDO::PARAM_STR);
            $nuevoUsuario -> bindParam(':contrasena_reg', $contrasena, PDO::PARAM_STR);
            $nuevoUsuario -> bindParam(':fecha_reg', $fecha, PDO::PARAM_STR);
            $nuevoUsuario -> bindParam(':rol_reg', $rol, PDO::PARAM_STR);
    
            $ejecutar= $nuevoUsuario -> execute();
            return $ejecutar;
        } catch (PDOException $error) {
            return false;
        }
    }
    function ValidarRegistro($usuario){
        $c = $this->Conectar();
        $resultado = $c->query("SELECT * FROM usuario WHERE usuario='$usuario' ");
        return $resultado;
    }
    function ValidarLogin($usuario, $contrasena){
        $c = $this->Conectar();
        $loginUsuario = $c->prepare("SELECT * FROM usuario WHERE usuario=:usuario_log AND contrasena=:contrasena_log");
	    $loginUsuario -> bindParam(':usuario_log', $usuario, PDO::PARAM_STR);
	    $loginUsuario -> bindParam(':contrasena_log', $contrasena, PDO::PARAM_STR);
	    $loginUsuario -> execute();
        return $loginUsuario;
    }
    function mostrarAlmacen(){
        $c = $this->Conectar();
        $query = $c->prepare("SELECT * FROM almacen ORDER BY idProducto");
        $query -> execute();
        $almacen = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $almacen;
    }
    function mostrarVentas(){
        $c = $this->Conectar();
        $query = $c->prepare("SELECT * FROM venta");
        $query -> execute();
        $ventas = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $ventas;
    }
    function mostrarProducto(){
        $c = $this->Conectar();
        $query = $c->prepare("SELECT * FROM producto");
        $query -> execute();
        $producto = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $producto;
    }
    function vender($idProducto){
        $c = $this->Conectar();
        $query = $c -> prepare("SELECT * FROM producto WHERE idProducto=:idProducto ");
        $query -> bindParam(':idProducto', $idProducto, PDO::PARAM_STR);
        $query -> execute();
        $venta = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $venta;
    }
    function venta($subtotal, $total){
        $c = $this->Conectar();
        $query = $c -> prepare("INSERT INTO venta (subTotal, total) VALUES (:subtotal, :total) ");
        $query -> bindParam(':subtotal', $subtotal, PDO::PARAM_INT);
        $query -> bindParam(':total', $total, PDO::PARAM_INT);
        $venta= $query -> execute();
    }
    function productoVendido($idproducto, $cantidad, $idventa){
        $c = $this->Conectar();
        $query = $c -> prepare("INSERT INTO productovendido(idProducto, cantidad, idVenta) VALUES (:idproducto, :cantidad, :idventa) ");
        $query -> bindParam(':idproducto', $idproducto, PDO::PARAM_STR);
        $query -> bindParam(':cantidad', $cantidad, PDO::PARAM_STR);
        $query -> bindParam(':idventa', $idventa, PDO::PARAM_STR);
        $productoVendido = $query -> execute();
    }
    function descontarProducto($cantidad, $producto, $idproducto){
        $c = $this->Conectar();
        $cantidadcajas = floor($cantidad / 20);
        $productoxseparado = $cantidad % 20;

        $q1 = $c->prepare("SELECT * FROM almacen WHERE nombreProducto =:producto AND idProducto = :idproducto");
        $q1 -> bindParam(':producto', $producto, PDO::PARAM_STR);
        $q1 -> bindParam(':idproducto', $idproducto, PDO::PARAM_STR);
        $q1 -> execute();
        $consulta = $q1 -> fetchAll(PDO::FETCH_ASSOC);

        foreach($consulta as $datosalmacen){
            $cajas = $datosalmacen["numCajasExisten"];
            $productos = $datosalmacen["cantidadPorCaja"];
        }

        if($productoxseparado>$productos){
            $descontarproducto = $productos - $productoxseparado + 20;
           if($cantidadcajas<=1){
                $descontarcaja = $cajas - 1;
           } else{
                $cantidadcajas = $cantidadcajas - 1;
                $descontarcaja = $cajas - $cantidadcajas;
           } 
        }else{
            $descontarcaja = $cajas - $cantidadcajas;
            $descontarproducto = $productos - $productoxseparado;
        }
        /*
        $descontarc = $c->prepare("UPDATE almacen SET cantidadPorCaja = '$descontarproducto' WHERE idProducto ='$idproducto' AND nombreProducto='$producto'");
        $r1 = $descontarc -> execute();

        $ndescontarp = $c->prepare("UPDATE almacen SET numCajasExisten = '$descontarcaja' WHERE idProducto ='$idproducto' AND nombreProducto='$producto'");
        $r2 = $ndescontarp -> execute();
        */
        $ndescontarc2 = $c->prepare("UPDATE producto SET productosxCaja = :descontarproducto WHERE idProducto = :idproducto AND nombreProducto = :producto ");
        $ndescontarc2 -> bindParam(':descontarproducto', $descontarproducto, PDO::PARAM_STR);
        $ndescontarc2 -> bindParam(':idproducto', $idproducto, PDO::PARAM_STR);
        $ndescontarc2 -> bindParam(':producto', $producto, PDO::PARAM_STR);
        $r3 = $ndescontarc2 -> execute();

        $ndescontarp2 = $c->prepare("UPDATE producto SET existenciasxCaja = :descontarcaja WHERE idProducto = :idproducto AND nombreProducto = :producto ");
        $ndescontarp2 -> bindParam(':descontarcaja', $descontarcaja, PDO::PARAM_STR);
        $ndescontarp2 -> bindParam(':idproducto', $idproducto, PDO::PARAM_STR);
        $ndescontarp2 -> bindParam(':producto', $producto, PDO::PARAM_STR);
        $r4 = $ndescontarp2->execute();
    }
    function consultaVenta($subtotal, $total){
        $c = $this->Conectar();
        $query = $c -> prepare("SELECT idVenta FROM venta WHERE subTotal =:subtotal AND total =:total");
        $query -> bindParam(':subtotal', $subtotal, PDO::PARAM_INT);
        $query -> bindParam(':total', $total, PDO::PARAM_INT);
        $query -> execute();
        $cosulta = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $cosulta;
    }
    function nuevaFactura($nombre, $direccion, $telefono, $rfc, $correo, $idventa){
        $c = $this->Conectar();
        $query = $c -> prepare("INSERT INTO factura(nombre, direccion, telefono, rfc, correo, idVenta) VALUES 
        (:nombre, :direccion, :telefono, :rfc, :correo, :idventa)");
        $query -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $query -> bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $query -> bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $query -> bindParam(':rfc', $rfc, PDO::PARAM_STR);
        $query -> bindParam(':correo', $correo, PDO::PARAM_STR);
        $query -> bindParam(':idventa', $idventa, PDO::PARAM_STR);
        $factura = $query -> execute();
    }
    function consultaFactura($idfactura){
        $c = $this->Conectar();
        $query = $c -> prepare("SELECT * FROM factura WHERE idFactura = :idfactura");
        $query -> bindParam(':idfactura', $idfactura, PDO::PARAM_STR);
        $query -> execute();
        $factura = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $factura;
    }
    function solicitarTransferencia($idProducto, $cantidadcajas){
        $c = $this->Conectar();
        $fecha = date('Y-m-d H:i:s');
        $query = $c -> prepare("INSERT INTO solicitudtransferencia (fecha, idProducto, cantidadcajas, estado) VALUES (:fecha, :idProducto, :cantidadcajas, 'Pendiente') ");
        $query -> bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $query -> bindParam(':idProducto', $idProducto, PDO::PARAM_INT);
        $query -> bindParam(':cantidadcajas', $cantidadcajas, PDO::PARAM_INT);
        $solicitar = $query -> execute();
    }
    function seleccionAlmacen($nombre){
        $c = $this->Conectar();
        $query = $c -> prepare("SELECT * FROM almacen WHERE nombreProducto = :nombre");
        $query -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $query -> execute();
        $producto = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $producto;
    }
    function mostrarSolicitudes(){
        $c = $this->Conectar();
        $query = $c -> prepare("SELECT * FROM solicitudtransferencia WHERE estado = 'Pendiente'");
        $query -> execute();
        $solicitudes = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $solicitudes;
    }
}
?>