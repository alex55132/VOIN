<?php
function isDataAvailable($variable)
{
    $resultado = false;

    if (isset($variable) && !empty($variable)) {
        $resultado = true;
    }

    return $resultado;
}