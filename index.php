<?php
require "Classes/BaseDeDatos.php";
require "Classes/Usuarios.php";

if (isset($_POST)&& !empty($_POST)){
    $corr = addslashes($_POST['corr_usu']);
    $pass = addslashes($_POST['contr_usu']);
    $usuario=new Usuarios();
    if ($usuario->login($corr,$pass)){
        session_start();
        $_SESSION['userId']=$usuario->getIdUsu();
        echo "<script> alert('holi')</script>";
    }else{
        echo "<script> alert('esta mal')</script>";
    }
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VOIN - Home</title>
    <link rel="stylesheet" href="css/homeStyle.css">
    <link rel="stylesheet" href="css/navStyle.css">
    <script src="js/login.js"></script>
    <script src="js/mainScript.js"></script>
</head>
<body>
    <?php
        //Para incluir correctamente la navbar, es necesario usar un <link> al archivo de css navStyle
        include "includes/navbarInclude.php";
    ?>

    <section class="mainContainer">
        <div class="paginator">
            <div class="paginatorItem flechaIzq"><-</div>
            <div class="paginatorItem"></div>
            <div class="paginatorItem"></div>
            <div class="paginatorItem"></div>
            <div class="paginatorItem"></div>
            <div class="paginatorItem"></div>
            <div class="paginatorItem"></div>
            <div class="paginatorItem flechaDer">-></div>
        </div>

        <div class="videosContainer">
            <h1 class="mainTitle">Home</h1>
            <hr class="separadorTitle">

            <div class="videosDisplay">
                <div class="videoItem">
                    <img src="https://pbs.twimg.com/profile_images/949787136030539782/LnRrYf6e.jpg">
                    <h3>Titulo de video 1</h3>
                    <h4>By alexby</h4>
                    <h4>35562 rep</h4>
                </div>
                <div class="videoItem">
                    <img src="https://pbs.twimg.com/profile_images/949787136030539782/LnRrYf6e.jpg">
                    <h3>Titulo de video 1</h3>
                    <h4>By alexby</h4>
                    <h4>35562 rep</h4>
                </div>
                <div class="videoItem">
                    <img src="https://pbs.twimg.com/profile_images/949787136030539782/LnRrYf6e.jpg">
                    <h3>Titulo de video 1</h3>
                    <h4>By alexby</h4>
                    <h4>35562 rep</h4>
                </div>
                <div class="videoItem">
                    <img src="https://pbs.twimg.com/profile_images/949787136030539782/LnRrYf6e.jpg">
                    <h3>Titulo de video 1</h3>
                    <h4>By alexby</h4>
                    <h4>35562 rep</h4>
                </div>
                <div class="videoItem">
                    <img src="https://pbs.twimg.com/profile_images/949787136030539782/LnRrYf6e.jpg">
                    <h3>Titulo de video 1</h3>
                    <h4>By alexby</h4>
                    <h4>35562 rep</h4>
                </div>
                <div class="videoItem">
                    <img src="https://pbs.twimg.com/profile_images/949787136030539782/LnRrYf6e.jpg">
                    <h3>Titulo de video 1</h3>
                    <h4>By alexby</h4>
                    <h4>35562 rep</h4>
                </div>
                <div class="videoItem">
                    <img src="https://pbs.twimg.com/profile_images/949787136030539782/LnRrYf6e.jpg">
                    <h3>Titulo de video 1</h3>
                    <h4>By alexby</h4>
                    <h4>35562 rep</h4>
                </div>
                <div class="videoItem">
                    <img src="https://pbs.twimg.com/profile_images/949787136030539782/LnRrYf6e.jpg">
                    <h3>Titulo de video 1</h3>
                    <h4>By alexby</h4>
                    <h4>35562 rep</h4>
                </div>
                <div class="videoItem">
                    <img src="https://pbs.twimg.com/profile_images/949787136030539782/LnRrYf6e.jpg">
                    <h3>Titulo de video 1</h3>
                    <h4>By alexby</h4>
                    <h4>35562 rep</h4>
                </div>
            </div>
        </div>
    </section>

    <?php
        include "includes/loginInclude.php";
    ?>
</body>
</html>
