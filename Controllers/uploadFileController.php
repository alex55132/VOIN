<?php
require_once "../utils/utils.php";

//check if request is GET and the requested chunk exists or not.
//Por algun motivo si quito esto el sistema deja de funcionar, asumo que porque las peticiones por defecto son GET y necesitan diferenciarse para que el server lo detecte bien
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (!(isset($_GET['resumableIdentifier']) && trim($_GET['resumableIdentifier']) != '')) {
        $_GET['resumableIdentifier'] = '';
    }
    $temp_dir = '../temp/' . $_GET['resumableIdentifier'];
    if (!(isset($_GET['resumableFilename']) && trim($_GET['resumableFilename']) != '')) {
        $_GET['resumableFilename'] = '';
    }
    if (!(isset($_GET['resumableChunkNumber']) && trim($_GET['resumableChunkNumber']) != '')) {
        $_GET['resumableChunkNumber'] = '';
    }
    $chunk_file = $temp_dir . '/' . $_GET['resumableFilename'] . '.part' . $_GET['resumableChunkNumber'];
    if (file_exists($chunk_file)) {
        header("HTTP/1.0 200 Ok");
    } else {
        header("HTTP/1.0 404 Not Found");
    }
} else {
    //POST
    $totalChunks = $_POST['resumableTotalChunks'];
}
$nombreArchivo = "";
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

$nombreArchivoFinal = substr(str_shuffle($permitted_chars), 0, 16);
$tipo = "";

foreach ($_FILES as $file) {
    $currentChunk = $_POST['resumableChunkNumber'];
    $tipo = trim(pathinfo($file['name'], PATHINFO_EXTENSION));

    logData("Tipo: " . $tipo . "; Strpos:" . strpos($tipo, "mp4") . "\n");

    if (strpos($tipo, "avi") !== false || strpos($tipo, "mp4") !== false) {
        $nombreArchivo = limpiar_caracteres_especiales($file['name']);
        $nombreArchivo = trim($nombreArchivo, " ");
        if (file_exists("../videos/" . $nombreArchivoFinal)) {
            //Devolvemos mensaje de error si ya hay algun archivo con ese nombre en el server
            header("HTTP/1.0 404 Not Found");
        } else {
            move_uploaded_file($file['tmp_name'], "../videos/" . $nombreArchivo . ".part" . $currentChunk);
        }
    } else {
        header("HTTP/1.0 404 Not Found");
    }
}

if ($totalChunks == $currentChunk && isDataAvailable($nombreArchivo)) {
    //Comprobamos que todos los chunks están listos
    $insertable = true;
    $e = 1;

    while ($insertable && $e <= ($totalChunks - ($totalChunks - $currentChunk))) {
        if (file_exists("../videos/" . $nombreArchivo . ".part" . $e)) {
            $e++;
        } else {
            $insertable = false;
        }
    }

    //Si todos los chunks están disponibles juntamos el video
    if ($insertable) {
        $finalFile = fopen("../videos/" . $nombreArchivoFinal.".".$tipo, "a");
        for ($i = 1; $i <= $totalChunks; $i++) {
            fwrite($finalFile, file_get_contents("../videos/" . $nombreArchivo . ".part" . $i));
        }
        fclose($finalFile);

        for($e = 0; $e <= $totalChunks; $e++) {
            //Por ultimo, eliminamos archivos de partes
            unlink("../videos/".$nombreArchivo.".part".$e);
        }
    } else {
        logData("Faltan chunks! Cancelamos inserción \n");
        header("HTTP/1.0 404 Not Found");
    }
}


function logData($data)
{
    $logFile = fopen("../log.txt", "a");
    fwrite($logFile, date("Y-m-d H:i:s") . " ----- " . $data);
    fclose($logFile);
}

function limpiar_caracteres_especiales($cadena)
{
//preg_replace($patrones, $sustituciones, $cadena);
//$cadena = preg_replace("/[^a-zA-Z0-9\_\-]+/", "",$cadena);

//IMPORTANTE
    $cadena = utf8_decode($cadena);

    $cadena = str_replace(
        array('?', '¿'),
        array('_', '_'),
        $cadena
    );
    $cadena = str_replace(
        array(' '),
        array('_'),
        $cadena
    );
    $cadena = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $cadena
    );

    $cadena = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $cadena);

    $cadena = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $cadena);

    $cadena = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $cadena);

    $cadena = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $cadena);

    $cadena = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C'),
        $cadena
    );
//para ampliar los caracteres a reemplazar agregar lineas de este tipo:
//$archivo = str_replace("caracter-que-queremos-cambiar","caracter-por-el-cual-lo-vamos-a-cambiar",$archivo);
    return $cadena;
}
