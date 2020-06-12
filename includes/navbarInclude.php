<nav class="navBar">

    <div class="logo">
        <img src="imgs/iconos/voin.png" alt="">
    </div>

    <ul class="navContainer">
        <li class="navItem"><a href="index.php">Home</a></li>
        <li class="navItem"><a href="browse.php">Browse</a></li>
        <li class="navItem"><a href="tienda.php">Tienda</a></li>
        <li class="navItem"><a href="upload.php">Subir video</a></li>
        <?php
        require_once "utils/utils.php";
            if(isDataAvailable($_SESSION)) {
                $userId = $_SESSION['userId'];

                include_once "Classes/Usuario.php";

                $usuario = Usuario::getUsuarioById($userId);

                //Control contra cuentas desactivadas
                if($usuario->getTipo() == 3) {
                    unset($_SESSION['userId']);
                    session_destroy();
                    header("Location: index.php");
                }

                echo '<li class="navItem logged">
                        <img src="'.$usuario->getImg().'">
                        <div class="loggedOptions">
                            <p>Bienvenido '.$usuario->getNombre().'</p>
                            <p><a href="paneldecontrol/panelDeControl.php">Panel de control</a></p>
                            <p><a href="perfil.php">Perfil</a></p>
                            <p><a href="channel.php?channelId='.$usuario->getId().'">Canal</a></p>
                            <p><a href="logout.php">Logout </a></p>
                        </div>
                    </li>';
            } else {
                echo '<li id="loginBtn" class="navItem logBtn"><a href="#">Log-in / Registro</a></li>';
            }
        ?>


    </ul>
</nav>