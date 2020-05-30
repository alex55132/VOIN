<?php
include "../Classes/Usuarios.php";
include "../Classes/BaseDeDatos.php";
$correo=($_GET['correo']);
$tabla=($_GET['tabla']);
$nombre=($_GET['nombre']);
$contr=($_GET['contr']);
$sql="SELECT * FROM ".$tabla." WHERE corr_usu='".$correo."'";
$conexion=new BaseDeDatos();
$res=$conexion->realizarConsulta($sql);
$final="";
if ($res==null){
    $usu=new Usuarios();
    $usu->insertarUsuario($nombre,$correo,$contr);
    header("index.php");
}else{
    $final="repetido";
}
echo $final;
