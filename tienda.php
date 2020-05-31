<?php
require "Classes/Producto.php";
require "Classes/BaseDeDatos.php";
require "Classes/Lista.php";

session_start();

$lista =new Lista();
$lista->obtenerElementos();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VOIN - Tienda</title>
    <link rel="stylesheet" href="css/navTienda.css">
    <link rel="stylesheet" href="css/tiendaStyle.css">
    <script src="js/tiendaScript.js"></script>
</head>
<body>
<?php
include "includes/navTienda.php";
?>
    <section>
        <?php
        echo $lista->imprimirProductosEnBack();
        ?>

    </section>
</body>
</html>
