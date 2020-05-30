<?php
require_once "../utils/utils.php";
require_once "../Classes/BaseDeDatos.php";

if (isDataAvailable($_POST)) {
    if(isDataAvailable($_POST['videoId']) && is_numeric($_POST['videoId'])) {
        $videoId = $_POST['videoId'];
        $db = new BaseDeDatos();

        $query = "UPDATE video SET visu_video = visu_video + 1 WHERE id_video = ".$videoId;

        $arr = [];

        if($db->iudQuery($query)) {
            //StatusCode 1 es Ok
            $arr = array('statusCode' => 1, 'errors' => []);
        } else {
            //StatusCode 0 es Fallo
            $arr = array('statusCode' => 0, 'errors' => ['An error happened while performing the query']);
        }

        echo json_encode($arr);
    }
}