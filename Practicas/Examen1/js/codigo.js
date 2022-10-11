window.addEventListener("load",function(){
    formulario = this.document.getElementById("formulario");
    formulario.addEventListener("submit", function(){
        //alert("comprobando entrada");
        let nombre = document.getElementById("nombre").value;
        let edad = document.getElementById("edad").value;
        let modificar = document.getElementById("resultado");
        let cuerpo = document.getElementById("cuerpo");
        if(parseInt(edad) > 18 ){
            modificar.style.backgroundColor="green";
            modificar.style.color="black";
            modificar.style.fontSize="16pt";
            modificar.style.borderStyle="dotted";
        } else {
            modificar.style.backgroundColor="red";
            modificar.style.color="blue";
            modificar.style.fontSize="18pt";
            modificar.style.borderStyle="double";
        }
        if(nombre.charAt(0) == "a" ||nombre.charAt(0) == "b" || nombre.charAt(0) == "c" || nombre.charAt(0) == "d" || nombre.charAt(0) == "e" || nombre.charAt(0) == "f" || nombre.charAt(0) == "g" || nombre.charAt(0) == "h" || nombre.charAt(0) == "i" || nombre.charAt(0) == "j" || nombre.charAt(0) == "k" || nombre.charAt(0) == "l" || nombre.charAt(0) == "m"){
            cuerpo.style.margin="4em";
            modificar.style.paddingLeft="2em";
        } else {
            cuerpo.style.margin="6em";
            modificar.style.paddingLeft="4em";
        }
    });
});