<?php
$server = "mysql";
$username = "student";
$password = "student";
$schema = "assignment1";

$pdo = new PDO('mysql:host='.$server.';dbname:=$schema', $username, $password, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);

$articleId = $_GET['articleId'];
$delete_article_stmt = $pdo->prepare('DELETE FROM assignment1.article WHERE articleId= :articleId');
$values = ['articleId' => $articleId];
$delete_article_stmt->execute($values);

header('location: adminArticles.php');