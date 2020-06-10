<?php
require_once "../utils/utils.php";
session_start();
if(isDataAvailable($_SESSION)) {
    if(isDataAvailable($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];
        include_once "../Classes/BaseDeDatos.php";
        include_once "../Classes/Producto.php";
        $db = new BaseDeDatos();
        $empresas = $db->realizarConsulta("SELECT * FROM empresa");
        $db->cerrarConexion();
        if (isset($_GET)&& !empty($_GET)){
            if ($_GET['id']!=0){
                $id=$_GET['id'];
                $producto=new Producto();
                $producto->ObtenerPorId($id);
                $proemp= $producto->getIdEmpr();
            }
            else{
                $id=0;
                $producto=new Producto();
                $proemp="";
            }
        }else{
            $id=0;
            $producto=new Producto();
            $proemp="";
        }
        if (isset($_POST)&& !empty($_POST)){
            if ($_POST['nom_pro']!="" && is_numeric($_POST['pre_pro']) && is_numeric($_POST['stock_pro']) && $_POST['descr_pro']!="" && $_POST['id_empr']!=0){
                /*nom_pro pre_pro stock_pro descr_pro id_empr*/
                if (!empty($_POST['id_pro'])){

                    Producto::updateProducto($_POST,$_FILES);
                }else{
                    Producto::subirProducto($_POST,$_FILES);
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
                <input type="hidden" name="id_pro" value="<?php echo $producto->getIdPro() ?>">
                <li><label>Nombre</label></li><li><input value="<?php echo $producto->getNomPro()?>" type="text" id="nombre" class="inputForm inputSingleLined" placeholder="Nombre del producto" name="nom_pro"></li>
                <li><label>Precio</label></li><li><input value="<?php echo $producto->getPrePro()?>" type="text" id="precio" class="inputForm inputSingleLined" placeholder="Precio" name="pre_pro"></li>
                <li><label>Stock</label></li><li><input value="<?php echo $producto->getStockPro()?>" type="text" id="stock" class="inputForm inputSingleLined" placeholder="Stock" name="stock_pro"></li>
                <li><label>Descripcion</label></li><li><textarea name="descr_pro" class="inputForm" id="descripcionVideo" rows="6" placeholder="Descripcion"><?php echo $producto->getDescrPro()?></textarea></li>
                <li><label>Categoria</label><select id="empresas" class="inputForm inputSingleLined selectItem" name="id_empr">
                        <option disabled selected value="-1" class="firstOption">Etiquetas</option>
                        <?php
                        for($i = 0; $i < sizeof($empresas); $i++) {
                            if($proemp[0][0]==$empresas[$i][0]){
                                echo '<option selected value="'.$empresas[$i][0].'">'.$empresas[$i][1].'</option>';
                            }else{
                                echo '<option value="'.$empresas[$i][0].'">'.$empresas[$i][1].'</option>';
                            }
                        }
                        ?></select></li>
                <li><div class="miniaturaFileUploadContainer"></li>
                <li><input name="foto" type="file" id="miniaturaInput" class="inputForm" accept="image/png, image/jpg">
            </div>
            <li><div class="miniaturaPreview">
                    <img id="miniaturaPreview" src="<?php if($producto->getImgPro()!=""){
                        echo "../imgs/tienda/".$producto->getImgPro();
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

