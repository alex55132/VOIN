<?php

require_once "../Classes/BaseDeDatos.php";
require_once "../utils/utils.php";

session_start();
/*
 * Status Codes:
 * 0: Error
 * 1: Ok
 * 2: Already exists
 * 3: Cant suscribe to yourself
 */
$response = array();

//Comprobamos los datos
if (isDataAvailable($_SESSION)) {
    if (isDataAvailable($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];

        if (isDataAvailable($_POST)) {
            $db = new BaseDeDatos();

            $suscribedTo = addslashes($_POST['suscribedTo']);

            if($userId == $suscribedTo) {
                $response['statusCode'] = 3;
            } else {
                //Comprobamos si la relacion ya existe
                $arrayRelaciones = $db->realizarConsulta("SELECT id_rel FROM relacion WHERE id_seguido=".$suscribedTo." AND id_seguidor=".$userId);

                //Ya existe la relacion, impedimos que se cree otra y eliminamos la ya creada
                if(sizeof($arrayRelaciones) > 0) {
                    $resultado = $db->iudQuery("DELETE FROM relacion WHERE id_seguido=".$suscribedTo." AND id_seguidor=".$userId);
                    if(!$resultado) {
                        $response['statusCode'] = 0;
                    } else {
                        $response['statusCode'] = 2;
                    }

                } else {
                    //Preparamos la sentencia
                    if($sentencia = $db->getConexion()->prepare("INSERT INTO relacion (id_seguido, id_seguidor) VALUES (?,?)")) {
                        if(!$sentencia->bind_param("ii", intval($suscribedTo), intval($userId))) {
                            $response['statusCode'] = 0;
                        }
                        if(!$sentencia->execute()) {
                            $response['statusCode'] = 0;
                        } else {
                            $response['statusCode'] = 1;
                        }

                    } else {
                        $response['statusCode'] = 0;
                    }
                }
            }
        }
    }
}

echo json_encode($response);