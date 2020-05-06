window.onload = function () {
    registerListeners();
}


function registerListeners() {
    let registerBtn = document.getElementById("loginBtn");
    let backgroundLogin = document.getElementById("backgroundLogin");
    let loginFormContainer = document.getElementById("loginFormContainer");


    registerBtn.addEventListener("click", function () {
        backgroundLogin.classList.remove("hidden");
        loginFormContainer.classList.remove("hidden");
    });

    backgroundLogin.addEventListener("click", function () {
        backgroundLogin.classList.add("hidden");
        loginFormContainer.classList.add("hidden");
    });
}

