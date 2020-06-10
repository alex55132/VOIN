let compraBtns;

window.addEventListener('load', function () {
    document.getElementById("atras").addEventListener("click", function () {
        window.location.href = "index.php";
    });

    compraBtns = document.getElementsByClassName("productoCompraBtn");
    for(let i = 0; i < compraBtns.length; i++) {
        let item = compraBtns[i];

        item.addEventListener("click", function () {
            let productoId = this.dataset.productoid;
            let precio = this.dataset.precio;
            let stock = this.dataset.stock;

            let compraPetition = new XMLHttpRequest();
            let compraData = new FormData();

            compraData.append("productoId", productoId);
            compraData.append("precio", precio);
            compraData.append("stock", stock);

            compraPetition.open("POST", "Controllers/compraProductoController.php");

            compraPetition.onreadystatechange = function () {
                if(compraPetition.readyState === 4) {
                    if(compraPetition.status === 200) {
                        let jsonData = JSON.parse(compraPetition.responseText);

                        alert(jsonData.message);
                        if(jsonData.statusCode === 1) {
                            location.reload();
                        }
                    }
                }
            }

            compraPetition.send(compraData);
        });
    }
});