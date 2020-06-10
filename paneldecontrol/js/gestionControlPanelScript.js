//Zona de gestion
let catItem;
let prodItem;
let empItem;

window.addEventListener('load', function () {
    catItem = document.getElementById("catItem");
    prodItem = document.getElementById("prodItem");
    empItem = document.getElementById("empItem");

    if(catItem != null) {
        catItem.addEventListener("click", function () {
            //El 1 se corresponde a la gestion de categorias
            window.location.href = "panelDeControl.php?pestana=4&item=1";
        });
    }

    if(prodItem != null) {
        prodItem.addEventListener("click", function () {
            //El 2 se corresponde a la gestion de productos
            window.location.href = "panelDeControl.php?pestana=4&item=2";
        });
    }

    if(empItem != null) {
        empItem.addEventListener("click", function () {
            //El 3 se corresponde a la gestion de empresas
            window.location.href = "panelDeControl.php?pestana=4&item=3";
        });
    }
});