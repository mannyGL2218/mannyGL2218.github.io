<?php
    class Personas{
        public $nombre;
        public $edad;
        public $telefono;
        public $curp;

        function __construct($no, $ed, $te, $cu){
            $this->nombre = $no;
            $this->edad = $ed;
            $this->telefono = $te;
            $this->curp = $cu;
        }
        
        function setNombre($nombre){
            $this->nombre = $nombre;
        }
        function setEdad($edad){
            $this->edad = $edad;
        }
        function setTelefono($telefono){
            $this->telefono = $telefono;
        }
        function setCurp($curp){
            $this->curp = $curp;
        }

        function getNombre(){
            return $this->nombre;
        }
        function getEdad(){
            return $this->edad;
        }
        function getTelefono(){
            return $this->telefono;
        }
        function getCurp(){
            return $this->curp;
        }

        function dia(){
            $dia = substr($this->curp->getCurp, 8, 2);
            return "Día: ".$dia.".";
        }

        function mes(){
            $mes = substr($this->curp->getCurp, 6, 2);
            return "Mes: ".$mes." años";
        }

        function calcularSignoZodiacal(): string{
            $signo = "";
            $diaNacimiento = substr($this->curp->getCurp, 8, 2);
            $mes = substr($this->curp, 6, 2);
            switch ($mes) {
                case "01":
                    if ($diaNacimiento <= 20) {
                        $signo = "Capricornio";
                    } else {
                        $signo = "Acuario";
                    }
                    break;
                case "02":
                    if ($diaNacimiento <= 18) {
                        $signo = "Acuario";
                    } else {
                        $signo = "Piscis";
                    }
                    break;
                case "03":
                    if ($diaNacimiento <= 20) {
                        $signo = "Piscis";
                    } else {
                        $signo = "Aries";
                    }
                    break;
                case "04":
                    if ($diaNacimiento <= 20) {
                        $signo = "Aries";
                    } else {
                        $signo = "Tauro";
                    }
                    break;
                case "05":
                    if ($diaNacimiento <= 21) {
                        $signo = "Tauro";
                    } else {
                        $signo = "Géminis";
                    }
                    break;
                case "06":
                    if ($diaNacimiento <= 21) {
                        $signo = "Géminis";
                    } else {
                        $signo = "Cáncer";
                    }
                    break;
                case "07":
                    if ($diaNacimiento <= 22) {
                        $signo = "Cáncer";
                    } else {
                        $signo = "Leo";
                    }
                    break;
                case "08":
                    if ($diaNacimiento <= 23) {
                        $signo = "Leo";
                    } else {
                        $signo = "Virgo";
                    }
                    break;
                case "09":
                    if ($diaNacimiento <= 23) {
                        $signo = "Virgo";
                    } else {
                        $signo = "Libra";
                    }
                    break;
                case "10":
                    if ($diaNacimiento <= 23) {
                        $signo = "Libra";
                    } else {
                        $signo = "Escorpio";
                    }
                    break;
                case "11":
                    if ($diaNacimiento <= 22) {
                        $signo = "Escorpio";
                    } else {
                        $signo = "Sagitario";
                    }
                    break;
                case "12":
                    if ($diaNacimiento <= 21) {
                        $signo = "Sagitario";
                    } else {
                        $signo = "Capricornio";
                    }
                    break;
            }   
            return "Signo zodiacal: ".$signo;
        }
        public function __destruct(){
		    echo "</br>";
		    echo "objeto destruido";
	    }
    }

    $persona = new Personas($_POST['nombre'],$_POST['edad'],$_POST['telefono'],$_POST['curp']);
    echo $persona ->dia();
    echo "<br>";
    echo $persona ->mes();
    echo "<br>";
    echo $persona ->calcularSignoZodiacal();
?>