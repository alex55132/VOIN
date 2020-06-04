<?php
require_once "../utils/utils.php";
require_once "../Classes/BaseDeDatos.php";
require_once "../Classes/Video.php";

//Codigos de estado de la peticion
/*
 * 0: Error, user cannot like its own video
 * 1: All Ok
 * 2: Cant valorate again
 * 3: Bad Format
 * 4: Error updating money
 */
$response = array();
session_start();

//Comprobamos los datos
if (isDataAvailable($_SESSION)) {
    if (isDataAvailable($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];

        if (isDataAvailable($_POST)) {
            $videoId = $_POST['videoId'];
            $val = $_POST['valoracion'];

            if ($val == 1 || $val == -1) {
                $db = new BaseDeDatos();
                $video = Video::getVideoById($videoId);

                //Comprobamos que el usuario que da la valoracion no es el mismo que el que subio el video
                if($video->getIdUsuario() == $userId) {
                    $response['statusCode'] = 0;
                    $response['message'] = "No puedes valorar tu propio video";
                } else {
                    $arrayDatos = $db->realizarConsulta("SELECT id_lidis FROM valoracion WHERE id_usu=" . $userId . " AND id_video=" . $videoId);

                    //Comprobamos si el usuario ya ha valorado el video
                    if (sizeof($arrayDatos) > 0) {
                        //Ya lo ha valorado, por lo que devolvemos error
                        $response['statusCode'] = 2;
                        $response['message'] = "Se encontró un registro de valoracion";
                    } else {
                        //Introducimos la valoracion

                        //Peparamos la sentencia
                        if ($sentencia = $db->getConexion()->prepare("INSERT INTO valoracion (id_video, id_usu, tipo_id_lidis) VALUES (?,?,?)")) {

                            if (!$sentencia->bind_param("iii", intval($videoId), intval($userId), intval($val))) {
                                echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
                                $response['statusCode'] = 3;
                                $response['message'] = "Formato incorrecto";
                            } else {
                                //Ejecutamos
                                if (!$sentencia->execute()) {
                                    echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
                                    $response['statusCode'] = 3;
                                    $response['message'] = "Formato incorrecto";
                                } else {
                                    if($val == 1) {
                                        //Actualizamos la cartera de ambos
                                        $carteraVideoActualizada = $db->iudQuery("UPDATE cartera INNER JOIN usuarios ON usuarios.id_car = cartera.id_car SET cartera.cant_car = cartera.cant_car + 50 WHERE usuarios.id_usu = ".$video->getIdUsuario());
                                        $carteraUsuarioActualizada = $db->iudQuery("UPDATE cartera INNER JOIN usuarios ON usuarios.id_car = cartera.id_car SET cartera.cant_car = cartera.cant_car + 5 WHERE usuarios.id_usu = ".$userId);

                                        if($carteraUsuarioActualizada && $carteraVideoActualizada) {
                                            $response['statusCode'] = 1;
                                            $response['message'] = "Valoracion insertada correctamente";
                                        } else {
                                            $response['statusCode'] = 4;
                                            $response['message'] = "Error al actualizar la cartera";
                                        }
                                    } else {
                                        //Actualizamos solo la cartera del usuario
                                        $carteraUsuarioActualizada = $db->iudQuery("UPDATE cartera INNER JOIN usuarios ON usuarios.id_car = cartera.id_car SET cartera.cant_car = cartera.cant_car + 5 WHERE usuarios.id_usu = ".$userId);

                                        if($carteraUsuarioActualizada) {
                                            $response['statusCode'] = 1;
                                            $response['message'] = "Valoracion insertada correctamente";
                                        } else {
                                            $response['statusCode'] = 4;
                                            $response['message'] = "Error al actualizar la cartera";
                                        }
                                    }
                                }
                            }
                        } else {
                            echo "Falló la preparación: (" . $db->getConexion()->errno . ") " . $db->getConexion()->error;
                            $response['statusCode'] = 3;
                            $response['message'] = "Formato incorrecto";
                        }
                    }
                }
                $db->cerrarConexion();
            } else {
                $response['statusCode'] = 3;
                $response['message'] = "Formato incorrecto";
            }

        } else {
            $response['statusCode'] = 3;
            $response['message'] = "Formato incorrecto";
        }
    } else {
        $response['statusCode'] = 3;
        $response['message'] = "Formato incorrecto";
    }
} else {
    $response['statusCode'] = 3;
    $response['message'] = "Formato incorrecto";
}

echo json_encode($response);