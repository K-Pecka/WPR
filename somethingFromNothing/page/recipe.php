<?php
session_start();


$config = json_decode(file_get_contents('../config/config.json'));


require_once '../module/html.php';


?>
<DOCTYPE html>
	<html>

	<head>
		<?php echo $head; ?>
		<link rel="stylesheet" href="../style/recipe.css">
	</head>

	<body>
		<?php echo $nav; ?>
		<main id="content">
			<header>
				<?php echo $header ?>
			</header>
			<section id="recipe">

			</section>
		</main>
		<script src="https://cdn.jsdelivr.net/npm/handlebars@4.7.7/dist/handlebars.min.js"></script>
		<script src="../JS/fetch.js"></script>
		<script src="../JS/dark-mode.js"></script>
		<script src="../JS/nav.js"></script>
		<script src="../JS/menu.js"></script>
		<?php echo $footer; ?>
	</body>

	</html>