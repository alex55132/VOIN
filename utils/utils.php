<?php
function isDataAvailable($variable)
{
    $resultado = false;

    if (isset($variable) && !empty($variable)) {
        $resultado = true;
    }

    return $resultado;
}

function _log($logInfo, $logpath) {
    $archivo = fopen($logpath, "a");
    fwrite($archivo, $logInfo);
    fclose($archivo);
}
