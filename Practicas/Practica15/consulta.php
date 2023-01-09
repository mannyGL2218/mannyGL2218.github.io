<?php
require_once('autoload.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
    <?php

    class Listar extends conexion{
        public $miconexion;
        private $conexion;

        public function __construct(){
            $this -> miconexion = new conexion();
            $this -> miconexion = $this->miconexion->Conectar();
        }
        public function listatodos(){
            $sql = "SELECT * FROM Datos";
            $consulta = $this->miconexion->prepare($sql);
            $consulta->execute();
            $registro = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($registro);
        }
    }
    
    $consultartodos = new Listar();
    echo var_dump($consultartodos->listatodos());
    $datos1 = json_decode($consultartodos->listatodos());
    $datos2 = json_decode($consultartodos->listatodos(), true);
    echo "<br><br>"
    
    foreach($datos1 as $dato){
        echo "ID: ".$dato->id."<br>";
        echo "Nombre: ".$dato->nombre."<br>";
        echo "Edad: ".$dato->edad."<br>";
        echo "Correo: ".$dato->correo."<br>";
    }
    echo "<br><br>"
    
    foreach($datos2 as $dato){
        echo "ID: ".$dato[id]."<br>";
        echo "Nombre: ".$dato[nombre]."<br>";
        echo "Edad: ".$dato[edad]."<br>";
        echo "Correo: ".$dato[correo]."<br>";
    }
?>
    </body>
</html>