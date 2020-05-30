<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/navStyle.css">
    <link rel="stylesheet" href="css/browseStyle.css">
    <script src="js/mainScript.js"></script>
    <script src="js/browseScript.js"></script>
    <title>VOIN - Browse</title>
</head>
<body>
<?php
session_start();

//Para incluir correctamente la navbar, es necesario usar un <link> al archivo de css navStyle
include "includes/navbarInclude.php";
require_once "Classes/Listador.php";
require_once "Classes/Categoria.php";

$categorias = Listador::listarCategorias();

$canales = Listador::listarCanales();
?>
    <section class="mainContainer">
        <div class="categoryChannelContainer">
            <div class="categoryChannelHeader">
                <h1>Categorias</h1>
                <form class="searchForm">
                    <input type="text" placeholder="Holiquetal">
                </form>
            </div>
            <hr>
            <div class="categoryChannelContent">
                <?php
                    for ($i = 0; $i < sizeof($categorias); $i++) {
                        $categoria = $categorias[$i];
                        echo '<div class="itemCategoryChannel category" id="'.$categoria->getId().'">
                                <div class="categoryImg">
                                    <img src="'.$categoria->getImagen().'">
                                </div>
                                <h3>'.$categoria->getNombre().'</h3>
                            </div>';
                    }
                ?>
                <div class="displayMoreContainer">
                    <button type="button" id="verMasCategoryBtn">Ver más</button>
                </div>
            </div>
        </div>

        <div class="categoryChannelContainer">
            <div class="categoryChannelHeader">
                <h1>Canales</h1>
                <form class="searchForm">
                    <input type="text" placeholder="Holiquetal">
                </form>
            </div>
            <hr>
            <div class="categoryChannelContent">
                <?php
                    for ($e = 0; $e < sizeof($canales); $e++) {
                        $canal = $canales[$e];

                        echo '<div class="itemCategoryChannel channel" data-channel-redirection="'.$canal->getId().'">
                                <div class="categoryImg">
                                    <img src="'.$canal->getImg().'">
                                </div>
                                <h3>'.$canal->getNombre().'</h3>
                            </div>';
                    }
                ?>

               <!-- <div class="itemCategoryChannel channel">
                    <div class="categoryImg">
                        <img src="https://imgs.classicfm.com/images/61630?crop=16_9&width=660&relax=1&signature=yUpYOmeFfocGYtAn9AJH6NCdl3g=">
                    </div>
                    <h3>Canal 1</h3>
                    <h4>N videos</h4>
                </div>
                <div class="itemCategoryChannel channel">
                    <div class="categoryImg">
                        <img src="https://imgs.classicfm.com/images/61630?crop=16_9&width=660&relax=1&signature=yUpYOmeFfocGYtAn9AJH6NCdl3g=">
                    </div>
                    <h3>Canal 1</h3>
                    <h4>N videos</h4>
                </div>
                <div class="itemCategoryChannel channel">
                    <div class="categoryImg">
                        <img src="https://imgs.classicfm.com/images/61630?crop=16_9&width=660&relax=1&signature=yUpYOmeFfocGYtAn9AJH6NCdl3g=">
                    </div>
                    <h3>Canal 1</h3>
                    <h4>N videos</h4>
                </div>
                <div class="itemCategoryChannel channel">
                    <div class="categoryImg">
                        <img src="https://imgs.classicfm.com/images/61630?crop=16_9&width=660&relax=1&signature=yUpYOmeFfocGYtAn9AJH6NCdl3g=">
                    </div>
                    <h3>Canal 1</h3>
                    <h4>N videos</h4>
                </div>
                <div class="itemCategoryChannel channel">
                    <div class="categoryImg">
                        <img src="https://imgs.classicfm.com/images/61630?crop=16_9&width=660&relax=1&signature=yUpYOmeFfocGYtAn9AJH6NCdl3g=">
                    </div>
                    <h3>Canal 1</h3>
                    <h4>N videos</h4>
                </div>-->
                <div class="displayMoreContainer">
                    <button type="button" id="verMasChannelBtn">Ver más</button>
                </div>
            </div>
        </div>
    </section>

<?php
include "includes/loginInclude.php";
?>
</body>
</html>
