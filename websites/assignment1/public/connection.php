<?php

$server = "mysql";
$username = "student";
$password = "student";
$schema = "assignment1";

$pdo = new PDO('mysql:host='.$server.';dbname:=$schema', $username, $password, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);