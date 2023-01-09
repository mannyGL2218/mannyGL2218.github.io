<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>
<body>
    <font size="+2">
    <form action="validar.php" method="POST">
        <input type="text" name="nombre" placeholder="Nombre" required><br>
        <input type="text" name="edad" placeholder="Edad" required><br>
        <input type="tel" name="telefono" placeholder="Telefono" required><br>
        <input type="text" name="curp" placeholder="CURP" required><br>
        <input type="submit" value="Enviar">
        <input type="reset" value="Borrar">
    </form>
    </font>
</body>
</html>