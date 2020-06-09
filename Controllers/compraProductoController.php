<?php
require_once "../utils/utils.php";
require_once "../Classes/BaseDeDatos.php";
require_once "../Classes/Usuario.php";

session_start();

/*
 * Status codes:
 * 0: Error
 * 1: Ok
 */
$response = array();

if(isDataAvailable($_SESSION) && isDataAvailable($_POST)) {
    if(isDataAvailable($_SESSION['userId']) && isDataAvailable($_POST['productoId']) && is_numeric($_POST['productoId'])
    && isDataAvailable($_POST['precio']) && is_numeric($_POST['precio'])) {
        $userId = $_SESSION['userId'];
        $productoId = addslashes($_POST['productoId']);
        $precio = addslashes($_POST['precio']);

        $usuario = Usuario::getUsuarioById($userId);
        if($usuario->getDineroCartera() < $precio) {
            $response['statusCode'] = 0;
            $response['message'] = "No tienes suficiente monedas para comprar este producto!";
        } else {
            $db = new BaseDeDatos();
            $sentencia = "";

            //Restamos el dinero de la cartera del usuario
            if($db->iudQuery("UPDATE cartera INNER JOIN usuarios ON usuarios.id_car = cartera.id_car SET cant_car=cant_car-".$precio." WHERE usuarios.id_usu = ".$userId)) {
                //El dinero ha sido restado
                $reembolso = false;
                //Insercion de los datos
                if(!$sentencia = $db->getConexion()->prepare("INSERT INTO compra(id_pro, id_usu, fech_com) VALUES (?,?,".date('Y-m-d').")")) {
                    $response['statusCode'] = 0;
                    $response['message'] = "Ha ocurrido un error durante la compra, vuelvalo a intentar más tarde.";
                    $reembolso = true;
                } else {
                    if(!$sentencia->bind_param("ii", $productoId, $userId)) {
                        $response['statusCode'] = 0;
                        $response['message'] = "Ha ocurrido un error durante la compra, vuelvalo a intentar más tarde.";
                        $reembolso = true;
                    } else {
                        if(!$sentencia->execute()) {
                            $response['statusCode'] = 0;
                            $response['message'] = "Ha ocurrido un error durante la compra, vuelvalo a intentar más tarde.";
                            $reembolso = true;
                        } else {
                            $response['statusCode'] = 1;
                            $response['message'] = "Compra realizada correctamente";
                        }
                    }
                }

                if($reembolso) {
                    //Devolvemos el dinero
                    $db->iudQuery("UPDATE cartera INNER JOIN usuarios ON usuarios.id_car = cartera.id_car SET cant_car=cant_car+".$precio." WHERE usuarios.id_usu = ".$userId);
                }
            }


            $db->cerrarConexion();
        }

    } else {
        $response['statusCode'] = 0;
        $response['message'] = "Debes tener la sesion iniciada! ¿Has enviado los datos?";
    }
} else {
    $response['statusCode'] = 0;
    $response['message'] = "Debes tener la sesion iniciada! ¿Has enviado los datos?";
}

echo json_encode($response);