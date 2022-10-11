<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Practica 13</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
    <?php
        $estaciones = array("Invierno","Verano","Primavera","Otoño");
        foreach($estaciones as $individual){
            echo "Estacion $individual <br>";
        }
        echo "<br><br>";
        $datos = array("nombre" => "Jonathan", "correo"=>"jonathan@gmail.com","edad"=>"21");
        foreach($datos as $identificador => $contenido){
            echo "$identificador : $contenido";
            echo "<br>";
        }
    ?>
    </body>
</html>