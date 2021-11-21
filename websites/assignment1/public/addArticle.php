<?php
ob_start();
session_start();
require 'header.php'
?>


        <main>
		<div>
            <h1>Add article</h1>
        </div>
        <?php

// ADDING AN ARTICLE TO DATABASE
        if(isset($_POST['add_article_btn']))
        {

            $add_article_stmt = $pdo->prepare('INSERT INTO assignment1.article (title, content, categoryId, publishDate) VALUES (:title, :content, :categoryId, :publishDate)');

            $date = new DateTime();
            $date = $date->format('Y-m-d H:i');

            $values = [
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'categoryId' => $_POST['selectCategory'],
                'publishDate' => $date
            ];
            $add_article_stmt->execute($values);
            header('location: adminArticles.php');
        }
        ?>

<form action="addArticle.php" method="POST">
    <label for="title">Title</label>
    <input type="text" name="title" autocomplete="off">

    <label for="content">Content</label>
    <input type="textarea" name="content" autocomplete="off">

    <select name="selectCategory" id="">
    <?php
						$stmt = $pdo->prepare('SELECT * FROM assignment1.category');
						$stmt->execute();
						foreach($stmt as $row){
                            echo '<option value='.$row['name'].'>'.$row['name'].'</option>';
						}
						
						?>
    </select>

    <input type="submit" name="add_article_btn" value="Add article">
</form>
</main>

<?php
require 'footer.php'
?>