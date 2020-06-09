let editNombreBtn;
let editNacimientoBtn;
let editCorreoBtn;
let editContrasenaBtn;
let editFotoBtn;

let editZones;

let nombreZone;
let fechaZone;
let correoZone;

let acceptBtnContainer;
let acceptBtn;

let uploadDataForm;

let exEmail;
let exPass;

let atras;

window.addEventListener("load", function () {
    atras = document.getElementById("atras");

    atras.addEventListener("click", function () {
        window.location.href = "index.php";
    });
    exEmail = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    exPass = /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/;

    uploadDataForm = document.getElementById("uploadDataForm");

    editNombreBtn = document.getElementById("editNombreBtn");
    editNacimientoBtn = document.getElementById("editNacimientoBtn");
    editContrasenaBtn = document.getElementById("editContrasenaBtn");
    editCorreoBtn = document.getElementById("editCorreoBtn");

    acceptBtnContainer = document.getElementById("acceptBtnContainer");
    acceptBtn = document.getElementById("acceptBtn");

    editFotoBtn = document.getElementById("editFotoBtn");

    editZones = document.getElementsByClassName("perfilEditZone");

    editNombreBtn.addEventListener("click", function () {
        nombreZone = document.getElementById("nombreZone");
        editZones[0].innerHTML = "<input type='text' name='nombreUser' placeholder='Nombre' value='"+nombreZone.innerText+"'>";
        acceptBtnContainer.style.display = "flex";
    });

    editNacimientoBtn.addEventListener("click", function () {
        fechaZone = document.getElementById("fechaZone");
        editZones[1].innerHTML = "<input type='date' name='fechaNacimientoUser' value='"+fechaZone.innerText+"'>";
        acceptBtnContainer.style.display = "flex";
    });

    editCorreoBtn.addEventListener("click", function () {
        correoZone = document.getElementById("correoZone");
        editZones[2].innerHTML = "<input type='text' name='correoUser' value='"+correoZone.innerText+"'>";
        acceptBtnContainer.style.display = "flex";
    });

    editContrasenaBtn.addEventListener("click", function () {
        editZones[3].innerHTML = "<input type='password' name='passUser'>"
        acceptBtnContainer.style.display = "flex";
    });

    editFotoBtn.addEventListener("click", function () {
        editZones[4].innerHTML = "<input type='file' name='newFoto'>"
        acceptBtnContainer.style.display = "flex";
    });

    acceptBtn.addEventListener("click", function () {
        let sendDataPetition = new XMLHttpRequest();
        let data = new FormData(document.getElementById("uploadDataForm"));

        sendDataPetition.open("POST", "Controllers/updateDataController.php");
        sendDataPetition.send(data);

        sendDataPetition.onreadystatechange = function () {
            if(sendDataPetition.readyState === 4) {
                if(sendDataPetition.status === 200) {
                    console.log(sendDataPetition.responseText);
                    let data = JSON.parse(sendDataPetition.responseText);

                    alert(data.message);

                    if (data.statusCode === 1 || data.statusCode === 3) {
                        location.reload();
                    }
                }
            }
        }
    });

});