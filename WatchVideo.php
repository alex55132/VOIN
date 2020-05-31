<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/navStyle.css">
    <link rel="stylesheet" href="css/watchVideo.css">
    <script src="js/WatchVideoScript.js"></script>
    <script src="js/utilFunctions.js"></script>
    <title>VOIN - Video</title>
</head>
<body>
<?php
session_start();

//Para incluir correctamente la navbar, es necesario usar un <link> al archivo de css navStyle
include_once "includes/navbarInclude.php";
include_once "utils/utils.php";
require_once "Classes/Video.php";
require_once "Classes/Listador.php";

?>

<section class="mainContainer">
    <?php
    if(isDataAvailable($_GET)) {
        $videoId = intval($_GET['videoId']);

        if($videoId != 0) {
            //Correcto
            $video = Video::getVideoById($videoId);

            //Generamos un numero aleatorio para evitar que se guarde en caché. De esta manera, nos ahorramos problemas probados en Firefox
            echo '<video controls preload="auto" poster="'.$video->getMiniatura().'" src="Controllers/streamVideoController.php?videoId='.$videoId.'&sign='.rand(0, getrandmax()).'"></video>';
            echo '<h1 class="videoTitle">
        '.$video->getTitulo().'
    </h1>
    <div class="descRepsContainer">
        <p class="description">'.$video->getDescripcion().'</p>

        <p class="reproductions">
            By <a href="channel.php?channelId='.$video->getIdUsuario().'" class="userLink">'.$video->getNombreUsuario().'</a> <br>
            '.$video->getVisualizaciones().' reproducciones
        </p>
    </div>
    <div class="likesContainer">
        <div class="likeContainerItem">
            <span class="like">'.$video->getLikes().'</span>
            <img src="imgs/LikeIcon.png">
        </div>
        <div class="likeContainerItem">
            <span class="dislike">'.$video->getDislikes().'</span>
            <img src="imgs/DislikeIcon.png">
        </div>
    </div>';
        } else {
            //Error
            header("Location: index.php");
        }
    } else {
        //Error
        header("Location: index.php");
    }
    ?>
</section>

<aside class="relatedVideos">
    <h2>Videos relacionados</h2>
    <?php

    $videos = Listador::listarVideos(0, 3, $_SESSION['userId'], false, 0, false);

    for($i = 0; $i < sizeof($videos); $i++) {
        $currentVideo = $videos[$i];

        echo '<div class="relatedVideoItem" data-video-redirection="'.$currentVideo->getId().'">
                <img src="'.$currentVideo->getMiniatura().'">
                <h3>'.$currentVideo->getTitulo().'</h3>
                <h4>By '.$currentVideo->getNombreUsuario().'</h4>
                <h4>'.$currentVideo->getVisualizaciones().' reproducciones</h4>
            </div>';
    }
    ?>
</aside>
</body>
</html>