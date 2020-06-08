<?php
require "../../Classes/Video.php";
$id=intval($_GET['id']);
Video::eliminarVideo($id);
