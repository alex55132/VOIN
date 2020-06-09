<?php
require_once "../utils/utils.php";

session_start();

/*
 * Status code:
 * 0: Error
 * 1: Ok
 * 2: Completo con errores
 * 3: Ok sin imagen
 */
$response = array();
if (isDataAvailable($_SESSION) && (isDataAvailable($_POST) || isDataAvailable($_FILES))) {

    if (isDataAvailable($_SESSION['userId']) && (isDataAvailable($_POST) || isDataAvailable($_FILES))) {


        $nombreUser = "";
        $fechaNacimientoUser = "";
        $correoUser = "";
        $passUser = "";
        if (isDataAvailable($_FILES)) {
            $imagen = $_FILES['newFoto'];
        } else {
            $imagen = null;
        }


        foreach ($_POST as $clave => $valor) {
            $$clave = $valor;
        }

        $permittedChars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

        $newMiniaturaName = substr(str_shuffle($permittedChars), 0, 16) . ".png";

        $query = "UPDATE usuarios SET ";

        $errorWhileWorking = false;
        $imagenSubida = false;

        if (!is_null($imagen) && ($nombreUser != "" || $fechaNacimientoUser != "" || $correoUser != "" || $passUser != "")) {
            var_dump($imagen);
            /*
             * Comprobamos los diferentes datos aportados por el usuario, generamos la query
             */

            if ($nombreUser != "" && $fechaNacimientoUser == "" && $correoUser == "" && $passUser == "") {
                $query .= "nom_usu='" . addslashes($nombreUser). "'";
            } else if ($nombreUser != "" && ($fechaNacimientoUser != "" || $correoUser != "" || $passUser != "")) {
                $query .= "nom_usu='" . addslashes($nombreUser) . "',";
            }

            if ($nombreUser == "" && $fechaNacimientoUser != "" && $correoUser == "" && $passUser == "") {
                $query .= "fecNac_usu='" . addslashes($fechaNacimientoUser)."'";
            } else if ($fechaNacimientoUser != "" && ($nombreUser != "" || $correoUser != "" || $passUser != "")) {
                $query .= "fecNac_usu='" . addslashes($fechaNacimientoUser) . "',";
            }

            if ($nombreUser == "" && $fechaNacimientoUser == "" && $correoUser != "" && $passUser == "") {
                if (preg_match('/^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i', addslashes($correoUser))) {
                    $query .= "corr_usu='" . addslashes($correoUser)."'";
                } else {
                    $errorWhileWorking = true;
                }
            } else if ($correoUser != "" && ($fechaNacimientoUser != "" || $nombreUser != "" || $passUser != "")) {
                if (preg_match('/^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i', addslashes($correoUser))) {
                    $query .= "corr_usu='" . addslashes($correoUser) . "',";
                } else {
                    $errorWhileWorking = true;
                }
            }

            if ($nombreUser == "" && $fechaNacimientoUser == "" && $correoUser == "" && $passUser != "") {
                if (preg_match('/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/', addslashes($passUser))) {
                    $query .= "contr_usu='" . addslashes(md5($passUser)) . "',";
                }
            } else if ($passUser != "" && ($fechaNacimientoUser != "" || $nombreUser != "" || $nombreUser != "")) {
                if (preg_match('/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/', addslashes($passUser))) {
                    $query .= "contr_usu='" . addslashes(md5($passUser))."'";
                }
            }

            //Subimos la imagen

            if ($imagen['size'] < 10000000 && strpos($imagen["type"], "png") && move_uploaded_file($imagen['tmp_name'], "../imgs/userImages/" . $newMiniaturaName)) {
                $imagenSubida = true;
                $query .= "img_usu='".$newMiniaturaName."'";
            }

            $query .= " WHERE id_usu=" . $_SESSION['userId'];

        } else if (is_null($imagen) && ($nombreUser != "" || $fechaNacimientoUser != "" || $correoUser != "" || $passUser != "")) {
            /*
             * Comprobamos los diferentes datos aportados por el usuario, generamos la query
             */

            if ($nombreUser != "" && $fechaNacimientoUser == "" && $correoUser == "" && $passUser == "") {
                $query .= "nom_usu='" . addslashes($nombreUser). "'";
            } else if ($nombreUser != "" && ($fechaNacimientoUser != "" || $correoUser != "" || $passUser != "")) {
                $query .= "nom_usu='" . addslashes($nombreUser) . "',";
            }

            if ($nombreUser == "" && $fechaNacimientoUser != "" && $correoUser == "" && $passUser == "") {
                $query .= "fecNac_usu='" . addslashes($fechaNacimientoUser)."'";
            } else if ($fechaNacimientoUser != "" && ($nombreUser != "" || $correoUser != "" || $passUser != "")) {
                $query .= "fecNac_usu='" . addslashes($fechaNacimientoUser) . "',";
            }

            if ($nombreUser == "" && $fechaNacimientoUser == "" && $correoUser != "" && $passUser == "") {
                if (preg_match('/^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i', addslashes($correoUser))) {
                    $query .= "corr_usu='" . addslashes($correoUser)."'";
                } else {
                    $errorWhileWorking = true;
                }
            } else if ($correoUser != "" && ($fechaNacimientoUser != "" || $nombreUser != "" || $passUser != "")) {
                if (preg_match('/^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i', addslashes($correoUser))) {
                    $query .= "corr_usu='" . addslashes($correoUser) . "',";
                } else {
                    $errorWhileWorking = true;
                }
            }

            if ($nombreUser == "" && $fechaNacimientoUser == "" && $correoUser == "" && $passUser != "") {
                if (preg_match('/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/', addslashes($passUser))) {
                    $query .= "contr_usu='" . addslashes(md5($passUser)) . "',";
                }
            } else if ($passUser != "" && ($fechaNacimientoUser != "" || $nombreUser != "" || $nombreUser != "")) {
                if (preg_match('/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/', addslashes($passUser))) {
                    $query .= "contr_usu='" . addslashes(md5($passUser))."'";
                }
            }

            $query .= " WHERE id_usu=" . $_SESSION['userId'];
        }

        require_once "../Classes/BaseDeDatos.php";

        $db = new BaseDeDatos();

        if($imagenSubida) {
            //El archivo se ha subido, actualizamos la base de datos
            if ($errorWhileWorking) {
                $response['statusCode'] = 2;
                $response['message'] = "Se llevo a cabo la operacion con errores. 
                ¿El correo o la contraseña(1 mayus y un numero al menos) tienen el formato correcto?";
            } else {
                if($db->iudQuery($query)) {
                    $response['statusCode'] = 1;
                    $response['message'] = "Operacion realizada correctamente";
                } else {
                    $response['statusCode'] = 0;
                    $response['message'] = "Error al insertar los datos";
                }
            }
        } else {
            if($imagen != null) {
                $response['statusCode'] = 0;
                $response['message'] = "Error al insertar la imagen. Recuerda que no puede pesar mas de 10 mb y debe estar en png";
            } else {
                if ($errorWhileWorking) {
                    $response['statusCode'] = 2;
                    $response['message'] = "Se llevo a cabo la operacion con errores. 
                ¿El correo o la contraseña(1 mayus y un numero al menos) tienen el formato correcto?";
                } else {
                    if($db->iudQuery($query)) {
                        $response['statusCode'] = 3;
                        $response['message'] = "Operacion realizada correctamente";
                    } else {
                        $response['statusCode'] = 0;
                        $response['message'] = "Error al insertar los datos";
                    }
                }
            }
        }

        $db->cerrarConexion();
    } else {
        $response['statusCode'] = 0;
        $response['message'] = "Tienes que tener la sesion iniciada!";
    }
} else {
    $response['statusCode'] = 0;
    $response['message'] = "Tienes que tener la sesion iniciada!";
}

echo json_encode($response);