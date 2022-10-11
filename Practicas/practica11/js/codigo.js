window.addEventListener("load",function(){
    //Aquí va todo el código que se ejecuta despues de cargar la página.
    /*function envio(){
        this.event.preventDefault();
        alert("se cancela el envio");
    }*/
    formulario = this.document.getElementById("formulario");
    formulario.addEventListener("submit", function(){
        //alert("comprobando entrada");
        event.preventDefault();
        let nombre = document.getElementById("nombre").value;
        let password = document.getElementById("password").value;

        let respuesta = document.getElementById("resultado");
        //alert("el nombre es:'"+nombre+"' con contraseña:'"+password+"'");
        if(nombre == "G7S21" && password == "si"){
            //alert("kiubo grupo");
            respuesta.innerText="aceptado";
            respuesta.style.color="red";
        } else {
            respuesta.innerText="rechazado";
            respuesta.style.color="red";
            respuesta.style.backgroundColor="white";
        }
    });
});