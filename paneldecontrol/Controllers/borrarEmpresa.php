<?php
require "../../Classes/Empresa.php";
$id=intval($_GET['id']);
Empresa::eliminarEmpresa($id);
