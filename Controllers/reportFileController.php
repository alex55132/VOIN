<?php
require_once "../utils/utils.php";

session_start();

/*
 *
 * Petition codes
 * 0: Error
 * 1: Ok
 * 2: Already reported this video
 * 3: Cant report your own video
 */

$response = array();

if (isDataAvailable($_SESSION)) {
    if (isDataAvailable($_SESSION['userId']) && isDataAvailable($_POST['reportedVideo'])) {
        //Incluimos la base de datos
        require_once "../Classes/BaseDeDatos.php";
        require_once "../Classes/Video.php";

        $db = new BaseDeDatos();
        $reportedVideoId = addslashes($_POST['reportedVideo']);
        $userId = $_SESSION['userId'];

        //Comprobamos si el video reportado es propio
        $video = Video::getVideoById($reportedVideoId);

        if($video->getIdUsuario() == $userId){
            $response['statusCode'] = 3;
            $response['message'] = "No puedes reportar tu propio video";
        } else {
            //Antes de insertar el reporte, comprobamos si este usuario ya ha reportado este video
            $arrayReportes = $db->realizarConsulta("SELECT id_rep FROM reporte WHERE id_usu=".$userId." AND id_video=".$reportedVideoId);

            if(sizeof($arrayReportes) > 0) {
                $response['statusCode'] = 2;
                $response['message'] = "Ya has reportado este video";
            } else {
                //Preparamos la sentencia y enviamos los datos
                if(!($sentencia = $db->getConexion()->prepare("INSERT INTO reporte(id_video, stat_rep, id_usu) VALUES (?,0,?)"))) {
                    $response['statusCode'] = 0;
                    $response['message'] = "Error al insertar los datos";
                } else {
                    if(!$sentencia->bind_param("ii", $reportedVideoId, $userId)) {
                        $response['statusCode'] = 0;
                        $response['message'] = "Error al insertar los datos";
                    } else {
                        if(!$sentencia->execute()) {
                            $response['statusCode'] = 0;
                            $response['message'] = "Error al insertar los datos";
                        } else {
                            $response['statusCode'] = 1;
                            $response['message'] = "Reporte realizado correctamente";
                        }
                    }
                }
            }
        }

    } else {
        $response['statusCode'] = 0;
        $response['message'] = "Error performing the operation";
    }
} else {
    $response['statusCode'] = 0;
    $response['message'] = "Debes estar logeado para poder reportar vídeos";
}

echo json_encode($response);
