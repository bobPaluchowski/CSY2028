<?php
ob_start();
session_start();
require 'header.php'
?>
		<main>
		<div>
            <h1>Edit article</h1>
        </div>
        <?php

$articleId = $_GET['articleId'];

        // UPDATING SELECTED ARTICLE
 if(isset($_POST['submit']))
 {
     $add_edited_article_stmt = $pdo->prepare('UPDATE assignment1.article SET title= :title, content= :content, articleId= :articleId WHERE articleId = :articleId');

     $add_edited_article_stmt->execute([
         'title' => $_POST['title'],
         'content' => $_POST['content'],
         'articleId' => $articleId
     ]);
     header('location: adminArticles.php');
 }else{
             // DISPLAYING SELECTED ARTICLE
    $edit_article_stmt = $pdo->prepare('SELECT * FROM assignment1.article WHERE articleId = :articleId');
    $values = ['articleId' => $articleId];
    $edit_article_stmt->execute($values);

    $article = $edit_article_stmt->fetch();
    ?>
    <form action="editArticle.php?articleId=<?echo $articleId?>" method="POST">
    <label for="title">Title</label>
    <input type="text" name="title" value="<?echo $article['title']?>" autocomplete="off"/><br><br>

    <label for="content">Content</label>
    <input type="text" name="content" value="<?echo $article['content']?>" autocomplete="off"/><br><br>

    <input type="submit" name="submit" value="Submit"/><hr>
</form>
<?php
 }
?> 

        </main>

		<?php
require 'footer.php'
?>
