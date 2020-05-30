window.onload = function () {
    let itemList = document.getElementsByClassName("categoryListItem");
    let arraySubtitles = document.getElementsByClassName("subtitleCategory");
    let item;
    let urlData = getUrlParameters();

    for (let i = 0; i < itemList.length; i++) {
        item = itemList[i];

        item.addEventListener("mouseover", function (e) {
            e.stopPropagation();

            this.childNodes[1].style.filter = "blur(5px)";
            this.childNodes[3].style.opacity = "1";
            if(arraySubtitles.length > 0) {
                this.childNodes[5].style.opacity = "1";
            }
        });

        item.addEventListener("mouseleave", function (e) {
            e.stopPropagation();
            this.childNodes[1].style.filter = "blur(0px)";
            this.childNodes[3].style.opacity = "0";
            if(arraySubtitles.length > 0) {
                this.childNodes[5].style.opacity = "0";
            }
        });

        item.addEventListener("click", function () {
            if(urlData != null && urlData['displayChannels'] === "true") {
                let idNumber = parseInt(this.id);
                window.location.href = "channel.php?channelId=" + idNumber;
            } else {
                let idNumber = parseInt(this.id);
                window.location.href = "index.php?categoryId=" + idNumber;
            }
        });
    }
}