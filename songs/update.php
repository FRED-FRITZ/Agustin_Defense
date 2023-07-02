<?php

include 'songs.php';

header("Content-Type: application/json; charset=utf-8");
$s= new songs();
$s->createTable();
echo $s->update($_POST);

?>