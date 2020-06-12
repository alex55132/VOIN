<?php
require "../../Classes/Categoria.php";
$id=intval($_GET['id']);
Categoria::eliminarCategoria($id);