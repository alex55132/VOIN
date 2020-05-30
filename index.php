<?php
require "Classes/BaseDeDatos.php";
require "Classes/Usuarios.php";

if (isset($_POST)&& !empty($_POST)){
    $corr = addslashes($_POST['corr_usu']);
    $pass = addslashes($_POST['contr_usu']);
    $usuario=new Usuarios();
    if ($usuario->login($corr,$pass)){
        session_start();
        $_SESSION['userId']=$usuario->getIdUsu();
    }else{
    }
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VOIN - Home</title>
    <link rel="stylesheet" href="css/homeStyle.css">
    <link rel="stylesheet" href="css/navStyle.css">
    <script src="js/login.js"></script>
    <script src="js/mainScript.js"></script>
</head>
<body>
<?php
session_start();
//$_SESSION['userId'] = 2;

include_once "utils/utils.php";
require_once "Classes/Listador.php";
//Para incluir correctamente la navbar, es necesario usar un <link> al archivo de css navStyle
include "includes/navbarInclude.php";
?>

<section class="mainContainer">

    <div class="videosContainer">
        <h1 class="mainTitle">Home</h1>
        <hr class="separadorTitle">

        <div class="videosDisplay">
            <?php
            $videoArray = [];
            if(isDataAvailable($_GET)) {
                if(isDataAvailable($_GET['categoryId'])) {
                    $videoArray = Listador::listarVideos(0, 9, 0, false, addslashes($_GET['categoryId']), false);
                } else {
                    if(isDataAvailable($_SESSION)) {
                        if (isDataAvailable($_SESSION['userId'])) {
                            $videoArray = Listador::listarVideos(0, 9, $_SESSION['userId'], true, 0, false);
                        } else {
                            $videoArray = Listador::listarVideos(0, 9, 0, false, 0, false);
                        }
                    } else {
                        $videoArray = Listador::listarVideos(0, 9, 0, false, 0, false);
                    }
                }
            } else {
                $videoArray = Listador::listarVideos(0, 9, 0, false, 0, false);
            }

            $displayCounter = 9;

            for ($i = 0; $i < sizeof($videoArray); $i++) {
                $video = $videoArray[$i];
                echo '<div class="videoItem" data-video-redirection="'.$video->getId().'" >
                                    <img src="' . $video->getMiniatura() . '">
                                    <h3>' . $video->getTitulo() . '</h3>
                                    <h4>By ' . $video->getNombreUsuario() . '</h4>
                                    <h4>' . $video->getVisualizaciones() . ' rep</h4>
                                  </div>';
                $displayCounter = $displayCounter - 1;
            }

            if ($displayCounter > 0) {
                for ($e = 0; $e < $displayCounter; $e++) {
                    echo '<div class="videoItem">
                                        <img src="https://pbs.twimg.com/profile_images/949787136030539782/LnRrYf6e.jpg">
                                        <h3>Titulo de video 1</h3>
                                        <h4>By alexby</h4>
                                        <h4>35562 rep</h4>
                                    </div>';
                }
            }
            ?>
        </div>
    </div>
</section>

<?php
include "includes/loginInclude.php";
?>
</body>
</html>
