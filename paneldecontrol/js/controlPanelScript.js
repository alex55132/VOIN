let videoTag;
let modTag;
let admTag;
let gestTag;


let acceptVideoBtn;
let rejectVideoBtn;

let goToChannelBtns;
let deleteUserBtns;

window.addEventListener('load', function () {
    //Cargamos las pestañas y le agregamos los listeners
    videoTag = document.getElementById("videoTag");
    modTag = document.getElementById("modTag");
    admTag = document.getElementById("admTag");
    gestTag = document.getElementById("gestTag");


    goToChannelBtns = document.getElementsByClassName("verCanalBtn");
    deleteUserBtns = document.getElementsByClassName("eliminarCuentaBtn");

    if (goToChannelBtns != null && deleteUserBtns != null) {
        for (let i = 0; i < goToChannelBtns.length; i++) {
            goToChannelBtns[i].addEventListener("click", function () {
                let channelId = this.dataset.canalid;
                if (channelId != null && channelId != 0) {
                    window.location.href = "../channel.php?channelId=" + channelId;
                }
            });
        }

        for (let a = 0; a < deleteUserBtns.length; a++) {
            deleteUserBtns[a].addEventListener("click", function () {
                let channelId = this.dataset.canalid;

                if (channelId != null && channelId != 0) {
                    //Si los datos son validos preparamos la peticion
                    let deletePetition = new XMLHttpRequest();
                    deletePetition.open("POST", "../Controllers/deleteUserController.php");

                    let deleteData = new FormData();
                    deleteData.append("channelToDeleteId", channelId.toString());

                    deletePetition.onreadystatechange = function () {
                        if (deletePetition.readyState === 4) {
                            if (deletePetition.status === 200) {
                                //Trabajamos con la respuesta
                                console.log(deletePetition.responseText);
                                let jsonResponse = JSON.parse(deletePetition.responseText);

                                alert(jsonResponse.message);

                                if (jsonResponse.statusCode === 0) {
                                    location.reload();
                                }
                            }
                        }
                    }

                    if (confirm("Seguro que quieres eliminar este usuario?")) {
                        deletePetition.send(deleteData);
                    }
                }
            });
        }
    }

    if (videoTag != null) {
        videoTag.addEventListener("click", function () {
            window.location.href = "./panelDeControl.php?pestana=1";
        });
    }

    if (modTag != null) {
        modTag.addEventListener("click", function () {
            window.location.href = "./panelDeControl.php?pestana=2";
        });
    }

    if (admTag != null) {
        admTag.addEventListener("click", function () {
            window.location.href = "./panelDeControl.php?pestana=3";
        });
    }

    if (gestTag != null) {
        gestTag.addEventListener("click", function () {
            window.location.href = "./panelDeControl.php?pestana=4";
        });
    }

    acceptVideoBtn = document.getElementById("acceptVideoBtn");
    if (acceptVideoBtn != null) {
        acceptVideoBtn.addEventListener("click", function () {
            let acceptPetition = new XMLHttpRequest();

            acceptPetition.open("POST", "../Controllers/manageReportsController.php");

            let acceptPetitionData = new FormData();
            acceptPetitionData.append("typeRequest", "1");
            acceptPetitionData.append("videoId", acceptVideoBtn.dataset.acceptedvideo)

            acceptPetition.onreadystatechange = function () {
                if (acceptPetition.readyState === 4) {
                    if (acceptPetition.status === 200) {
                        let JSONData = JSON.parse(acceptPetition.responseText);
                        if (JSONData.statusCode === 1) {
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
    if (rejectVideoBtn != null) {
        rejectVideoBtn.addEventListener("click", function () {
            let rejectPetition = new XMLHttpRequest();

            rejectPetition.open("POST", "../Controllers/manageReportsController.php");

            let rejectPetitionData = new FormData();
            rejectPetitionData.append("typeRequest", "2");
            rejectPetitionData.append("videoId", rejectVideoBtn.dataset.rejectedvideo);

            rejectPetition.onreadystatechange = function () {
                if (rejectPetition.readyState === 4) {
                    if (rejectPetition.status === 200) {
                        let JSONData = JSON.parse(rejectPetition.responseText);
                        if (JSONData.statusCode === 1) {
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