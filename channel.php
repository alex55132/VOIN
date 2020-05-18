<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/navStyle.css">
    <link rel="stylesheet" href="css/channelStyle.css">
    <script src="js/mainScript.js"></script>
    <script src="js/channelScript.js"></script>
    <title>VOIN - Canal ejemplo</title>
</head>
<body>
<?php
include "includes/navbarInclude.php";
?>

<section class="mainContainer">
    <div class="channelIconContainer">
        <img class="channelIconImg" src="https://www.xtrafondos.com/wallpapers/espacio-estrellas-universo-nebulosa-3337.jpg">
        <p>El nombre de canal más largo del mundoo</p>
    </div>

    <div class="channelContentContainer">
        <div class="topVideosContainer">
            <div class="topVideosTitle">
                <h1>Top videos</h1>
                <hr>
            </div>
            <div class="topVideosDisplayer">
                <div class="scrollController">
                    <p class="carouselController" id="leftScroller"><-</p>
                </div>
                <!-- TODO: ALTs en imagenes -->
                <div id="videoScroller" class="videoScroller">
                    <div id="video1" class="video videoScrollerItem">
                        <img src="https://www.optoma.es/images/ProductApplicationFeatures/4kuhd/banner.jpg">
                        <h3>Titulo de video 1</h3>
                        <h4>By alexby</h4>
                        <h4>35562 rep</h4>
                    </div>
                    <div id="video2" class="video videoScrollerItem">
                        <img src="https://images.pexels.com/photos/1252869/pexels-photo-1252869.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500">
                        <h3>Titulo de video 2</h3>
                        <h4>By alexby</h4>
                        <h4>35562 rep</h4>
                    </div>
                    <div id="video3" class="video videoScrollerItem">
                        <img src="https://www.adslzone.net/app/uploads/2016/06/emerald-moraine-lake_3840x2160-4k-uhd-wallpaper-1.jpg">
                        <h3>Titulo de video 3</h3>
                        <h4>By alexby</h4>
                        <h4>35562 rep</h4>
                    </div>

                    <div id="video4" class="video videoScrollerItem">
                        <img src="https://www.giztele.com/wp-content/uploads/2017/04/descargar-trailers-y-demos-para-televisores-4k-1024x702.jpg">
                        <h3>Titulo de video 4</h3>
                        <h4>By alexby</h4>
                        <h4>35562 rep</h4>
                    </div>
                    <div id="video5" class="video videoScrollerItem">
                        <img src="https://fondosmil.com/fondo/17021.jpg">
                        <h3>Titulo de video 5</h3>
                        <h4>By alexby</h4>
                        <h4>35562 rep</h4>
                    </div>
                    <div id="video6" class="video videoScrollerItem">
                        <img src="https://pbs.twimg.com/profile_images/949787136030539782/LnRrYf6e.jpg">
                        <h3>Titulo de video 6</h3>
                        <h4>By alexby</h4>
                        <h4>35562 rep</h4>
                    </div>
                </div>

                <div class="scrollController righty">
                    <p class="carouselController" id="rightScroller">-></p>
                </div>
            </div>

            <div class="topVideosTitle">
                <h1>Todos los videos</h1>
                <hr>
            </div>
            <div class="fullVideosContainer">
                <div class="video videoListItem">
                    <img src="https://pbs.twimg.com/profile_images/949787136030539782/LnRrYf6e.jpg">
                    <h3>Titulo de video 1</h3>
                    <h4>By alexby</h4>
                    <h4>35562 rep</h4>
                </div>
                <div class="video videoListItem">
                    <img src="https://pbs.twimg.com/profile_images/949787136030539782/LnRrYf6e.jpg">
                    <h3>Titulo de video 1</h3>
                    <h4>By alexby</h4>
                    <h4>35562 rep</h4>
                </div>
                <div class="video videoListItem">
                    <img src="https://pbs.twimg.com/profile_images/949787136030539782/LnRrYf6e.jpg">
                    <h3>Titulo de video 1</h3>
                    <h4>By alexby</h4>
                    <h4>35562 rep</h4>
                </div>
                <div class="video videoListItem">
                    <img src="https://pbs.twimg.com/profile_images/949787136030539782/LnRrYf6e.jpg">
                    <h3>Titulo de video 1</h3>
                    <h4>By alexby</h4>
                    <h4>35562 rep</h4>
                </div>
                <div class="video videoListItem">
                    <img src="https://pbs.twimg.com/profile_images/949787136030539782/LnRrYf6e.jpg">
                    <h3>Titulo de video 1</h3>
                    <h4>By alexby</h4>
                    <h4>35562 rep</h4>
                </div>
                <div class="video videoListItem">
                    <img src="https://pbs.twimg.com/profile_images/949787136030539782/LnRrYf6e.jpg">
                    <h3>Titulo de video 1</h3>
                    <h4>By alexby</h4>
                    <h4>35562 rep</h4>
                </div>
                <div class="video videoListItem">
                    <img src="https://pbs.twimg.com/profile_images/949787136030539782/LnRrYf6e.jpg">
                    <h3>Titulo de video 1</h3>
                    <h4>By alexby</h4>
                    <h4>35562 rep</h4>
                </div>
                <div class="video videoListItem">
                    <img src="https://pbs.twimg.com/profile_images/949787136030539782/LnRrYf6e.jpg">
                    <h3>Titulo de video 1</h3>
                    <h4>By alexby</h4>
                    <h4>35562 rep</h4>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include "includes/loginInclude.php";
?>

</body>
</html>