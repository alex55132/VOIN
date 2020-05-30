window.onload = function () {
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
}

