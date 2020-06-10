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

if (isDataAvailable($_SESSION) && isDataAvailable($_POST)) {
    if (isDataAvailable($_SESSION['userId']) && isDataAvailable($_POST['productoId']) && is_numeric($_POST['productoId'])
        && isDataAvailable($_POST['precio']) && is_numeric($_POST['precio']) && isDataAvailable($_POST['stock']) && is_numeric($_POST['stock'])) {
        $db = new BaseDeDatos();

        $userId = $_SESSION['userId'];
        $productoId = addslashes($_POST['productoId']);
        $precio = addslashes($_POST['precio']);
        $stock = addslashes($_POST['stock']);

        $arrayDatos = $db->realizarConsulta("SELECT stock_pro FROM producto WHERE id_pro=" . $productoId);

        if (sizeof($arrayDatos) > 0) {

            //Comprobamos si hay stock
            if($arrayDatos[0][0] > 0) {
                //Hay stock
                $usuario = Usuario::getUsuarioById($userId);
                if ($usuario->getDineroCartera() < $precio) {
                    $response['statusCode'] = 0;
                    $response['message'] = "No tienes suficiente monedas para comprar este producto!";
                } else {

                    $sentencia = "";

                    //Restamos el dinero de la cartera del usuario
                    if ($db->iudQuery("UPDATE cartera INNER JOIN usuarios ON usuarios.id_car = cartera.id_car SET cant_car=cant_car-" . $precio . " WHERE usuarios.id_usu = " . $userId)) {
                        //El dinero ha sido restado
                        $reembolso = false;
                        //Insercion de los datos
                        if (!$sentencia = $db->getConexion()->prepare("INSERT INTO compra(id_pro, id_usu, fech_com) VALUES (?,?," . date('Y-m-d') . ")")) {
                            $response['statusCode'] = 0;
                            $response['message'] = "Ha ocurrido un error durante la compra, vuelvalo a intentar más tarde.";
                            $reembolso = true;
                        } else {
                            if (!$sentencia->bind_param("ii", $productoId, $userId)) {
                                $response['statusCode'] = 0;
                                $response['message'] = "Ha ocurrido un error durante la compra, vuelvalo a intentar más tarde.";
                                $reembolso = true;
                            } else {
                                if (!$sentencia->execute()) {
                                    $response['statusCode'] = 0;
                                    $response['message'] = "Ha ocurrido un error durante la compra, vuelvalo a intentar más tarde.";
                                    $reembolso = true;
                                } else {
                                    if ($db->iudQuery("UPDATE producto SET stock_pro=stock_pro-1 WHERE id_pro=" . $productoId)) {
                                        $response['statusCode'] = 1;
                                        $response['message'] = "Compra realizada correctamente";
                                    } else {
                                        $response['statusCode'] = 0;
                                        $response['message'] = "Fallo la operacion de eliminar el producto de stock";
                                    }
                                }
                            }
                        }

                        if ($reembolso) {
                            //Devolvemos el dinero
                            $db->iudQuery("UPDATE cartera INNER JOIN usuarios ON usuarios.id_car = cartera.id_car SET cant_car=cant_car+" . $precio . " WHERE usuarios.id_usu = " . $userId);
                        }
                    }

                    $db->cerrarConexion();
                }
            } else {
                $response['statusCode'] = 0;
                $response['message'] = "No quedan productos en stock!";
            }
        } else {
            $response['statusCode'] = 0;
            $response['message'] = "No se ha encontrado ningun producto con esa Id";
        }

    } else {
        $response['statusCode'] = 0;
        $response['message'] = "Ha ocurrido un problema con la operacion. ¿Hay stock?";
    }
} else {
    $response['statusCode'] = 0;
    $response['message'] = "Ha ocurrido un problema con la operacion. ¿Hay stock?";
}

echo json_encode($response);