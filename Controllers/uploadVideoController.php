<?php
include_once "../utils/utils.php";
include_once "../Classes/BaseDeDatos.php";

session_start();

if(isDataAvailable($_SESSION) && isDataAvailable($_POST) && isDataAvailable($_FILES)) {
    $tituloVideo = "";
    $descripcionVideo = "";
    $etiquetasVideo = "";
    $miniaturaVideo = $_FILES['miniaturaVideo'];
    $rutaVideo = "";
    foreach ($_POST as $clave => $valor){
        $$clave = $valor;
    }

    //TODO: PERMITIR MINIATURAS VARIABLES
    _log($_POST['tituloVideo']."\n", "../logVideoUpload.txt");
    _log($_POST['descripcionVideo']."\n", "../logVideoUpload.txt");
    _log($_POST['etiquetasVideo']."\n", "../logVideoUpload.txt");
    _log($_POST['rutaVideo']."\n", "../logVideoUpload.txt");
    _log($miniaturaVideo['name']."\n", "../logVideoUpload.txt");


    $userId = $_SESSION['userId'];
    $fechaPubli = date('Y-m-d');
    $rutaVideo = str_replace(" ", "_", $rutaVideo);

    //Nombres de miniaturas aleatorios yay
    $permittedChars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

    $newMiniaturaName = substr(str_shuffle($permittedChars), 0, 16).".png";
    _log("Nombre archivo hasheado: ".$newMiniaturaName."\n", "../logVideoUpload.txt");

    if(move_uploaded_file($miniaturaVideo['tmp_name'], "../imgs/miniaturas/".$newMiniaturaName)) {

        $db = new BaseDeDatos();

        $sentencia = $db->getConexion()->prepare("INSERT INTO video (id_usu, id_cat, tit_video, visu_video, fecha_video, ruta_video, descr_video, minia_video)
        VALUES (?,?,?, 0,?,?,?,?)");

        if($sentencia) {
            //La preparacion es correcta, insertamos datos
            if($sentencia->bind_param("iisssss", $userId, intval($etiquetasVideo), $tituloVideo, $fechaPubli, $rutaVideo, $descripcionVideo, $newMiniaturaName)) {
                if (!$sentencia->execute()) {
                    echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
                    header( "HTTP/1.0 404 Not Found");
                } else {
                    echo $newMiniaturaName;
                    header("HTTP/1.0 200 Ok");
                }
            } else {
                echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
                header("HTTP/1.0 404 Not Found");
            }
        } else {
            echo "Falló la preparación: (" . $db->getConexion()->errno . ") " . $db->getConexion()->error;
            header("HTTP/1.0 404 Not Found");
        }

        $db->cerrarConexion();
    } else {
        echo "No se pudo mover la imagen";
        header("HTTP/1.0 404 Not Found");
    }
    //header("HTTP/1.0 200 Ok");
} else {
    header("HTTP/1.0 403 Forbidden");
}