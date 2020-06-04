<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/navStyle.css">
    <link rel="stylesheet" href="css/browseStyle.css">
    <link rel="stylesheet" href="css/browseCategoriesChannelsStyle.css">
    <script src="js/mainScript.js"></script>
    <script src="js/browseCategoriesChannelsScript.js"></script>
    <script src="js/utilFunctions.js"></script>
    <script src="js/login.js"></script>
    <title>VOIN - Browse Categories</title>
</head>
<body>
<?php
session_start();
//Para incluir correctamente la navbar, es necesario usar un <link> al archivo de css navStyle
include_once "includes/navbarInclude.php";
include_once "utils/utils.php";

$pageTitle = "Categorias";
$displayCat = true;

if(isDataAvailable($_GET)) {
    $displayChannels = $_GET['displayChannels'];

    if($displayChannels == "true") {
        $displayCat = false;
        $pageTitle = "Canales";
    }
}
?>
<section class="mainContainer">
    <div class="categoriaContainer">
        <div class="categoriesNavigation">
            <h1><?php echo $pageTitle;?></h1>
            <form class="sortForm">
                <label for="sortBy">Ordenar por:</label>
                <select id="sortBy">
                    <option value="1" selected>Recomendado</option>
                    <option value="2">Mas visitas</option>
                    <option value="3">Menos visitas</option>
                </select>
            </form>
            <form class="searchForm">
                <input placeholder="Buscar">
            </form>
        </div>
        <hr>
        <div class="categoryListContainer">
            <?php
            require_once "Classes/Listador.php";
            require_once "Classes/Categoria.php";

            $categorias = Listador::listarCategorias(0, null);
            $canales = Listador::listarCanales(0, null, false, 0);

            if($displayCat) {

                for ($i = 0; $i < sizeof($categorias); $i++) {
                    $categoria = $categorias[$i];
                    echo '<div class="categoryListItem" id="'.$categoria->getId().'">
                        <img class="categoryItemImage" src="'.$categoria->getImagen().'">
                        <h3 class="titleCategory">'.$categoria->getNombre().'</h3>
                     </div>';
                }
            } else {
                for ($i = 0; $i < sizeof($canales); $i++) {
                    $canal = $canales[$i];
                    echo '<div class="categoryListItem" id="'.$canal->getId().'">
                        <img class="categoryItemImage" src="'.$canal->getImg().'">
                        <h3 class="titleCategory">'.$canal->getNombre().'</h3>
                        <h4 class="subtitleCategory">'.sizeof($canal->getVideosSubidos()).' videos</h4>
                     </div>';
                }
            }
            ?>
           <!-- <div class="categoryListItem">
                <img class="categoryItemImage" src="https://i.blogs.es/148ebe/croacia-sunset/1366_2000.jpg">
                <h3 class="titleCategory">Categoria 1</h3>
                <h4 class="subtitleCategory">n videos</h4>
            </div>
            <div class="categoryListItem">
                <img class="categoryItemImage" src="https://i.blogs.es/148ebe/croacia-sunset/1366_2000.jpg">
                <h3 class="titleCategory">Categoria 2</h3>
                <h4 class="subtitleCategory">n videos</h4>
            </div>
            <div class="categoryListItem">
                <img class="categoryItemImage" src="https://i.blogs.es/148ebe/croacia-sunset/1366_2000.jpg">
                <h3 class="titleCategory">Categoria 3</h3>
                <h4 class="subtitleCategory">n videos</h4>
            </div>
            <div class="categoryListItem">
                <img class="categoryItemImage" src="https://i.blogs.es/148ebe/croacia-sunset/1366_2000.jpg">
                <h3 class="titleCategory">Categoria 4</h3>
                <h4 class="subtitleCategory">n videos</h4>
            </div>
            <div class="categoryListItem">
                <img class="categoryItemImage" src="https://i.blogs.es/148ebe/croacia-sunset/1366_2000.jpg">
                <h3 class="titleCategory">Categoria 5</h3>
                <h4 class="subtitleCategory">n videos</h4>
            </div>
            <div class="categoryListItem">
                <img class="categoryItemImage" src="https://i.blogs.es/148ebe/croacia-sunset/1366_2000.jpg">
                <h3 class="titleCategory">Categoria 6</h3>
                <h4 class="subtitleCategory">n videos</h4>
            </div>
            <div class="categoryListItem">
                <img class="categoryItemImage" src="https://i.blogs.es/148ebe/croacia-sunset/1366_2000.jpg">
                <h3 class="titleCategory">Categoria 7</h3>
                <h4 class="subtitleCategory">n videos</h4>
            </div>
            <div class="categoryListItem">
                <img class="categoryItemImage" src="https://i.blogs.es/148ebe/croacia-sunset/1366_2000.jpg">
                <h3 class="titleCategory">Categoria 8</h3>
                <h4 class="subtitleCategory">n videos</h4>
            </div> -->
        </div>
    </div>
</section>

<?php
include "includes/loginInclude.php";
?>
</body>
</html>