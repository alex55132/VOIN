<?php
require_once "../utils/utils.php";
$pestana = 0;
if (isDataAvailable($_GET)) {
    if (isDataAvailable($_GET['pestana']) && is_numeric($_GET['pestana'])) {
        $pestana = $_GET['pestana'];
    } else {
        header("Location: ./panelDeControl.php?pestana=1");
    }
} else {
    header("Location: ./panelDeControl.php?pestana=1");
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VOIN - Panel de control</title>
    <link rel="stylesheet" href="css/navPanelControl.css">
    <link rel="stylesheet" href="css/panelDeControlStyle.css">
    <?php
    if (isDataAvailable($pestana)) {
        if ($pestana == 4) {
            //Mostramos el script de gestion
            echo "<script src='js/gestionControlPanelScript.js'></script>";
        }
    }
    ?>
    <script src="js/navPanelControlScript.js"></script>
    <script src="js/controlPanelScript.js"></script>
    <script src="js/borrarScript.js"></script>
</head>
<body>
<?php
session_start();
$user = "";

//LA VARIABLE $USER y el utils.php SE DECLARA DENTRO DE ESTE REQUIRE
require_once "../includes/navbarPanelControl.php";
?>
<section class="mainContainer">
    <div class="controlPanelTabsContainer">
        <?php

        if (isDataAvailable($user)) {
            $accessLvl = $user->getTipo();

            switch ($accessLvl) {
                case 0:
                    //Usuario estándar
                    echo '<div id="videoTag" class="itemVideos selected">
                            <h1>VIDEOS</h1>
                        </div>';
                    break;
                case 1:
                    //Moderador
                    if ($pestana == 2) {
                        echo '<div id="videoTag" class="itemVideos">
                            <h1>VIDEOS</h1>
                        </div>
                        <div id="modTag" class="itemVideos selected">
                            <h1>MODERACION</h1>
                        </div>';
                    } else {
                        echo '<div id="videoTag" class="itemVideos selected">
                            <h1>VIDEOS</h1>
                        </div>
                        <div id="modTag" class="itemVideos">
                            <h1>MODERACION</h1>
                        </div>';
                    }
                    break;
                case 2:
                    //Administrador
                    if ($pestana == 2) {
                        echo '<div id="videoTag" class="itemVideos">
                            <h1>VIDEOS</h1>
                        </div>
                        <div id="modTag" class="itemVideos selected">
                            <h1>MODERACION</h1>
                        </div>
                        <div id="admTag" class="itemVideos">
                            <h1>ADMINISTRACION</h1>
                        </div>
                        <div id="gestTag" class="itemVideos">
                            <h1>GESTION</h1>
                        </div>';
                    } else if ($pestana == 3) {
                        echo '<div id="videoTag" class="itemVideos">
                            <h1>VIDEOS</h1>
                        </div>
                        <div id="modTag" class="itemVideos">
                            <h1>MODERACION</h1>
                        </div>
                        <div id="admTag" class="itemVideos selected">
                            <h1>ADMINISTRACION</h1>
                        </div>
                        <div id="gestTag" class="itemVideos">
                            <h1>GESTION</h1>
                        </div>';
                    } else if ($pestana == 4) {
                        echo '<div id="videoTag" class="itemVideos">
                            <h1>VIDEOS</h1>
                        </div>
                        <div id="modTag" class="itemVideos">
                            <h1>MODERACION</h1>
                        </div>
                        <div id="admTag" class="itemVideos">
                            <h1>ADMINISTRACION</h1>
                        </div>
                        <div id="gestTag" class="itemVideos selected">
                            <h1>GESTION</h1>
                        </div>';
                    } else {
                        echo '<div id="videoTag" class="itemVideos selected">
                            <h1>VIDEOS</h1>
                        </div>
                        <div id="modTag" class="itemVideos">
                            <h1>MODERACION</h1>
                        </div>
                        <div id="admTag" class="itemVideos">
                            <h1>ADMINISTRACION</h1>
                        </div>
                        <div id="gestTag" class="itemVideos">
                            <h1>GESTION</h1>
                        </div>';
                    }
                    break;
            }
        }
        ?>
    </div>

    <div class="displayVideoContainer">
        <?php
        if (isDataAvailable($pestana)) {
            if ($pestana == 3) {
                echo '<div class="searchUserContainer">
                        <form action="#">
                            <input id="searchUserInput" type="text" placeholder="Nombre de usuario" class="searchUserInput">
                        </form>
                    </div>';
            }
        }
        ?>

        <div class="displayerHeader">
            <?php
            if (isDataAvailable($pestana)) {
                switch ($pestana) {
                    case 1:
                        //Videos
                        echo '<h3 class="videoTableElement">Video</h3>
                                <h3 class="videoTableElement">Titulo</h3>
                                <h3 class="videoTableElement">Fecha</h3>
                                <h3 class="videoTableElement">Visualizaciones</h3>
                                <h3 class="videoTableElement">Categoría</h3>
                                <h3 class="videoTableElement">Acciones</h3>';
                        break;
                    case 2:
                        //Moderacion
                        echo '<h3 class="moderacionTableElementHeader">Video</h3>
                                <h3 class="moderacionTableElementHeader">Titulo</h3>
                                <h3 class="moderacionTableElementHeader">Autor</h3>';
                        break;
                    case 3:
                        //Administracion
                        echo '<h3 class="administracionTableElement">Imagen</h3>
                                <h3 class="administracionTableElement">Nº reportes</h3>
                                <h3 class="administracionTableElement">Nombre</h3>
                                <h3 class="administracionTableElement">Acciones</h3>';
                        break;
                    case 4:
                        //Gestion
                        if (isset($_GET['item']) && !empty($_GET['item'])) {
                            $item = $_GET['item'];

                            switch ($item) {
                                case 1:
                                    //Head de categorias
                                    echo '
                                    <h3 class="gestionProductosLargosTableElement">Nombre</h3>
                                    <h3 class="gestionProductosLargosTableElement">Imagen</h3>
                                    <a href="panelProducto.php"><button>Añadir</button></a>
                                    ';
                                    break;
                                case 2:
                                    //Head de productos
                                    echo '

                                    <h3 class="gestionProductosTableElement">Nombre</h3>
                                    <h3 class="gestionProductosLargosTableElement">Descripcion</h3>
                                    <h3 class="gestionProductosTableElement">Empresa</h3>
                                    <h3 class="gestionProductosTableElement">Precio</h3>
                                    <h3 class="gestionProductosTableElement">Stock</h3>
                                    <h3 class="gestionProductosTableElement">Imagen</h3>
                                    <a href="panelProducto.php"><button>Añadir</button></a>
                                    ';
                                    break;
                                case 3:
                                    //Head de empresas
                                    break;
                            }
                        }
                        break;
                }
            }
            ?>
        </div>
        <div class="displayerBody">
            <?php
            if (isDataAvailable($pestana)) {
                switch ($pestana) {
                    case 1:
                        //Pestaña de videos
                        require_once "../Classes/Listador.php";
                        require_once "../Classes/Categoria.php";

                        $videos = Listador::listarVideos(0, 0, $user->getId());

                        for ($i = 0; $i < sizeof($videos); $i++) {
                            $video = $videos[$i];
                            $categoria = Categoria::getCategoriaById($video->getCategoria());

                            echo '<div class="itemRow">
                                <img class="videoTableElement" src="../' . $video->getMiniatura() . '">
                                <p class="videoTableElement">' . $video->getTitulo() . '</p>
                                <p class="videoTableElement">' . $video->getFechaPublicacion() . '</p>
                                <p class="videoTableElement">' . $video->getVisualizaciones() . '</p>
                                <p class="videoTableElement">' . $categoria->getNombre() . '</p>
                                <p class="actionIcon videoTableElement"><a href="modificarVideo.php?id='.$video->getId().'"><img src="../imgs/EditIcon.svg" class="icon"></a> </p>
                                <p class="actionIcon videoTableElement"><a href="javascript:borrarVideo('.$video->getId().')"><img src="../imgs/DeleteIcon.svg" class="icon"></a></p>
                              </div>';
                        }

                        break;
                    case 2:
                        //Pestaña de moderador
                        if ($user->getTipo() < 1) {
                            header("Location: ../index.php");
                        } else {
                            require_once "../Classes/Listador.php";

                            $listaVideos = Listador::listarVideoReportados();

                            for ($i = 0; $i < sizeof($listaVideos); $i++) {
                                $video = $listaVideos[$i];
                                echo '<div class="itemRow">
                                <img class="moderacionTableElement" src="../' . $video->getMiniatura() . '">
                                <p class="moderacionTableElement">' . $video->getTitulo() . '</p>
                                <p class="moderacionTableElement">' . $video->getNombreUsuario() . '</p>
                                <div id="acceptVideoBtn" class="actionIcon moderacionTableElement" data-acceptedvideo="' . $video->getId() . '"><img src="../imgs/acceptButtonIcon.png" class="icon"></div>
                                <div id="rejectVideoBtn" class="actionIcon moderacionTableElement" data-rejectedvideo="' . $video->getId() . '"><img src="../imgs/DeleteIcon.svg" class="icon"</div>
                              </div>';
                            }
                        }
                        break;
                    case 3:
                        //Pestaña de administracion
                        if ($user->getTipo() < 2) {
                            header("Location: ../index.php");
                        } else {
                            require_once "../Classes/Listador.php";
                            require_once "../Classes/BaseDeDatos.php";

                            $db = new BaseDeDatos();
                            $listaUsuarios = Listador::listarCanales(0, null);

                            for($i = 0; $i < sizeof($listaUsuarios) ; $i++) {
                                $usuario = $listaUsuarios[$i];
                                $resultado = $db->realizarConsulta('SELECT COUNT(video.id_video) FROM video INNER JOIN reporte ON reporte.id_video = video.id_video WHERE reporte.id_usu = '.$usuario->getId());
                                //Numero de reportes
                                $nReportes = $resultado[0][0];
                                echo '<div class="itemRow itemUsuario">
                                        <img class="administracionTableElement" src="../'.$usuario->getImg().'">
                                        <p class="administracionTableElement">'.$nReportes.'</p>
                                        <p class="administracionTableElement nombreUsuario">'.$usuario->getNombre().'</p>
                                        <button data-canalid="'.$usuario->getId().'" class="administracionTableElement verCanalBtn">Ver canal</button>
                                        <button data-canalid="'.$usuario->getId().'" class="administracionTableElement eliminarCuentaBtn">Eliminar cuenta</button>
                                        </div>';

                            }

                            $db->cerrarConexion();
                        }
                        break;
                    case 4:
                        require_once "../Classes/Listador.php";
                        require_once "../Classes/Categoria.php";
                        require_once "../Classes/Producto.php";
                        require_once "../Classes/Empresa.php";
                        //Pestaña de gestion
                        if ($user->getTipo() < 2) {
                            header("Location: ../index.php");
                        } else {
                            //Comprobamos si el usuario ha seleccionado algun elemento en el panel de gestion
                            if (isset($_GET['item']) && !empty($_GET['item']) && is_numeric($_GET['item'])) {
                                $item = $_GET['item'];

                                switch ($item) {
                                    case 1:
                                        //Contenido de categorias
                                        break;
                                    case 2:
                                        $productos = Listador::listarDatosProductos();
                                        //Contenido de productos
                                        for ($i = 0; $i < sizeof($productos); $i++) {
                                            $producto=$productos[$i];
                                            $empresa = Empresa::getEmpresaById($producto->getIdEmpr());
                                            echo '<div class="itemRow producto">
                                        <p class="gestionProductosTableElement">'.$producto->getNomPro().'</p>
                                        <p class="gestionProductosLargosTableElement">'.$producto->getDescrPro().'</p>
                                        <p class="gestionProductosTableElement">'.$empresa->getNomEmpr().'</p>
                                        <p class="gestionProductosTableElement">'.$producto->getPrePro().' €</p>
                                        <p class="gestionProductosTableElement">'.$producto->getStockPro().'</p>
                                        <div class="productoImg"><img src="../imgs/tienda/'.$producto->getImgPro().'" alt="producto"></div>
                                        <div class="iconsContainer">
                                            <a href="panelProducto.php?id='.$producto->getIdPro().'"><img src="../imgs/EditIcon.svg"></a> 
                                            <a href="javascript:borrarProducto('.$producto->getIdPro().')"><img src="../imgs/DeleteIcon.svg"></a>
                                        </div>
                                        
                                        </div>';
                                        }
                                        break;
                                    case 3:
                                        //Contenido de empresas
                                        break;
                                    default:
                                        header("Location: panelDeControl.php");
                                        break;
                                }
                            } else {
                                echo "<div class='gestionContainer'>
                                <div id='catItem' class='gestionItem'>Categorias (CAMBIAR POR LOGOS)</div>
                                <div id='prodItem' class='gestionItem'>Productos</div>
                                <div id='empItem' class='gestionItem'>Empresas</div>
                                </div>";
                            }
                        }
                        break;
                    default:
                        //Ninguna opcion válida
                        header("Location: ../index.php");
                        break;
                }
            }

            ?>
        </div>
    </div>
</section>
</body>
</html>