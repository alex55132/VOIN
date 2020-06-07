<?php
require_once "../utils/utils.php";

/*
 * Status codes
 * 0: Error
 * 1: Ok
 */
$response = array();

session_start();

if(isDataAvailable($_SESSION) && isDataAvailable($_POST)) {
    if(isDataAvailable($_SESSION['userId']) && isDataAvailable($_POST['typeRequest']) && isDataAvailable($_POST['videoId'])) {
        //Typerequest es 1 para aceptar, 2 para rechazar
        $typeRequest = addslashes($_POST['typeRequest']);
        $videoId = addslashes($_POST['videoId']);

        if(is_numeric($typeRequest) && is_numeric($videoId)) {
            require_once "../Classes/BaseDeDatos.php";

            if($typeRequest == 1) {
                //Accion de aceptar
                $db = new BaseDeDatos();
                if($db->iudQuery("UPDATE reporte SET stat_rep=2 WHERE id_video =".$videoId)) {
                    $response['statusCode'] = 1;
                    $response['message'] = 'Video aceptado';
                } else {
                    $response['statusCode'] = 0;
                    $response['message'] = 'Error al aceptar el video';
                }
                $db->cerrarConexion();
            } else if($typeRequest == 2) {
                //Accion de rechazar
                $db = new BaseDeDatos();
                if($db->iudQuery("UPDATE reporte SET stat_rep=1 WHERE id_video =".$videoId)) {
                    $response['statusCode'] = 1;
                    $response['message'] = 'Video rechazado';
                } else {
                    $response['statusCode'] = 0;
                    $response['message'] = 'Error al rechazar el video';
                }
                $db->cerrarConexion();
            } else {
                //Parametro inválido
                $response['statusCode'] = 0;
                $response['message'] = 'Parametros erroneos';
            }
        } else {
            $response['statusCode'] = 0;
            $response['message'] = 'Parametros erroneos';
        }
    } else {
        $response['statusCode'] = 0;
        $response['message'] = 'Ha ocurrido un error al procesar tu peticion';
    }
} else {
    $response['statusCode'] = 0;
    $response['message'] = 'Ha ocurrido un error al procesar tu peticion 1';
}

echo json_encode($response);