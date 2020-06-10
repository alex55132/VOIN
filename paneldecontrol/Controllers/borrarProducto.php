<?php
require "../../Classes/Producto.php";
$id=intval($_GET['id']);
Producto::eliminarProducto($id);
