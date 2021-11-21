<?php
ob_start();
session_start();
require_once 'connection.php';

// $server = "mysql";
// $username = "student";
// $password = "student";
// $schema = "assignment1";

// $pdo = new PDO('mysql:host='.$server.';dbname:=$schema', $username, $password, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);

// USER LOGIN
// IF LOGIN BTN HAS BEEN PRESSED
if(isset($_POST['login_btn']))
{
    $email = filter_var(strtolower($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password =strip_tags($_POST['password']);

    // CHECKING IF ALL FIELDS ARE FILLED
    if(empty($email))
    {
        header('location: login.php?error=email cannot be empty');
    }
    if(empty($password))
    {
        header('location: login.php?error=password cannot be empty');
    }

    //DATABASE QUERY
    $select_stmt = $pdo->prepare('SELECT * FROM assignment1.user WHERE email = :email LIMIT 1');
    $select_stmt->execute([
        ':email' => $email// IF EMAILS MATCH, PULL DATE IN
    ]);

    // CHECKING IF PASSWORD AND EMAIL MATCH DATABASE
    foreach($select_stmt as $row)
    {
        if($_POST['email'] == $row['email'] && password_verify($_POST['password'], $row['password']))
        {
            $_SESSION['name'] = $row['name'];
            
            header('location: index.php');
        }else{
            header('location: login.php?error=Wrong email or pasword');
        }
    }

}

// ADMIN LOGIN
// ONE ADMIN REGISTERED AS admin, password: adminadmin, email: admin@test.com
// IF LOGIN BTN HAS BEEN PRESSED
if(isset($_POST['admin_login_btn']))
{
    $email = filter_var(strtolower($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password =strip_tags($_POST['password']);

    // CHECKING IF ALL FIELDS ARE FILLED
    if(empty($email))
    {
        header('location: login.php?error=email cannot be empty');
    }
    if(empty($password))
    {
        header('location: login.php?error=password cannot be empty');
    }

    //DATABASE QUERY
    $select_stmt = $pdo->prepare('SELECT * FROM assignment1.admin WHERE email = :email LIMIT 1');
    $select_stmt->execute([
        ':email' => $email// IF EMAILS MATCH, PULL DATE IN
    ]);

    // CHECKING IF PASSWORD AND EMAIL MATCH DATABASE
    foreach($select_stmt as $row)
    {
        if($_POST['email'] == $row['email'] && password_verify($_POST['password'], $row['password']))
        {
            $_SESSION['name'] = $row['name'];
            
            header('location: admin.php');
        }else{
            header('location: login.php?error=Wrong email or pasword');
        }
    }

}

?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="styles.css"/>
		<title>Northampton News - Home</title>
	</head>
	<body>
		<main>
            <h3>Login</h3>
        <form action="login.php" method="POST">

        <!-- DISPLAYING ERROR MESSAGE -->
                <?php if(isset($_GET['error'])) { ?>
                    <?=$_GET['error']?>
                <?php } ?>
            <label for="email">Email</label>
            <input type="email" name="email">

            <label for="password">Password</label>
            <input type="password" name="password">

            <input type="submit" name="login_btn" value="Login"><br>
            <br>
            <input type="submit" name="admin_login_btn" value="Login as admin"><br>
        </form>
        
        No Account? <a href="register.php">Register Instead</a>
</main>

		<?php
require 'footer.php'
?>
