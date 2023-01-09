<?php
    echo "Implementando elementos include y require<br>";

    include("mensaje.php");
    echo "seguimos ejecutando aunque no exista el archivo<br>";
    mensaje();

    echo "Require obliga a que exista el archivo y lo ejecuta namas comenzar<br>";
    require("require.php");

    //Los incluye solo una vez en todo el archivo
    //verificar que este archivo no se vuelva a recargar, que solo lo cargue una vez
    include_once("mensaje.php");
    //require once verifica que solo se haya agregado una vez el archivo y lo ejecuta, pero no lo vuelve a cargar
    require_once("require.php");

?>