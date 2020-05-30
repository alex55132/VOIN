window.onload = function () {
    registerListeners();
}


function registerListeners() {
    let loginBtn = document.getElementById("loginBtn");
    let backgroundLogin = document.getElementById("backgroundLogin");
    let loginFormContainer = document.getElementById("loginFormContainer");
    let registerFormContainer = document.getElementById("registerFormContainer");
    let registerLink = document.getElementById("registerLink");

    loginBtn.addEventListener("click", function () {
        backgroundLogin.classList.remove("hidden");
        loginFormContainer.classList.remove("hidden");
    });

    backgroundLogin.addEventListener("click", function () {
        backgroundLogin.classList.add("hidden");
        loginFormContainer.classList.add("hidden");
        registerFormContainer.classList.add("hidden");
    });

    registerLink.addEventListener("click", function () {
        loginFormContainer.classList.add("hidden");
        registerFormContainer.classList.remove("hidden");
    });

    let videos = document.getElementsByClassName("videoItem");

    for(let i = 0; i < videos.length; i++) {
        videos[i].addEventListener("click", function (e) {
            e.stopPropagation();

            let idVideo = this.dataset["videoRedirection"];
            window.location.href = "WatchVideo.php?videoId="+idVideo;
        });
    }
}


