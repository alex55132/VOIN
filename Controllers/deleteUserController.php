<?php
require_once "../utils/utils.php";

session_start();

/*
 * Response codes
 * 0: Ok
 * 1: Error
 */
$response = array();

if(isDataAvailable($_SESSION)) {
    if(isDataAvailable($_SESSION['userId'])) {
        require_once "../Classes/Usuario.php";

        //Comprobamos que el usuario tiene permiso para realizar esta operacion
        $usuario = Usuario::getUsuarioById($_SESSION['userId']);

        if($usuario->getTipo() == 2) {
            if(isDataAvailable($_POST)) {
                $channelToDeleteId = addslashes($_POST['channelToDeleteId']);

                if(is_numeric($channelToDeleteId)) {
                    require_once "../Classes/BaseDeDatos.php";

                    $db = new BaseDeDatos();


                    if($db->iudQuery("UPDATE usuarios SET id_tipo=3 WHERE id_usu=".intval($channelToDeleteId))) {
                        $response['statusCode'] = 0;
                        $response['message'] = "Usuario eliminado";
                    } else {
                        $response['statusCode'] = 1;
                        $response['message'] = "Error al ejecutar la query";
                    }

                    $db->cerrarConexion();
                } else {
                    $response['statusCode'] = 1;
                    $response['message'] = "Parametros erróneos";
                }
            } else {
                $response['statusCode'] = 1;
                $response['message'] = "Faltan parámetros!";
            }
        } else {
            $response['statusCode'] = 1;
            $response['message'] = "El usuario no tiene permisos";
        }
    } else {
        $response['statusCode'] = 1;
        $response['message'] = "No hay sesion iniciada";
    }
} else {
    $response['statusCode'] = 1;
    $response['message'] = "No hay sesion iniciada";
}

echo json_encode($response);