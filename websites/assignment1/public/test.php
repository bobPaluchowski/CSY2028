<img src="images/banners/randombanner.php" />
		<main>
			<!-- Delete the <nav> element if the sidebar is not required -->
			<nav>
				<ul>
					<li><a href="#">Sidebar</a></li>
					<li><a href="#">This can</a></li>
					<li><a href="#">Be removed</a></li>
					<li><a href="#">When not needed</a></li>
				</ul>
			</nav>

			<article>
				<h2>A Page Heading</h2>
				<p>Text goes in paragraphs</p>

				<ul>
					<li>This is a list</li>
					<li>With multiple</li>
					<li>List items</li>
				</ul>


				<form>
					<p>Forms are styled like so:</p>

					<label>Field 1</label> <input type="text" />
					<label>Field 2</label> <input type="text" />
					<label>Textarea</label> <textarea></textarea>

					<input type="submit" name="submit" value="Submit" />
				</form>
			</article>
		</main>

		<!-- first attempt -->

		<?php


// CHECKING WHETHER SUBMIT BUTTON WAS PRESSED
if(isset($_POST['submit']))
{
    $stmt = $pdo->prepare('INSERT INTO assignment1.user (firstName, lastName, email, password, userType) VALUES (:firstName, :lastName, :email, :password, :userType)');

    $values = [
        'firstName' => $_POST['firstName'],
        'lastName' => $_POST['lastName'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
		'userType' => $_POST['userType']
    ];

    $stmt->execute($values);
    header('location: index.php');
    
}else
{
    ?>
    <form action="index.php" method="POST">
        <label>First name</label>
        <input type="text" name="firstName"/>

        <label>Surname</label>
        <input type="text" name="lastName"/>
		
        <label>Email</label>
        <input type="text" name="email"/>

        <label>Password</label>
        <input type="text" name="password"/>

		<select name="userType">
			<option selected value="user">User</option>
			<option value="admin">Admin</option>
		</select>

        <input type="submit" name="submit" value="Go Ahead"/>
    </form>
<?php
}
?>
// FROM displayArticle.php
<main>

<?php

if(isset($_GET['articleId'])){
// DISPLAYING A SINGLE ARTICLE

$articleId = $_GET['articleId'];
$stmt = $pdo->prepare('SELECT * FROM assignment1.article WHERE articleId= :articleId');
$values = ['articleId' => $articleId];
$stmt->execute($values);
$article = $stmt->fetch(PDO::FETCH_ASSOC);

echo '<div>';
	$date = new DateTime($article['publishDate']);
	echo '<h1>'.$article['title'].'</h1>';
	echo '<p>'.$article['content'].'</p>';
	echo '<em>'.$date->format('Y-m-d H:i').'</em>';
	echo '</div>';

	// DISPLAYING COMMENTS FOR THIS ARTICLE
$comment_stmt = $pdo->prepare('SELECT * FROM assignment1.comment WHERE articleId= :articleId');
$comment_values = ['articleId' => $articleId];
$comment_stmt->execute($comment_values);

echo '<h3>Comments</h3>';
foreach($comment_stmt as $row)
{
echo '<div>';
echo '<ul>';
echo '<li>'.$row['content'].'</li>';
echo '<p>'.$row['author'].'</p>';
echo '</ul>';
echo '</div>';
}
// PROCESSING AND ADDING COMMENT FROM THIS PAGE
if(isset($_POST['comment_btn']))
{

$add_comment_stmt = $pdo->prepare('INSERT INTO assignment1.comment (author, content, articleId) VALUES (:author, :content, :articleId)');
$values = [
	'author' => $_SESSION['name'],
	'content' => $_POST['comment'],
	'articleId' => $_GET['articleId']
];

$add_comment_stmt->execute($values);
header('location: displayArticle.php?aricleId='.$_GET['articleId']);
}
}else{
?>
<form action="displayArticle.php?aricleId=<? echo $_GET['articleId']?>" method="POST">
<label for="comment">Comment here</label>
<input type="textarea" name="comment" autocomplete="off">
<input type="submit" name="comment_btn" value="comment">
</form>
<?php
}
?>



 </main>