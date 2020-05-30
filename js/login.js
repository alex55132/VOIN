var nombre;
var email;
var contr;
function login() {
    enviar=true;
    email=document.getElementById("email").value;
    pass=document.getElementById("password").value;
    exEmail= /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    exPass=/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/;
    if ( !exEmail.test(email)){
        enviar=false;
    }
    if(!exPass.test(pass)){

        enviar=false;
    }
    if (enviar){
        document.getElementById("loginForm").submit();
    }else{
        alert("Contraseña o email incorrecto");
    }
}
function registro() {
    nombre=document.getElementById("usernameRegister").value;
    email=document.getElementById("emailRegister").value;
    contr=document.getElementById("passwordRegister").value;
    contr2=document.getElementById("confirmPasswordRegister").value;
    exEmail= /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    exPass=/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/;
    exNom=/^@?(\w){1,15}$/;
    if (contr==contr2 && exNom.test(nombre) && exEmail.test(email) && exPass.test(contr)){

        if(comprobarBD("usuarios")){
            alert("mas o menos")
        }
    }else   {
        if (exNom.test(nombre)){

        }else{
            alert("falla el nombre");
        }
        if (exEmail.test(email)){

        }else {
            alert("falla el email");
        }
        if (exPass.test(contr) ||contr==contr2){

        }else{
            alert("falla la contraseña");
        }
    }
}
function ajax() {
    try {
        req = new XMLHttpRequest();
    } catch(err1) {
        try {
            req = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (err2) {
            try {
                req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (err3) {
                req = false;
            }
        }
    }
    return req;
}

var comprobar = new ajax();
function comprobarBD(tabla) {
    var myurl = 'php/comprobarBD.php';
    myRand = parseInt(Math.random() * 999999999999999);
    modurl = myurl + '?rand=' + myRand + '&correo=' + email + '&tabla=' + tabla+ '&nombre=' + nombre+ '&contr=' + contr;
    comprobar.open('GET', modurl, true);
    comprobar.onreadystatechange = response;
    comprobar.send(null);

}

function response() {

    if (comprobar.readyState === 4) {
        if(comprobar.status === 200) {
            var res = comprobar.responseText;
            location.reload();
            alert("Usuario registrado correctamente");
        }else  {
            alert("Algo ha ido mal");
        }
    }
}