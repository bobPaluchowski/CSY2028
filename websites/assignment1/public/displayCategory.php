<?php
ob_start();
session_start();
require 'header.php'
?>
		<main>
        <?php

			// DISPLAYING ARTICLES
			if(isset($_GET['name']))
			{

				$categoryId = $_GET['name'];
				$select_article_stmt = $pdo->prepare('SELECT * FROM assignment1.article WHERE categoryId= :categoryId');
				$values = ['categoryId' => $categoryId];
				$select_article_stmt->execute($values);

				foreach($select_article_stmt as $row)
				{
                    echo '<div>';
					$date = new DateTime($row['publishDate']);
                    echo '<a class="articleLink" href="displayArticle.php?articleId='.$row['articleId'].'">'.$row['title'].'</a>';
					echo '<p>'.$row['content'].'</p>';
					echo '<em>'.$date->format('Y-m-d H:i').'</em>';
                    echo '</div>';
					
				}
            }

			?>
        </main>
<?php
require 'footer.php'
?>