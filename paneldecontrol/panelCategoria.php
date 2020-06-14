<?php
require_once "../utils/utils.php";
session_start();
if(isDataAvailable($_SESSION)) {
    if(isDataAvailable($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];
        include_once "../Classes/BaseDeDatos.php";
        include_once "../Classes/Categoria.php";
        if (isset($_GET)&& !empty($_GET)){
            if ($_GET['id']!=0){
                $id=$_GET['id'];
                $categoria=Categoria::getCategoriaById($id);
            }
            else{
                $id=0;
                $categoria=new Categoria();
            }
        }else{
            $id=0;
            $categoria=new Categoria();
        }
        if (isset($_POST)&& !empty($_POST)){
            if ($_POST['nom_cat']!=""){

                if (!empty($_POST['id_cat'])){
                    Categoria::updateCategoria($_POST,$_FILES);
                }else{
                    Categoria::subirCategoria($_POST,$_FILES);
                }
                header("Location: panelDeControl.php");
            }
            else{
                echo "<script>alert('rellena todo los datos correctamente')</script>";
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
                <input type="hidden" name="id_cat" value="<?php echo $categoria->getId() ?>">
                <li><label>Nombre</label></li><li><input value="<?php echo $categoria->getNombre()?>" type="text" id="nombre" class="inputForm inputSingleLined" placeholder="Nombre de la categoria" name="nom_cat"></li>
                <li><div class="miniaturaFileUploadContainer">
                <input name="foto" type="file" id="miniaturaInput" class="inputForm" accept="image/png, image/jpg">
            </div></li>
            <li><div class="miniaturaPreview">
                    <img id="miniaturaPreview" src="<?php if($categoria->getImagen()!=""){
                        echo "../".$categoria->getImagen();
                    }else{
                        echo "#";
                    }
                    ?>">
                </div></li>
            <li><input type="submit" value="Guardar"></li>

            </div>
        </ul>
    </form>
    </div>
</section>
</body>
</html>

