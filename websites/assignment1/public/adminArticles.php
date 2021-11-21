<?php
ob_start();
session_start();
require 'header.php'
?>
		<main>
		<div>
            <h1>Manage articles</h1>
        </div>
        <?php

        $display_articles_stmt = $pdo->prepare('SELECT * FROM assignment1.article');
        $display_articles_stmt->execute();

        echo '<a href="addArticle.php"><button name="namage_articles_btn">Add article</button></a>';
        echo '<a href="admin.php"><button name="namage_articles_btn">Back to admin</button></a>';
        foreach($display_articles_stmt as $row)
        {

            echo '<ul>';
            echo '<li>'.$row['title'].'</li>';
            echo '<li>'.$row['content'].'</li>';
            echo '<a class="articleLink" href="editArticle.php?articleId='.$row['articleId'].'">Edit</a>';
            echo '<a class="articleLink" href="deleteArticle.php?articleId='.$row['articleId'].'">Delete</a>';
            echo '</ul>';
        }

        ?>
        </main>

		<?php
require 'footer.php'
?>