<?php
require_once "Classes/Usuario.php";
include_once "utils/utils.php";

session_start();
if(isDataAvailable($_SESSION)) {
    $userId = $_SESSION['userId'];

    $usuario = Usuario::getUsuarioById($userId);

    //Control contra cuentas desactivadas
    if($usuario->getTipo() == 3) {
        unset($_SESSION['userId']);
        session_destroy();
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}
?>
<nav id="tiendaNav">
    <img id="atras" src="imgs/atras.jpg" alt="atras">
    <div id="cartera">
        <p>Cartera</p>
        <div>
            <p><?php echo $usuario->getDineroCartera(); ?></p>
        </div>
    </div>
    <div id="titulo">PERFIL</div>
</nav>