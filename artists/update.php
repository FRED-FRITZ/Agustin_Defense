<?php

include 'artists.php';

header("Content-Type: application/json; charset=utf-8");
$a= new artists();
$a->createTable();
echo $a->update($_POST);

?>