<?php

include 'artists.php';

header("Content-Type: application/json; charset=utf-8");
$artist= new artists();
$artist->createTable();
echo $artist->create($_POST);

?>