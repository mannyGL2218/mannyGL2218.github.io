<?php
    $datos = array(
        ["nombre"=>"jonathan","correo"=>"jonas@gmail.com","edad"=>"21"],
        ["nombre"=>"Hugo","correo"=>"hugo@gmail.com","edad"=>"22"],
        ["nombre"=>"Willy","correo"=>"chocolate@gmail.com","edad"=>"27"]
    );
    foreach($datos as $individual){
        foreach($individual as $identificador => $contenido){
            echo "$identificador : $contenido";
            echo "<br>";
        }
        echo "<br>";
    }
?>