<?php
require_once "../utils/utils.php";
require_once "../Classes/BaseDeDatos.php";
require_once "../Classes/Video.php";

$response = array();

if (isDataAvailable($_POST)) {
    if(isDataAvailable($_POST['videoId']) && is_numeric($_POST['videoId'])) {
        $videoId = $_POST['videoId'];

        $video = Video::getVideoById($videoId);

        if($video->getRepStatus() != 1) {
            $db = new BaseDeDatos();

            $query = "UPDATE video SET visu_video = visu_video + 1 WHERE id_video = ".$videoId;

            $arr = [];

            if($db->iudQuery($query)) {
                //StatusCode 1 es Ok
                $response = array('statusCode' => 1, 'errors' => []);
            } else {
                //StatusCode 0 es Fallo
                $response = array('statusCode' => 0, 'errors' => ['An error happened while performing the query']);
            }
        } else {
            $response = array('statusCode' => 0, 'errors' => ['El video está eliminado por reporte']);
        }

    } else {
        $response = array('statusCode' => 0, 'errors' => ['An error happened']);
    }
} else {
    $response = array('statusCode' => 0, 'errors' => ['An error happened']);
}

echo json_encode($response);