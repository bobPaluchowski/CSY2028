<?php
ob_start();
session_start();
require 'header.php'
?>
<img src="images/banners/randombanner.php" alt="Uni" />
		<main>
			<!-- IN MAIN DISPLAY 10 RECENT ARTICLES -->
			
			<?php
			
				// echo 'Welcome '.$_SESSION['name'];

				$stmt = $pdo->prepare('SELECT * FROM assignment1.article ORDER BY publishDate ASC LIMIT 10');
				$stmt->execute();

				foreach($stmt as $row)
				{
					$date = new DateTime($row['publishDate']);
					echo '<br><h3>'.$row['title'].'</h3><br>';
					echo '<p>'.$row['content'].'</p>';
					echo '<p>'.$row['categoryId'].'</p>';// DELETE LATER
					echo '<em>'.$date->format('Y-m-d H:i').'</em>';
				}
			

			?>

		</main>



<?php
require 'footer.php'
?>