<?php
$server = "mysql";
$username = "student";
$password = "student";
$schema = "assignment1";

$pdo = new PDO('mysql:host='.$server.';dbname:=$schema', $username, $password, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);

$id = $_GET['id'];
$delete_admin_stmt = $pdo->prepare('DELETE FROM assignment1.admin WHERE id= :id');
$values = ['id' => $id];
$delete_admin_stmt->execute($values);

header('location: manageAdmins.php');