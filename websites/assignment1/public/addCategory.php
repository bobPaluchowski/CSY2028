<?php
ob_start();
session_start();
require 'header.php'
?>

        <main>
		<div>
            <h1>Add category</h1>
        </div>

        <?php

        // ADDING CATEGORY TO DATABASE
        if(isset($_POST['add_category_btn'])){
            $add_category_stmt = $pdo->prepare('INSERT INTO assignment1.category (name) VALUES (:name)');
            $values = ['name' => $_POST['categoryName']];
            $add_category_stmt->execute($values);

            header('location: adminCategories.php');
        }else{
            ?>

            <form action="addCategory.php" method="POST">
            <label for="categoryName">Category name</lable>
            <input type="text" name="categoryName" autocomplete="off">
            <input type="submit" name="add_category_btn" value="Add category">
            </form>
            <?php
        }
        ?>

        </main>
		<?php
require 'footer.php'
?>
