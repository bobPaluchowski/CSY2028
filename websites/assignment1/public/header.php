<?php
ob_start();
require 'connection.php';
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
		<nav>
			<ul>
				<li><a href="index.php">Latest Articles</a></li>
				<li><a href="">Select Category</a>
					<ul>
						<?php
						$stmt = $pdo->prepare('SELECT * FROM assignment1.category');
						$stmt->execute();
						foreach($stmt as $row){
							echo '<li><a class="articleLink" href="displayCategory.php?name='.$row['name'].'">'.$row['name'].'</a></li>';
						}
						
						?>
					</ul>
				
				
				

				<?php
					if(isset($_SESSION['name']))
					{
						echo 'Hello, '.$_SESSION['name'];
						echo '<li><a href="logout.php">Logout</a></li>';
					}else
					{
						echo '<li><a href="login.php">Login</a></li>';
						echo '<li><a href="register.php">Sign up</a></li>';
					}
				?>
			</ul>
		</nav>
