<?php

include 'users.php';

header("Content-Type: application/json; charset=utf-8");
$u= new users();
$u->createTable();
echo $u->update($_POST);

?>