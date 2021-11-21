<?php
ob_start();
session_start();
require 'header.php'
?>
		<main>
		<div>
            <h1>Manage admins</h1>
        </div>
        <?php

        $display_admins_stmt = $pdo->prepare('SELECT * FROM assignment1.admin');
        $display_admins_stmt->execute();

        echo '<a href="addAdmin.php"><button name="namage_admins_btn">Add admin</button></a>';
        echo '<a href="admin.php"><button name="namage_articles_btn">Back to admin</button></a>';
        foreach($display_admins_stmt as $row)
        {

            echo '<ul>';
            echo '<li>'.$row['name'].'</li>';
            echo '<a class="articleLink" href="editAdmin.php?id='.$row['id'].'">Edit</a>';
            echo '<a class="articleLink" href="deleteAdmin.php?id='.$row['id'].'">Delete</a>';
            echo '</ul>';
        }

        ?>
        </main>

		<?php
require 'footer.php'
?>