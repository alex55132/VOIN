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
    <script src="js/mainScript.js"></script>
    <script src="js/uploadScript.js"></script>
</head>
<body>
<?php
    include "includes/navbarInclude.php";
?>

<section class="mainContainer">
    <div class="uploadTitle">
        <h2>SUBIR UN VÍDEO</h2>
        <hr>
    </div>

    <div class="uploadContainer">
        <form>
            <div class="controlContainer">
                <div class="fileContainer">
                    <div class="fileUploadContainer">
                        <img src="https://cdn.icon-icons.com/icons2/1129/PNG/512/fileinterfacesymboloftextpapersheet_79740.png" style="height: 150px; width: 150px;">
                        <p>Subir vídeo</p>
                    </div>
                </div>
                <div class="dataContainer">
                    <input type="text" id="tituloVideo" class="inputForm inputSingleLined" placeholder="Titulo del vídeo" name="tituloVideo">
                    <textarea class="inputForm" id="descripcionVideo" rows="6" placeholder="Descripcion"></textarea>
                    <input type="text" id="etiquetasVideo" class="inputForm inputSingleLined" placeholder="Etiquetas">

                    <div class="miniaturaFileUploadContainer">
                        <button type="button" id="miniaturaButton" class="videoUploadBtn">Subir miniatura</button>
                        <input type="file" id="miniaturaInput" class="inputForm" accept="image/png, image/jpg">
                    </div>
                    <button type="button" class="videoUploadBtn" id="videoUploadButton">Aceptar</button>
                    <div class="clearDiv"></div>
                </div>
            </div>
        </form>
        <div class="progressBarContainer">
            <div class="progressBar">
                <div class="loadBackground"></div>
                <p>Subiendo... <span id="uploadPercentage">65</span>%</p>
            </div>
        </div>
    </div>
</section>

</body>
</html>
