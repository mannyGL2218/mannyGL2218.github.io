<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Pagina</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
    <?php
        $user = $_POST['user'];
        echo("Bienvenido ".$user." :D<br>");
        
        for($a=0;$a<10;$a++){
            echo "El valor de a es: ".$a."<br>";
        }
    ?>
    <br><br><br><br>
    <?php
        echo "Tablas de multiplicar del 2";
        for($a=0;$a<11;$a++){
            echo "2x$a=".($a*2)."<br>";
        }
    ?>
    </body>
</html>