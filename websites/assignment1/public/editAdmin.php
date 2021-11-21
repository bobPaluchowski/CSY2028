<?php
ob_start();
session_start();
require 'header.php'
?>
		<main>
		<div>
            <h1>Edit admin</h1>
        </div>
        <?php

$id = $_GET['id'];

        // UPDATING SELECTED ADMIN
 if(isset($_POST['submit']))
 {
     $add_edited_admin_stmt = $pdo->prepare('UPDATE assignment1.admin SET name= :name, email= :email, password= :password WHERE id = :id');

     $add_edited_admin_stmt->execute([
         'name' => $_POST['name'],
         'email' => $_POST['email'],
         'password' => $_POST['password'],
         'id' => $id
     ]);
     header('location: manageAdmins.php');
 }else{
             // DISPLAYING SELECTED ADMIN
    $edit_admin_stmt = $pdo->prepare('SELECT * FROM assignment1.admin WHERE id = :id');
    $values = ['id' => $id];
    $edit_admin_stmt->execute($values);

    $admin = $edit_admin_stmt->fetch();
    ?>
    <form action="editAdmin.php?id=<?echo $id?>" method="POST">
    <label for="name">Name</label>
    <input type="text" name="name" value="<?echo $admin['name']?>" autocomplete="off"/><br><br>

    <label for="password">Password</label>
    <input type="text" name="password" value="<?echo $admin['password']?>" autocomplete="off"/>

    <label for="email">Email</label>
    <input type="text" name="email" value="<?echo $admin['email']?>" autocomplete="off"/><br><br>

    <input type="submit" name="submit" value="Submit"/><hr>
</form>
<?php
 }
?> 

        </main>

		<?php
require 'footer.php'
?>
