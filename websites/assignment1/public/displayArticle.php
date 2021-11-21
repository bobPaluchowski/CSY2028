<?php
ob_start();
session_start();
require 'header.php'
?>

<main>
<?php

if(isset($_GET['articleId'])){
    // displaying selected article
    $articleId = $_GET['articleId'];
    $display_article_stmt = $pdo->prepare('SELECT * FROM assignment1.article WHERE articleId= :articleId');

    $values = [
        'articleId' => $articleId
    ];
    $display_article_stmt->execute($values);
    foreach($display_article_stmt as $row){
        $articleId = $row['articleId'];
        $title = $row['title'];
        $content = $row['content'];
        $publishDate = $row['publishDate'];
        $categoryId = $row['categoryId'];

        echo '<div>';
	$date = new DateTime($row['publishDate']);
	echo '<h1>'.$row['title'].'</h1>';
	echo '<p>'.$row['content'].'</p>';
	echo '<em>'.$date->format('Y-m-d H:i').'</em>';
	echo '</div>';
    }
    // displaying comments
    $comment_stmt = $pdo->prepare('SELECT * FROM assignment1.comment WHERE articleId= :articleId');
    $comment_values = ['articleId' => $_GET['articleId']];
    $comment_stmt->execute($comment_values);
    echo '<h3>Comments</h3>';
    foreach($comment_stmt as $comment_row){
        echo '<div>';
echo '<ul>';
echo '<li>'.$comment_row['content'].'</li>';
echo '<p>'.$comment_row['author'].'</p>';
echo '</ul>';
echo '</div>';
    }

}

if(isset($_POST['comment_btn'])){
    $display_article_stmt = $pdo->prepare('SELECT * FROM assignment1.article WHERE articleId= :articleId');

    $values = [
        'articleId' => $articleId
    ];
    $display_article_stmt->execute($values);
    foreach($display_article_stmt as $row){
        $articleId = $row['articleId'];
        $title = $row['title'];
        $content = $row['content'];
        $publishDate = $row['publishDate'];
        $categoryId = $row['categoryId'];
    }
    $add_comment_stmt = $pdo->prepare('INSERT INTO assignment1.comment (author, content, articleId) VALUES (:author, :content, :articleId)');
    $article_values = [
        'author' => $_SESSION['name'],
        'content' => $_POST['comment'],
        'articleId' => $articleId
    ];
    $add_comment_stmt->execute($article_values);
    header('location: displayArticle.php?articleId='.$articleId);
}else{
    ?>

<form action="displayArticle.php?articleId=<? echo $articleId?>" method="POST">
<label for="comment">Comment here</label>
<input type="textarea" name="comment" autocomplete="off">
<input type="submit" name="comment_btn" value="comment">
</form>
</main>
<?php
}

// var_dump($row);
?>
<?php
require 'footer.php'
?>
