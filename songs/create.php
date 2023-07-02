<?php

include 'songs.php';

header("Content-Type: application/json; charset=utf-8");
$song= new songs();
$song->createTable();
echo $song->create($_POST);

?>