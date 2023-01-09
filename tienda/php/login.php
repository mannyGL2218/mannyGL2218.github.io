<?php 
include_once("/xampp/htdocs/tienda/db/database.php");
$objeto = new DataBase();

if (isset($_POST['loguearse'])) {
    $usuario = $_POST['usuario_log'];
    $contrasena = $_POST['contrasena_log'];

    $validar = $objeto->ValidarLogin($usuario, $contrasena);
    if($validar -> rowCount() > 0){// SI HAY UN REGISTRO EXISTENTE...	
		$infoUsuario = $validar->fetch(PDO::FETCH_ASSOC); // DATOS DE USUARIO

		session_start();
		$_SESSION['usuario']= $infoUsuario['usuario'];
        $_SESSION['rol'] = $infoUsuario['rol'];

        echo $_SESSION['usuario'];
        echo $_SESSION['rol'];

        if($_SESSION['rol'] == 'Vendedor'){
            header("location: http://localhost/tienda/Vendedor/vendedor.php");
        }
        if($_SESSION['rol'] == 'Supervisor'){
            header("location: http://localhost/tienda/Supervisor/supervisor.php");
        }
    } else {
        header("location: http://localhost/tienda/index.php");
    }
}
?>