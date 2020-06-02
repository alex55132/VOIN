window.addEventListener('load',function () {
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

    let channelList = document.getElementsByClassName("channel");

    for(let i = 0; i < channelList.length; i++) {
        channelList[i].addEventListener("click", function (e) {
            e.stopPropagation();

            let idCanal = this.dataset["channelRedirection"];
            window.location.href = "channel.php?channelId="+idCanal;
        });
    }

});