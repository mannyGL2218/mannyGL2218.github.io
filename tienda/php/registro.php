<?php
include_once("/xampp/htdocs/tienda/db/database.php");
$objeto = new DataBase();

if(isset($_POST['registrarse'])){
    $usuario = $_POST['usuario_reg'];
    $contrasena = $_POST['contrasena_reg'];
    $contrasena2= $_POST['contrasena_regconf'];
    date_default_timezone_set('America/Mexico_City');
    $fecha = date('Y-m-d H:i:s');

    $existente = $objeto->ValidarRegistro($usuario);
    if($existente -> rowCount() > 0){ //si existe uno
        echo '<div class="alert alert-danger alert-dismissable col-md-offset-4 col-md-3 text-center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        Nombre de <strong>Usuario</strong> ya existente</div>';
    } else if ($contrasena != $contrasena2){ //si no coinciden las contraseñas
        echo '<div class="alert alert-danger alert-dismissable col-md-offset-4 col-md-3 text-center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        Las contraseñas <strong>no coinciden</strong></div>';
        
    } else { // todo correcto, procedemos a insertar
        if($objeto->RegistrarUsuario($usuario, $contrasena, $fecha, "Cliente")){
            echo '<div class="alert alert-success alert-dismissable col-md-offset-4 col-md-3 text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>NUEVO USUARIO REGISTRADO CORRECTAMENTE</strong></div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissable col-md-offset-4 col-md-3 text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>ERROR AL REGISTRAR NUEVO USUARIO</strong></div>';
        }
    }
}
?>