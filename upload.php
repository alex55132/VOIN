<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VOIN - Subir un vídeo</title>
    <link rel="stylesheet" href="css/navStyle.css">
    <link rel="stylesheet" href="css/uploadStyle.css">
    <link rel="stylesheet" href="css/notificationsStyle.css">
    <script src="js/mainScript.js"></script>
    <script src="js/uploadScript.js"></script>
    <script src="js/resumable.js"></script>
</head>
<body>
<?php
    session_start();
    $userId = $_SESSION['userId'];
    include "includes/navbarInclude.php";
    include_once "Classes/BaseDeDatos.php";

    $db = new BaseDeDatos();

    $categorias = $db->realizarConsulta("SELECT * FROM categoria");

    $db->cerrarConexion();
?>

<div class="notificationContainer" id="notificationContainer">
    <img src="imgs/CrossIcon.svg" id="closeNotification">
    <div class="notificationContentContainer" id="notificationContent">
        <p>Mensaje de notificacion</p>
    </div>
</div>

<section class="mainContainer">
    <div class="uploadTitle">
        <h2>SUBIR UN VÍDEO</h2>
        <hr>
    </div>

    <div class="uploadContainer">
        <form enctype="multipart/form-data">
            <div class="controlContainer">
                <div class="fileContainer">
                    <div class="fileUploadContainer">
                        <img src="imgs/UploadFileIcon.svg" style="height: 150px; width: 150px;">
                        <p id="videoUploadMessage">Subir vídeo</p>
                    </div>
                    <input name="videoData" id="fileInput" type="file" class="inputFile">
                </div>
                <div class="dataContainer">
                    <input type="text" id="tituloVideo" class="inputForm inputSingleLined" placeholder="Titulo del vídeo" name="tituloVideo">
                    <textarea class="inputForm" id="descripcionVideo" rows="6" placeholder="Descripcion"></textarea>
                    <select id="etiquetasVideo" class="inputForm inputSingleLined selectItem">
                        <option disabled selected value="-1" class="firstOption">Etiquetas</option>
                        <?php
                        for($i = 0; $i < sizeof($categorias); $i++) {
                            echo '<option value="'.$categorias[$i][0].'">'.$categorias[$i][1].'</option>';
                        }
                        ?>
                    </select>

                    <div class="miniaturaFileUploadContainer">
                        <button type="button" id="miniaturaButton" class="videoUploadBtn">Subir miniatura</button>
                        <input type="file" id="miniaturaInput" class="inputForm" accept="image/png, image/jpg">
                    </div>
                    <div class="miniaturaPreview">
                        <img id="miniaturaPreview" src="">
                    </div>
                    <button type="button" class="videoUploadBtn" id="videoUploadButton">Aceptar</button>
                    <div class="clearDiv"></div>
                </div>
            </div>
        </form>
        <div class="progressBarContainer">
            <div class="progressBar">
                <div id="loadBackground" class="loadBackground"></div>
                <p>Subiendo... <span id="uploadPercentage">0</span>%</p>
            </div>
        </div>
    </div>
</section>
<?php
include "includes/loginInclude.php";
?>
</body>
</html>
