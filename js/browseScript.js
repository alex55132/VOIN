window.onload = function () {
    let verMasCategoryBtn = document.getElementById("verMasCategoryBtn");
    let verMasChannelBtn = document.getElementById("verMasChannelBtn");


    verMasCategoryBtn.addEventListener("click", function () {
        window.location.href = "./browseCategoriesChannels.php";
    });

    verMasChannelBtn.addEventListener("click", function () {
        window.location.href = "./browseCategoriesChannels.php?displayChannels=true";
    });

    let categoryList = document.getElementsByClassName("category");

    for(let i = 0; i < categoryList.length; i++) {
        categoryList[i].addEventListener("click", function () {
            let idNumber = parseInt(this.id);
            window.location.href = "index.php?categoryId="+idNumber;
        });
    }

}