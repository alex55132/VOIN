<?php
include_once "utils/utils.php";
session_start();
if(isDataAvailable($_SESSION)) {
    unset($_SESSION["userId"]);
    session_destroy();
}
header("Location: index.php");