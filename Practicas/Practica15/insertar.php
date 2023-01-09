<?php
    require_once('autoload.php');

    class insertar extends conexion{
        public $miconexion;
        private $conexion;

        public function __construct(){
            $this -> miconexion = new conexion();
            $this -> miconexion = $this->miconexion->Conectar();
        }
        public function inserta(String $nombre, int $edad, String $correo){
            $sql = "INSERT INTO Datos(nombre, edad, correo) VALUES (:nombre,:edad, :correo)";
            $consulta = $this->miconexion->prepare($sql);
            $consulta->BindValue(":nombre",$nombre);
            $consulta->BindValue(":edad",$edad);
            $consulta->BindValue(":correo",$correo);

            $resultado = $consulta->execute();
            return $resultado;
        }
    }

    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $correo = $_POST['correo'];

    $insertando = new insertar();
    //$insertando->inserta($nombre, $edad,$correo);
    echo $this->inserta($nombre, $edad, $correo);
    echo $_POST['nombre'];
?>