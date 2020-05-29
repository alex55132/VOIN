<?php

require_once "BaseDeDatos.php";
require_once "Video.php";

class Listador
{
    public static function listarVideos($start = 0, $numberRows = 9, $channelId = 0)
    {

        //Inicializamos variables
        $db = new BaseDeDatos();

        $arrayResult = [];
        $query = "";

        if ($channelId == 0) {
            $query = "SELECT id_video FROM video ORDER BY id_video DESC LIMIT " . $start . "," . $numberRows;
        } else {
            $query = "SELECT id_video FROM video WHERE id_usu=".$channelId." ORDER BY id_video DESC LIMIT " . $start . "," . $numberRows;
        }

        //Obtenemos 9 por lo general empezando desde 0
        $arrayDatos = $db->realizarConsulta($query);

        $idVideo = 0;
        $video = "";

        for ($i = 0; $i < sizeof($arrayDatos); $i++) {
            $video = Video::getVideoById($arrayDatos[$i][0]);
            array_push($arrayResult, $video);
        }

        return $arrayResult;
    }
}