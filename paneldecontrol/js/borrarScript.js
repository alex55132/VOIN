function ajax() {
    try {
        req = new XMLHttpRequest();
    } catch(err1) {
        try {
            req = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (err2) {
            try {
                req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (err3) {
                req = false;
            }
        }
    }
    return req;
}

var borrar = new ajax();
function borrarVideo(id) {
    if(confirm("¿Seguro que deseas eliminar el Video?")) {
        var myurl = 'Controllers/borrarVideo.php';
        myRand = parseInt(Math.random() * 999999999999999);
        modurl = myurl + '?rand=' + myRand + '&id=' + id;
        borrar.open('GET', modurl, true);
        borrar.onreadystatechange = borrarResponse;
        borrar.send(null);
    }
}
function borrarProducto(id) {
    if(confirm("¿Seguro que deseas eliminar el Producto?")) {
        var myurl = 'Controllers/borrarProducto.php';
        myRand = parseInt(Math.random() * 999999999999999);
        modurl = myurl + '?rand=' + myRand + '&id=' + id;
        borrar.open('GET', modurl, true);
        borrar.onreadystatechange = borrarResponse;
        borrar.send(null);
    }
}
function borrarCategoria(id) {
    if(confirm("¿Seguro que deseas eliminar la Categoria?")) {
        var myurl = 'Controllers/borrarCategoria.php';
        myRand = parseInt(Math.random() * 999999999999999);
        modurl = myurl + '?rand=' + myRand + '&id=' + id;
        borrar.open('GET', modurl, true);
        borrar.onreadystatechange = borrarResponse;
        borrar.send(null);
    }
}
function borrarEmpresa(id) {
    if(confirm("¿Seguro que deseas eliminar la Empresa?")) {
        var myurl = 'Controllers/borrarEmpresa.php';
        myRand = parseInt(Math.random() * 999999999999999);
        modurl = myurl + '?rand=' + myRand + '&id=' + id;
        borrar.open('GET', modurl, true);
        borrar.onreadystatechange = borrarResponse;
        borrar.send(null);
    }
}
function borrarResponse() {

    if (borrar.readyState == 4) {
        if(borrar.status == 200) {
            location.reload();
        }else  {
            alert("Algo ha ido mal");
        }
    }
}