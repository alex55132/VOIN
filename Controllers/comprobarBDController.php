<?php
include_once "../Classes/Usuario.php";
include_once "../Classes/BaseDeDatos.php";
$correo=($_GET['correo']);
$tabla=($_GET['tabla']);
$nombre=($_GET['nombre']);
$contr=($_GET['contr']);
$sql="SELECT * FROM ".$tabla." WHERE corr_usu='".$correo."'";
$conexion=new BaseDeDatos();
$res=$conexion->realizarConsulta($sql);
$final="";
if ($res==null){
    if(Usuario::insertarUsuario($nombre,$correo,$contr)) {
        $final = "ok";
    } else {
        $final = "falloInsercion";
    }
}else{
    $final="repetido";
}
echo $final;
