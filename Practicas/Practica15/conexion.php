<?php
    class conexion{
        private $user = "root";
        private $pass = "";
        private $host = "localhost";
        private $db = "G7S21";

        private $conecta;

        public function __construct(){
            $cadenac = "mysql:host=".$this->host.";dbname=".$this->db.";charset=utf8";
            try{
                $this->conecta = new PDO($cadenac,$this->user, $this->pass);
                $this->conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            }catch(Exception $ex){
                $this->conecta="Error de conexión..";
                echo "Error: ".$ex->getMessage();
            }
        }
        public function Conectar(){
            return $this->conecta;
        }
    }
?>