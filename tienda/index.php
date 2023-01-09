<?php
include_once("/xampp/htdocs/tienda/php/registro.php");
include_once("/xampp/htdocs/tienda/php/login.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/tienda/css/bootstrap.min.css">
	<link rel="stylesheet" href="/tienda/css/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script>
		$(document).ready(function(){ // OCULTAR LA CAJA DE REGISTRO AL INICIO
			$("#caja_registro").hide();

			$("#registrarse").click(function(){ // DESAPARECER CAJA DE LOGIN Y APARECER LA DE REGISTRO
			    $("#caja_login").slideToggle();
			    $("#caja_registro").slideToggle();
			});

			$("#loguearse").click(function(){// DESAPARECER CAJA DE REGISTRO Y APARECER LA DE LOGIN
			    $("#caja_login").slideToggle();
			    $("#caja_registro").slideToggle();
			});
		});
	</script>
</head>
<body class="text-center">
	
	<main class="form-signin" id="caja_login">
        <img class="mb-2" src="img/logo.png">
        <h1 class="h3 mb-3 fw-normal">Iniciar Sesión</h1>

        <div class="form-floating">
            <form method="post">
                <div class="form-floating">
                    <input type="text" name="usuario_log" class="form-control" id="usuario_log" placeholder="Usuario" required>
                    <label for="usuario_log">Usuario</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="contrasena_log" class="form-control" id="contrasena_log" placeholder="Contraseña" required>
                    <label for="contrasena_log">Contraseña</label>
                </div>
                <input type="submit" value="LOGIN" name="loguearse" class="w-100 btn btn-lg btn-primary">
            </form>
            <a class="mt-5 mb-3 text-muted" id="registrarse" href="#">REGISTRARSE</a>
        </div>
    </main>

	<main class="form-signin" id="caja_registro" style="display: none;">
        <img class="mb-2" src="img/logo.png">
        <h1 class="h3 mb-3 fw-normal">Registrarse</h1>

        <div class="form-floating">
            <form method="post">
                <div class="form-floating">
                    <input type="text" name="usuario_reg" class="form-control" id="usuario_reg" placeholder="Usuario" required>
                    <label for="usuario_reg">Usuario</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="contrasena_reg" class="form-control" id="contrasena" placeholder="Contraseña" required>
                    <label for="contrasena_reg">Contraseña</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="contrasena_regconf" class="form-control" id="contrasena_config" placeholder="Confirmar Contraseña" required>
                    <label for="contrasena_reg">Confirmar contraseña</label>
                </div>

                <input type="submit" value="REGISTRARSE" name="registrarse" class="w-100 btn btn-lg btn-primary">
            </form>

            <a class="mt-5 mb-3 text-muted" id="loguearse" href="#">LOGUEARSE</a>
        </div>
    </main>
    
	<script src="/tienda/js/bootstrap.bundle.min.js"></script>
</body>
</html>