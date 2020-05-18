window.onload = function () {
    let verMasCategoryBtn = document.getElementById("verMasCategoryBtn");
    let verMasChannelBtn = document.getElementById("verMasChannelBtn");


    verMasCategoryBtn.addEventListener("click", function () {
        window.location.href = "./browseCategoriesChannels.php";
    });

    verMasChannelBtn.addEventListener("click", function () {
        window.location.href = "./browseCategoriesChannels.php?displayChannels=true";
    });

}