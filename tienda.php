<?php
require_once "Classes/Producto.php";
require_once "Classes/BaseDeDatos.php";
require_once "Classes/Listador.php";

session_start();

$lista =new Listador();

?>
<!doctype html>
<html lang="es">
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
        $lista->listarProductos();
        ?>
    </section>
</body>
</html>
