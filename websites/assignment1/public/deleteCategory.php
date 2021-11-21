<?php
$server = "mysql";
$username = "student";
$password = "student";
$schema = "assignment1";

$pdo = new PDO('mysql:host='.$server.';dbname:=$schema', $username, $password, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);

$categoryId = $_GET['name'];
$delete_category_stmt = $pdo->prepare('DELETE FROM assignment1.category WHERE name= :categoryId');
$values = ['categoryId' => $categoryId];
$delete_category_stmt->execute($values);

header('location: adminCategories.php');
