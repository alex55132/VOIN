let videoTag;
let modTag;
let admTag;
let gestTag;


let acceptVideoBtn;
let rejectVideoBtn;

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

    acceptVideoBtn = document.getElementById("acceptVideoBtn");
    if(acceptVideoBtn != null) {
        acceptVideoBtn.addEventListener("click", function () {
            let acceptPetition = new XMLHttpRequest();

            acceptPetition.open("POST", "../Controllers/manageReportsController.php");

            let acceptPetitionData = new FormData();
            acceptPetitionData.append("typeRequest", "1");
            acceptPetitionData.append("videoId", acceptVideoBtn.dataset.acceptedvideo)

            acceptPetition.onreadystatechange = function () {
                if(acceptPetition.readyState === 4) {
                    if (acceptPetition.status === 200) {
                        let JSONData = JSON.parse(acceptPetition.responseText);
                        if(JSONData.statusCode === 1) {
                            alert(JSONData.message);
                            location.reload();
                        } else {
                            alert(JSONData.message);
                        }
                    }
                }
            }

            acceptPetition.send(acceptPetitionData);
        });
    }

    rejectVideoBtn = document.getElementById("rejectVideoBtn");
    if(rejectVideoBtn != null) {
        rejectVideoBtn.addEventListener("click", function () {
            let rejectPetition = new XMLHttpRequest();

            rejectPetition.open("POST", "../Controllers/manageReportsController.php");

            let rejectPetitionData = new FormData();
            rejectPetitionData.append("typeRequest", "2");
            rejectPetitionData.append("videoId", rejectVideoBtn.dataset.rejectedvideo);

            rejectPetition.onreadystatechange = function () {
                if(rejectPetition.readyState === 4) {
                    if (rejectPetition.status === 200) {
                        let JSONData = JSON.parse(rejectPetition.responseText);
                        if(JSONData.statusCode === 1) {
                            alert(JSONData.message);
                            location.reload();
                        } else {
                            alert(JSONData.message);
                        }
                    }
                }
            }

            rejectPetition.send(rejectPetitionData);
        });
    }
});