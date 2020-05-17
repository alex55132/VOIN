<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VOIN</title>
    <link rel="stylesheet" href="css/homeStyle.css">
    <link rel="stylesheet" href="css/navStyle.css">
    <script src="js/mainScript.js"></script>
</head>
<body>
    <nav class="navBar">

        <div class="logo">

        </div>

            <p>David</p>
        <ul class="navContainer">
            <li class="navItem"><a href="#">Home</a></li>
            <li class="navItem"><a href="#">Browse</a></li>
            <li class="navItem"><a href="tienda.php">Tienda</a></li>
            <li class="navItem"><a href="#">Subir video</a></li>

            <li id="loginBtn" class="navItem logBtn"><a href="#">Log-in / Registro</a></li>
        </ul>
    </nav>

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
