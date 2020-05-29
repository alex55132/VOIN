let fileInput;
let videoUploadMessage;

let uploadBtn;

let notificationContainer;
let closeNotification;

let tituloVideo;
let descripcionVideo;
let etiquetasVideo;
let miniaturaInput;
let miniaturaPreview;

window.onload = function () {
    notificationContainer = document.getElementById("notificationContainer");
    fileInput = document.getElementById("fileInput");
    videoUploadMessage = document.getElementById("videoUploadMessage");
    uploadBtn = document.getElementById("videoUploadButton")
    closeNotification = document.getElementById("closeNotification");
    tituloVideo = document.getElementById("tituloVideo");
    descripcionVideo = document.getElementById("descripcionVideo");
    etiquetasVideo = document.getElementById("etiquetasVideo");
    miniaturaInput = document.getElementById("miniaturaInput");
    miniaturaPreview = document.getElementById("miniaturaPreview");

    let r = new Resumable({
        /*Aqui hay un agujero de seguridad guapo, ya que mostramos ruta real de los archivos
         Esto se solucionaria con rutas amigables usando el htaccess*/
        target:'Controllers/uploadFileController.php',
        method: "POST"
    });

    uploadBtn.addEventListener("click", function () {
        r.upload();
    });

    r.assignBrowse(fileInput);
    r.assignDrop(fileInput);

    r.on('fileAdded', function(file){
        videoUploadMessage.innerText = file.file.name;
    });

    r.on('fileSuccess', function(file,message){
        console.log("Archivo enviado");

        //Generamos un formdata para insertar los elementos salvo el propio video, que ya se está subiendo
        let formData = new FormData();

        formData.append("tituloVideo", tituloVideo.value);
        formData.append("descripcionVideo", descripcionVideo.value)
        formData.append("etiquetasVideo", etiquetasVideo.value);
        formData.append("rutaVideo", file.fileName);
        formData.append("miniaturaVideo", miniaturaInput.files[0]);

        let request = new XMLHttpRequest();
        request.open("POST", "Controllers/uploadVideoController.php", true);

        request.onload = function(oEvent) {
            if(request.readyState === 4) {
                if (request.status === 200) {
                    console.log(request.responseText);
                    miniaturaPreview.src = "imgs/miniaturas/" + request.responseText;
                    sendNotification(1);
                } else {
                    console.log(request.responseText);
                    sendNotification(3);
                }
            }
        };

        request.send(formData);
    });

    r.on('fileError', function(file, message){
        sendNotification(3);
        console.log("Error en el archivo: " + message);
    });

    r.on('progress', function (e) {
        //console.log("PROGRESO");
        let percentage = document.getElementById("uploadPercentage");
        percentage.innerText = (r.progress() * 100).toFixed(2)
        document.getElementById("loadBackground").style.width = (r.progress() * 100).toString() + "%";
        //console.log(r.progress());
    })
    if(!r.support) {
        sendNotification(2);
        setTimeout(function () {
            window.location.href = "index.php";
        }, 5000);
    }

    closeNotification.addEventListener("click", function () {
        closeNotificationFunc();
    });
}

let isNotificationActive = false;

function closeNotificationFunc() {
    if(isNotificationActive) {
        notificationContainer.style.top = "-15%";
        isNotificationActive = false;
    }
}

function sendNotification(status) {
    notificationContainer.style.top = "-15%";
    switch (status) {
        case 1:
            //Correcto
            notificationContainer.style.backgroundColor = "#0DB104";
            document.getElementById("notificationContent").innerText = "Video subido correctamente";
            break;
        case 2:
            //Error de compatibilidad
            notificationContainer.style.backgroundColor = "#E28C06";
            document.getElementById("notificationContent").innerText = "No hay soporte para subir archivos, se te redirigirá en 5 segundos";
            break;
        case 3:
            //Fallo al subir el archivo
            notificationContainer.style.backgroundColor = "#F2785C";
            document.getElementById("notificationContent").innerText = "Error al subir el archivo!";
            break;
    }

    notificationContainer.style.top = "5%";
    isNotificationActive = true;
}

function getUnderscoredVideoName(videoName) {
    let newVideoName = "";
    for(let i = 0; i < videoName.length; i++) {
        if (videoName.charAt(i) === " ") {
            newVideoName += "_";
        } else {
            newVideoName += videoName.charAt(i);
        }
    }

    return newVideoName;
}