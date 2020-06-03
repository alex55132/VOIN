<?php
    require_once "Classes/Usuario.php";
    include_once "utils/utils.php";

    session_start();
    if(isDataAvailable($_SESSION)) {
        $userId = $_SESSION['userId'];

        $usuario = Usuario::getUsuarioById($userId);
    } else {
        header("Location: index.php");
    }
?>
<nav id="tiendaNav">
    <img id="atras" src="imgs/atras.jpg" alt="atras">
    <div id="usuario">
        <?php //TODO: IMAGEN DEL USUARIO ?>
        <div id="icono"><img src="imgs/gatete.jpg" alt="icono"></div>
        <div>
            <p>Bienvenido <?php echo $usuario->getNombre();?></p>
            <p><a href="paneldecontrol/panelDeControl.php">Panel de control</a></p>
            <p><a href="channel.php?channelId=<?php echo $usuario->getId();?>">Canal </a></p>
            <p><a href="logout.php">Logout </a></p>
        </div>
    </div>
    <div id="cartera">
        <p>Cartera</p>
        <div>
            <p><?php echo $usuario->getDineroCartera(); ?>€</p>
        </div>
    </div>
    <div id="titulo">TIENDA</div>
</nav>
