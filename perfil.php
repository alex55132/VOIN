<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VOIN - Perfil</title>
    <link rel="stylesheet" href="css/navTienda.css">
    <link rel="stylesheet" href="css/perfilStyle.css">
    <script src="js/perfilScript.js"></script>
</head>
<body>
<?php
//Esta variable se define en navPerfil.php
$usuario = "";

include "includes/navPerfil.php";
?>

<div class="background"></div>

<section class="mainPerfilContainer">
    <form id="uploadDataForm" enctype="multipart/form-data">
        <?php
        echo '<div class="perfilRow">
            <h3>Nombre</h3>
            <div class="perfilEditZone">
            <p id="nombreZone">'.$usuario->getNombre().'</p>
            </div>
            <a id="editNombreBtn">Editar</a>
        </div>
        <div class="perfilRow">
            <h3>Fecha de nacimiento</h3>
            <div class="perfilEditZone">
            <p id="fechaZone">'.$usuario->getFechaNacimiento().'</p>
            </div>
            <a id="editNacimientoBtn">Editar</a>
        </div>
        <div class="perfilRow">
            <h3>Correo</h3>
            <div class="perfilEditZone">
            <p id="correoZone">'.$usuario->getCorreo().'</p>
            </div>
            
            <a id="editCorreoBtn">Editar</a>
        </div>
        <div class="perfilRow">
            <h3>Contraseña</h3>
            <div class="perfilEditZone">
            <p>*************</p>
            </div>
            
            <a id="editContrasenaBtn">Editar</a>
        </div>
        <div class="perfilRow">
            <h3>Foto</h3>
            <div class="imgPerfilContainer perfilEditZone">
                <div class="fotoContainer">
                    <img src="'.$usuario->getImg().'">
                </div>
            </div>
            <a id="editFotoBtn">Editar</a>
        </div>
        <div class="perfilRow" id="acceptBtnContainer">
            <div class="relleno"></div>
            <input id="acceptBtn" type="button" value="Actualizar" class="updateDataBtn">
        </div>
        ';
        ?>
    </form>
</section>
</body>
</html>