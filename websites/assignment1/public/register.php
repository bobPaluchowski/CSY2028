<?php
ob_start();
session_start();
require_once 'connection.php';

// $server = "mysql";
// $username = "student";
// $password = "student";
// $schema = "assignment1";

// $pdo = new PDO('mysql:host='.$server.';dbname:=$schema', $username, $password, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);


if(isset($_SESSION['user']))
{
    header(location: index.php);
}

// CHECKING IF REGISTER BTN WAS PRESSED
if(isset($_POST['register_btn']))
{
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var(strtolower($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = strip_tags($_POST['password']);

    // CHECKING IF FILEDS ARE EMPTY
    if(empty($name))
    {
        header('location: register.php?error=name cannot be empty');
    }
    if(empty($email))
    {
        header('location: register.php?error=email cannot be empty');
    }
    if(empty($password))
    {
        header('location: register.php?error=password cannot be empty');
    }
    if(strlen($password) < 8)
    {
        header('location: register.php?error=password must be at least 8 characters long');
    }

    // CHECKING IF EMAIL ALREADY EXIST
    $select_stmt = $pdo->prepare('SELECT name, email FROM assignment1.user WHERE email = :email');
    $select_stmt->execute(['email' => $email]);
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

    if(isset($row['email']) == $email)
    {
        header('location: register.php?error=email already exist');
    }else
    {
        // hashing password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $created = new DateTime();
        $created = $created->format('Y-m-d H:i:s');

        $insert_stmt = $pdo->prepare('INSERT INTO assignment1.user (name, email, password, created) VALUES (:name, :email, :password, :created)');

        if($insert_stmt->execute(
            [
                'name' => $name,
                'email' => $email,
                'password' => $hashed_password,
                'created' => $created
            ]
        ))
        {
            header('location: login.php');
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
		<header>
			<section>
				<h1>Northampton News</h1>
			</section>
		</header>
<main>
		<div>
            <h3>Register</h3>
            <form action="register.php" method="POST">

            <!-- DISPLAYING ERROR MESSAGE -->
                <?php if(isset($_GET['error'])) { ?>
                    <?=$_GET['error']?>
                    <!-- echo $_GET['error']; -->
                <?php } ?>

                <label for="name">Your name</label>
                <input type="text" name="name">

                <label for="email">Email</label>
                <input type="email" name="email">

                <label for="password">Password</label>
                <input type="password" name="password">

                <input type="submit" name="register_btn" value="Create account">
            </form>
        </div>
</main>

		<?php
require 'footer.php'
?>
