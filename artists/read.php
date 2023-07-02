<?php

include 'Artists.php';

header("Content-Type: application/json; charset=utf-8");
$artist= new Artists();
$artist->createTable();
echo $artist->read($_GET);

?>