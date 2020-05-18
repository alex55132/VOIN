window.onload = function () {
    let itemList = document.getElementsByClassName("categoryListItem");

    let item;
    for(let i = 0; i < itemList.length; i++) {
        item = itemList[i];

        item.addEventListener("mouseover", function (e) {
            e.stopPropagation();

            this.childNodes[1].style.filter = "blur(5px)";
            this.childNodes[3].style.opacity = "1";
            this.childNodes[5].style.opacity = "1";
        });

        item.addEventListener("mouseleave", function (e) {
            e.stopPropagation();
            this.childNodes[1].style.filter = "blur(0px)";
            this.childNodes[3].style.opacity = "0";
            this.childNodes[5].style.opacity = "0";
        });


    }
}