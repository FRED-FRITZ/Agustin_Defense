<?php

include 'songs.php';

header("Content-Type: application/json; charset=utf-8");
$songs= new songs();
$songs->createTable();
echo $songs->search($_GET);

?>