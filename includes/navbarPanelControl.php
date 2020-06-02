<?php include_once "../utils/utils.php"; ?>
<nav class="controlPanelNav">
    <div class="goBackBtn">
        <img id="atrasBtn" class="atrasBtn" src="../imgs/atras.jpg">
    </div>
    <div class="titleControlPanel">
        <h1>PANEL DE CONTROL</h1>
    </div>
    <div class="carteraContainer">
        <h3>Cartera:</h3>
        <?php
        if (isDataAvailable($_SESSION)){
           if(isDataAvailable($_SESSION['userId'])) {
               $userId = $_SESSION['userId'];

               require_once "../Classes/Usuario.php";

               $user = Usuario::getUsuarioById($userId);

               echo "<button>".$user->getDineroCartera()." €</button>";
           } else {
               header("Location: ../index.php");
           }
        } else {
            header("Location: ../index.php");
        }
        ?>
    </div>
</nav>