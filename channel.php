<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/navStyle.css">
    <link rel="stylesheet" href="css/channelStyle.css">
    <script src="js/mainScript.js"></script>
    <script src="js/channelScript.js"></script>
    <title>VOIN - Canal ejemplo</title>
</head>
<body>
<?php
require_once "utils/utils.php";

$existeUsuario = false;

if(isDataAvailable($_GET) && isDataAvailable($_GET['channelId'])) {
    //Iniciamos la sesion
    session_start();

    include "includes/navbarInclude.php";

    $channelId = $_GET['channelId'];
    if(is_numeric($channelId)) {
        //Es un numero, por lo que comenzamos a trabajar con este canal y a mostrar los datos relativos al canal
        require_once "Classes/Usuario.php";

        $usuario = Usuario::getUsuarioById($channelId);
        if($usuario == null) {
            header("Location: index.php");
        }
        $existeUsuario = true;
    } else {
        //Si el argumento pasado no es un numero redirigimos al index
        header("Location: index.php");
    }

} else {
    //Si no hay ningun dato por get redirigimos a la pagina inicial
    header("Location: index.php");
}

?>

<section class="mainContainer">
    <div class="channelIconContainer">
        <?php
            if($existeUsuario) {
                echo '<img class="channelIconImg" src="'.$usuario->getImg().'">
                    <p>'.$usuario->getNombre().'</p>';
            } else {
                echo '<img class="channelIconImg" src="https://www.xtrafondos.com/wallpapers/espacio-estrellas-universo-nebulosa-3337.jpg">
                    <p>El nombre de canal más largo del mundoo</p>';
            }
        ?>
    </div>

    <div class="channelContentContainer">
        <div class="topVideosContainer">
            <div class="topVideosTitle">
                <div class="topVideosTitleElements">
                    <h1>Top videos</h1>
                    <?php
                        if(isDataAvailable($_SESSION)) {
                            if (isDataAvailable($_SESSION['userId'])) {
                                if($existeUsuario) {
                                    echo '<button class="suscribeBtn" id="suscribeBtn" data-suscriber="'.$_SESSION['userId'].'" data-suscribedTo="'.$channelId.'">Suscribirse</button>';
                                } else {
                                    echo '<button class="suscribeBtn">Suscribirse</button>';
                                }
                            } else {
                                echo '<button class="suscribeBtn">Haz login para suscribirte</button>';
                            }
                        } else {
                            echo '<button class="suscribeBtn">Haz login para suscribirte</button>';
                        }
                    ?>
                </div>
                <hr>
            </div>
            <div class="topVideosDisplayer">
                <div class="scrollController">
                    <p class="carouselController" id="leftScroller"><-</p>
                </div>
                <!-- TODO: ALTs en imagenes -->
                <div id="videoScroller" class="videoScroller">
                    <?php
                    if($existeUsuario) {
                            require_once "Classes/Listador.php";

                            $topVideos = Listador::listarVideos(0, 6, $channelId, false, 0, true);
                            $videosCounter = 6;

                            for ($i = 0; $i < sizeof($topVideos); $i++) {
                                $video = $topVideos[$i];

                                echo '<div id="video'.($i+1).'" class="video videoScrollerItem" data-video-redirection="'.$video->getId().'">
                                        <img src="'.$video->getMiniatura().'">
                                        <h3>'.$video->getTitulo().'</h3>
                                        <h4>By '.$video->getNombreUsuario().'</h4>
                                        <h4>'.$video->getVisualizaciones().' rep</h4>
                                    </div>';
                                $videosCounter--;
                            }

                            if($videosCounter > 0) {
                                for ($e = (6 - $videosCounter); $e < 6; $e++) {
                                    echo '<div id="video'.($e+1).'" class="video videoScrollerItem">
                                            <img src="https://www.optoma.es/images/ProductApplicationFeatures/4kuhd/banner.jpg">
                                            <h3>El usuario no tiene más videos</h3>
                                        </div>';
                                }
                            }
                        } else {
                            header("Location: index.php");
                        }
                    ?>
                </div>

                <div class="scrollController righty">
                    <p class="carouselController" id="rightScroller">-></p>
                </div>
            </div>

            <div class="topVideosTitle">
                <h1>Todos los videos</h1>
                <hr>
            </div>
            <div class="fullVideosContainer">
                <?php
                    if($existeUsuario) {
                        $videos = Listador::listarVideos(0, 12, $channelId, false, 0, false);

                        for ($i = 0; $i < sizeof($videos); $i++) {
                            $video = $videos[$i];
                            echo '<div class="video videoListItem" data-video-redirection="'.$video->getId().'">
                                    <img src="'.$video->getMiniatura().'">
                                    <h3>'.$video->getTitulo().'</h3>
                                    <h4>By '.$video->getNombreUsuario().'</h4>
                                    <h4>'.$video->getVisualizaciones().' rep</h4>
                                </div>';
                        }
                    }
                ?>
                <!--<div class="video videoListItem">
                    <img src="https://pbs.twimg.com/profile_images/949787136030539782/LnRrYf6e.jpg">
                    <h3>Titulo de video 1</h3>
                    <h4>By alexby</h4>
                    <h4>35562 rep</h4>
                </div>
                <div class="video videoListItem">
                    <img src="https://pbs.twimg.com/profile_images/949787136030539782/LnRrYf6e.jpg">
                    <h3>Titulo de video 1</h3>
                    <h4>By alexby</h4>
                    <h4>35562 rep</h4>
                </div>
                <div class="video videoListItem">
                    <img src="https://pbs.twimg.com/profile_images/949787136030539782/LnRrYf6e.jpg">
                    <h3>Titulo de video 1</h3>
                    <h4>By alexby</h4>
                    <h4>35562 rep</h4>
                </div>
                <div class="video videoListItem">
                    <img src="https://pbs.twimg.com/profile_images/949787136030539782/LnRrYf6e.jpg">
                    <h3>Titulo de video 1</h3>
                    <h4>By alexby</h4>
                    <h4>35562 rep</h4>
                </div>
                <div class="video videoListItem">
                    <img src="https://pbs.twimg.com/profile_images/949787136030539782/LnRrYf6e.jpg">
                    <h3>Titulo de video 1</h3>
                    <h4>By alexby</h4>
                    <h4>35562 rep</h4>
                </div>
                <div class="video videoListItem">
                    <img src="https://pbs.twimg.com/profile_images/949787136030539782/LnRrYf6e.jpg">
                    <h3>Titulo de video 1</h3>
                    <h4>By alexby</h4>
                    <h4>35562 rep</h4>
                </div>
                <div class="video videoListItem">
                    <img src="https://pbs.twimg.com/profile_images/949787136030539782/LnRrYf6e.jpg">
                    <h3>Titulo de video 1</h3>
                    <h4>By alexby</h4>
                    <h4>35562 rep</h4>
                </div>
                <div class="video videoListItem">
                    <img src="https://pbs.twimg.com/profile_images/949787136030539782/LnRrYf6e.jpg">
                    <h3>Titulo de video 1</h3>
                    <h4>By alexby</h4>
                    <h4>35562 rep</h4>
                </div>-->
            </div>
        </div>
    </div>
</section>

<?php
include "includes/loginInclude.php";
?>

</body>
</html>