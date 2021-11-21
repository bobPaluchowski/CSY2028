<?php
ob_start();
session_start();
require 'header.php'
?>
        <main>
		<div>
            <h1>Edit category</h1>
        </div>
        <?php

        $categoryId = $_GET['name'];
        // UPDATING SELECTED CATEGORY
        if(isset($_POST['submit'])){
            $add_edited_category_stmt = $pdo->prepare('UPDATE assignment1.category SET name= :categoryName WHERE name= :oldCategoryName');

            $values = [
                'categoryName' => $_POST['categoryName'],
                'oldCategoryName' => $categoryId
            ];

            $add_edited_category_stmt->execute($values);
            header('location: adminCategories.php');
        }else{
            $edit_category_stmt = $pdo->prepare('SELECT * FROM assignment1.category WHERE name= :categoryId');
            $values = ['categoryId' => $categoryId];
            $edit_category_stmt->execute($values);

            $category = $edit_category_stmt->fetch();
            ?>
            <form action="editCategory.php?name=<?echo $categoryId?>" method="POST">

            <input type="hidden" name="oldCategoryName" value="<?echo $categoryId?>">

            <label for="categoryName">Category name</label>
            <input type="text" name="categoryName" value="<?echo $category['name']?>" autocomplete="off">
            <input type="submit" name="submit" value="Submit">
            </form>
            <?php
        }

        ?>
        </main>
		<?php
require 'footer.php'
?>
