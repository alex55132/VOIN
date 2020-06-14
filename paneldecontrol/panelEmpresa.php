<?php
require_once "../utils/utils.php";
session_start();
if(isDataAvailable($_SESSION)) {
    if(isDataAvailable($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];
        include_once "../Classes/BaseDeDatos.php";
        include_once "../Classes/Empresa.php";
        if (isset($_GET)&& !empty($_GET)){
            if ($_GET['id']!=0){
                $id=$_GET['id'];
                $empresa=new Empresa();
                $empresa=$empresa->getEmpresaById($id);
            }
            else{
                $id=0;
                $empresa=new Empresa();
            }
        }else{
            $id=0;
            $empresa=new Empresa();
        }
        if (isset($_POST)&& !empty($_POST)){
            if ($_POST['nom_empr']!="" && is_numeric($_POST['telefono_empr'])  && $_POST['correo_empr']!="" && $_POST['direccion_empr']!="" && $_POST['web_empr']!=""){
               if (!empty($_POST['id_empr'])){

                   Empresa::updateEmpresa($_POST);
                }else{
                   Empresa::subirEmpresa($_POST);
                }
                header("Location: panelDeControl.php");
            }
            else{
                echo "<script>alert('rellena todos los datos correctamente')</script>";
            }
        }
    } else {
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VOIN - Panel de control</title>
    <link rel="stylesheet" href="css/navPanelControl.css">
    <link rel="stylesheet" href="css/panelDeControlStyle.css">
    <link rel="stylesheet" href="css/panelModificarStyle.css">
    <script src="js/navPanelControlScript.js"></script>
    <script src="js/controlPanelScript.js"></script>
</head>
<body>
<?php
$user = "";
//LA VARIABLE $USER y el utils.php SE DECLARA DENTRO DE ESTE REQUIRE
require_once "../includes/navbarPanelControl.php";
?>

<section class="mainContainer">
    <form  enctype="multipart/form-data" name="modificar" action="<?php echo $_SERVER['PHP_SELF']."?id=".$id ?>" method="post">
        <ul><div class="dataContainer">
                <input type="hidden" name="id_empr" value="<?php echo $empresa->getId() ?>">
                <li><label>Nombre</label></li><li><input value="<?php echo $empresa->getNomEmpr()?>" type="text" id="nombre" class="inputForm inputSingleLined" placeholder="Nombre de la Empresa" name="nom_empr"></li>
                <li><label>Correo</label></li><li><input value="<?php echo $empresa->getCorreoEmpr()?>" type="text" id="correo" class="inputForm inputSingleLined" placeholder="Correo" name="correo_empr"></li>
                <li><label>Direccion</label></li><li><input value="<?php echo $empresa->getDireccionEmpr()?>" type="text" id="direccion" class="inputForm inputSingleLined" placeholder="Direccion" name="direccion_empr"></li>
                <li><label>Telefono</label></li><li><input value="<?php echo $empresa->getTelefonoEmpr()?>" type="text" id="telefono" class="inputForm inputSingleLined" placeholder="Telefono" name="telefono_empr"></li>
                <li><label>Web</label></li><li><input value="<?php echo $empresa->getWebEmpr()?>" type="text" id="web" class="inputForm inputSingleLined" placeholder="Web" name="web_empr"></li>
            <li><input type="submit" value="Guardar"></li>

            </div>
        </ul>
    </form>
    </div>
</section>

</body>
</html>

