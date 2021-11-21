<?php
ob_start();
session_start();
require 'header.php'
?>

<!-- MAKE IT LOOK NICER -->
<main>
<h1>welcom to admin page</h1>
<a href="adminArticles.php"><button name="namage_articles_btn">Manage articles</button></a>

<a href="adminCategories.php"><button name="namage_articles_btn">Manage categories</button></a>
<a href="manageAdmins.php"><button name="namage_admins_btn">Manage admins</button></a>
</main>

<?php
require 'footer.php'
?>