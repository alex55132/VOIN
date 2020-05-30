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
</head>
<body>
<?php
require_once "../includes/navbarPanelControl.php";
?>
    <section class="mainContainer">
        <div class="controlPanelTabsContainer">
            <div class="itemVideos selected">
                <h1>VIDEOS</h1>
            </div>
            <div class="itemVideos">
                <h1>VIDEOS</h1>
            </div>
            <div class="itemVideos">
                <h1>VIDEOS</h1>
            </div>
            <div class="itemVideos">
                <h1>VIDEOS</h1>
            </div>
        </div>

        <div class="displayVideoContainer">
            <div class="displayerHeader">
                <h3>Video</h3>
                <h3>Titulo</h3>
                <h3>Fecha</h3>
                <h3>Visualizaciones</h3>
                <h3>Categoría</h3>
                <h3>Acciones</h3>
            </div>
            <div class="displayerBody">
                <?php
                    for($i = 0; $i < 5; $i++) {
                        echo '<div class="itemRow">
                                <img src="https://lh3.googleusercontent.com/K3UdS0t311DpKIiq614Ix6cRanFYxueEFaLF3T0bPQLGcJtqzw5ps3ClI85nK7jB4ElbKBs8xg=w640-h400-e365">
                                <p>Titulo del video</p>
                                <p>01-Jun-2020</p>
                                <p>123</p>
                                <p>Categoría 1</p>
                                <p class="actionIcon"><img src="../imgs/EditIcon.svg" class="icon"></p>
                                <p class="actionIcon"><img src="../imgs/DeleteIcon.svg" class="icon"</p>
                              </div>';
                    }
                ?>
            </div>
        </div>
    </section>
</body>
</html>