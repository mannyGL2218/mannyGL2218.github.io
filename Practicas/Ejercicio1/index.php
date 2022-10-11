<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Ejercicio 1</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <form action="#">
        <?php
            for($i=0;$i<11;$i++){
                echo "<input type='text' name='nombre".$i."' placeholder='Pregunta".$i."' id='n".$i."'><br>";
            }
        ?>
        <input type="button" value="enviar">
        </form>
    </body>
</html>