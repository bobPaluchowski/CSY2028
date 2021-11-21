<?php
require 'header.php'
?>
        <main>
		<div>
            <h1>Manage categories</h1>
        </div>

        <?php
        $display_categries_stmt= $pdo->prepare('SELECT * FROM assignment1.category');
        $display_categries_stmt->execute();

        echo '<a href="addCategory.php"><button name="manage_articles_btn">Add category</button></a>';
        echo '<a href="admin.php"><button name="manage_articles_btn">Back to admin</button></a>';
        foreach($display_categries_stmt as $row){
            echo '<ul>';
            echo '<li>'.$row['name'].'</li>';
            echo '<a class="articleLink" href="editCategory.php?name='.$row['name'].'">Edit</a>';
            echo '<a class="articleLink" href="deleteCategory.php?name='.$row['name'].'">Delete</a>';
            echo '</ul>';
        }

        ?>
        </main>

		<?php
require 'footer.php'
?>
