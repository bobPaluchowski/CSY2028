<?php
ob_start();
session_start();
require 'header.php'
?>

<main>
		<div>
            <h1>Add admin</h1>
        </div>
        <?php

// ADDING ADMIN TO DATABASE
        if(isset($_POST['add_admin_btn']))
        {
// NEED TO ADD VALIDATION

            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $email = filter_var(strtolower($_POST['email']), FILTER_SANITIZE_EMAIL);
            $password = strip_tags($_POST['password']);

            // CHECKING IF FIELDS ARE EMPTY
            if(empty($name))
            {
                header('location: addAdmin.php?error=name cannot be empty');
            }
            if(empty($email))
            {
                header('location: addAdmin.php?error=email cannot be empty');
            }
            if(empty($password))
            {
                header('location: addAdmin.php?error=password cannot be empty');
            }
            if(strlen($password) < 8)
            {
                header('location: addAdmin.php?error=password must be at least 8 characters long');
            }

            // CHECKING IF EMAIL ALREADY EXIST
            $select_stmt = $pdo->prepare('SELECT name, email FROM assignment1.admin WHERE email= :email');
            $select_stmt->execute(['email' => $email]);
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

            if(isset($row['email']) == $email)
            {
                header('location: addAdmin.php?error=email already exist');
            }else
            {
                // HASHING PASSWORD
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $created = new DateTime();
                $created = $created->format('Y-m-d H:i:s');

                $add_admin_stmt = $pdo->prepare('INSERT INTO assignment1.admin (name, email, password, created) VALUES (:name, :email, :password, :created)');

                if($add_admin_stmt->execute([
                    'name' => $name,
                    'email' => $email,
                    'password' => $hashed_password,
                    'created' => $created
                ]))
                {
                    header('location: manageAdmins.php');
                }
            }
        }
        ?>

<form action="addAdmin.php" method="POST">
    <label for="name">Name</label>
    <input type="text" name="name" autocomplete="off">

    <label for="email">Email</label>
    <input type="email" name="email" autocomplete="off">

    <label for="password">Password</label>
    <input type="password" name="password" autocomplete="off">

    <input type="submit" name="add_admin_btn" value="Add admin">
</form>
</main>

<?php
require 'footer.php'
?>