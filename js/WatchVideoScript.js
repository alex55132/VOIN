let likeContainer;
let dislikeContainer;

let likeValue;
let dislikeValue;

window.addEventListener('load', function () {
    let videos = document.getElementsByClassName("relatedVideoItem");

    for(let i = 0; i < videos.length; i++) {
        videos[i].addEventListener("click", function (e) {
            e.stopPropagation();

            let idVideo = this.dataset["videoRedirection"];
            window.location.href = "WatchVideo.php?videoId="+idVideo;
        });
    }
    let urlParameters = getUrlParameters();

    let viewPetition = new XMLHttpRequest();

    let formDataPetition = new FormData();
    formDataPetition.append("videoId", urlParameters["videoId"]);
    viewPetition.open("POST", "Controllers/addVisitController.php");

    viewPetition.onreadystatechange = function (aEvt) {
        if (viewPetition.readyState === 4) {
            if(viewPetition.status === 200) {
                //console.log(viewPetition.responseText)
                console.log("Exito");
            }
            else {
                window.location.href = "index.php";
            }
        }
    };

    viewPetition.send(formDataPetition);

    likeContainer = document.getElementById("likeContainer");
    dislikeContainer = document.getElementById("dislikeContainer");

    likeValue = document.getElementById("likeValue");
    dislikeValue = document.getElementById("dislikeValue");

    let dataLikePetition = new FormData();
    dataLikePetition.append("videoId", urlParameters["videoId"]);

    let valoracionPetition = new XMLHttpRequest();

    //Variable para controlar la afluencia de peticiones
    let ongoingPetition = false;

    valoracionPetition.open("POST", "Controllers/videoReactController.php");

    valoracionPetition.onreadystatechange = function () {
        if(valoracionPetition.readyState === 4) {
            if(valoracionPetition.status === 200) {
                let jsonData = JSON.parse(valoracionPetition.responseText);
                console.log(jsonData);
                switch (jsonData.statusCode) {
                    case 0:
                        alert(jsonData.message);
                        break;
                    case 1:
                        if(valoration === 1) {
                            likeContainer.src = "imgs/likeDoneIcon.png";
                            likeValue.innerText = (parseInt(likeValue.innerText) + 1).toString();
                        } else if (valoration === -1) {
                            dislikeContainer.src = "imgs/dislikeDoneIcon.png";
                            dislikeValue.innerText = (parseInt(dislikeValue.innerText) + 1).toString();
                        }
                        break;
                    case 2:
                        alert(jsonData.message);
                        break;
                    case 3:
                        console.log("Error");
                        break;
                    case 4:
                        console.log(jsonData.message);
                        break;
                }

                ongoingPetition = false;
            } else {
                console.log("Error");
            }
        }
    }

    let valoration = 0;

    likeContainer.addEventListener("click", function () {
        if(!ongoingPetition) {
            valoration = 1;
            dataLikePetition.append("valoracion", valoration.toString());
            valoracionPetition.send(dataLikePetition);
            ongoingPetition = true;
        }
    });

    dislikeContainer.addEventListener("click", function () {
        if(!ongoingPetition) {
            valoration = -1;
            dataLikePetition.append("valoracion", valoration.toString());
            valoracionPetition.send(dataLikePetition);
            ongoingPetition = true;
        }
    });
});

