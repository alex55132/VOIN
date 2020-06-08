<?php
require_once "../utils/utils.php";
session_start();
if(isDataAvailable($_SESSION)) {
    if(isDataAvailable($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];
        include_once "../Classes/BaseDeDatos.php";
        include_once "../Classes/Video.php";
        $db = new BaseDeDatos();
        $categorias = $db->realizarConsulta("SELECT * FROM categoria");
        $db->cerrarConexion();
        if (isset($_GET)&& !empty($_GET)){
            $id=$_GET['id'];
            $video = Video::getVideoById($id);
            $videocat=$video->getCategoria();
            if (isset($_POST)&& !empty($_POST)){
                $video->actualizarVideo($_POST);
                header("Location: panelDeControl.php");
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
        <form enctype="multipart/form-data" name="modificar" action="<?php echo $_SERVER['PHP_SELF']."?id=".$id ?>" method="post">
            <ul><div class="dataContainer">
                <input type="hidden" name="id_video" value="<?php echo $video->getId()?>">
                <li><label>Titulo</label></li><li><input value="<?php echo $video->getTitulo()?>" type="text" id="titulo" class="inputForm inputSingleLined" placeholder="Titulo del vídeo" name="tit_video"></li>
                <li><label>Descripcion</label></li><li><textarea name="descr_video" class="inputForm" id="descripcionVideo" rows="6" placeholder="Descripcion"><?php echo $video->getDescripcion()?></textarea></li>
                    <li><label>Categoria</label><select id="etiquetasVideo" class="inputForm inputSingleLined selectItem" name="id_cat">
                    <option disabled selected value="-1" class="firstOption">Etiquetas</option>
                    <?php
                    for($i = 0; $i < sizeof($categorias); $i++) {
                        if($videocat[0][0]==$categorias[$i][0]){
                            echo '<option selected value="'.$categorias[$i][0].'">'.$categorias[$i][1].'</option>';
                        }else{
                            echo '<option value="'.$categorias[$i][0].'">'.$categorias[$i][1].'</option>';
                        }
                    }
                    ?>
                </select></li>
                    <li><div class="miniaturaFileUploadContainer"></li>
                    <li><input type="file" id="miniaturaInput" class="inputForm" accept="image/png, image/jpg">
                </div>
            <li><div class="miniaturaPreview">
                    <img id="miniaturaPreview" src="">
                </div></li>
                    <li><input type="submit" value="Guardar"></li>

            </div>
            </ul>
        </form>
    </div>
</section>
</body>
</html>
