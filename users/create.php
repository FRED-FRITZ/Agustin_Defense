<?php

include 'users.php';

header("Content-Type: application/json; charset=utf-8");
$user= new users();
$user->createTable();
echo $user->create($_POST);

?>