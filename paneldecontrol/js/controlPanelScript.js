let videoTag;
let modTag;
let admTag;
let gestTag;


window.addEventListener('load', function () {
    //Cargamos las pestañas y le agregamos los listeners
    videoTag = document.getElementById("videoTag");
    modTag = document.getElementById("modTag");
    admTag = document.getElementById("admTag");
    gestTag = document.getElementById("gestTag");

    if(videoTag != null) {
        videoTag.addEventListener("click", function () {
            window.location.href = "./panelDeControl.php?pestana=1";
        });
    }

    if(modTag != null) {
        modTag.addEventListener("click", function () {
            window.location.href = "./panelDeControl.php?pestana=2";
        });
    }

    if(admTag != null) {
        admTag.addEventListener("click", function () {
            window.location.href = "./panelDeControl.php?pestana=3";
        });
    }

    if(gestTag != null) {
        gestTag.addEventListener("click", function () {
            window.location.href = "./panelDeControl.php?pestana=4";
        });
    }
});