<?php

include "../utils/VideoStream.php";
include_once "../Classes/BaseDeDatos.php";
include_once "../utils/utils.php";

$db = new BaseDeDatos();
if(isDataAvailable($_GET)) {
    $videoId = intval($_GET['videoId']);
    $arrayData = $db->realizarConsulta("SELECT ruta_video FROM video WHERE id_video=".$videoId);
    $ruta = $arrayData[0][0];

    _log("Encontramos el archivo del video con id ".$videoId." en la ruta " . $ruta . "\n", "../logVideoWatch.txt");

    $path = "../videos/".$ruta;
    $stream = new VideoStream($path);
    $stream->start();

    $db->cerrarConexion();

    header("HTTP/1.0 200 Ok");
    exit;
} else {
    header("HTTP/1.0 404 Not Found");
    exit;
}