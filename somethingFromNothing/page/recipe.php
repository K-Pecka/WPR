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
			<section id="comment">
				<h2>Comments</h2>
				<form id="comment-form" method="POST">
					<div>
						<label for="name">Name:</label>
						<input type="text" id="name" name="name" required>
					</div>
					<div>
						<label for="content">Content:</label>
						<textarea id="content" name="content" required></textarea>
					</div>
					<div>
						<button type="submit">Add Comment</button>
					</div>
				</form>
				<div id="comments">

				</div>
			</section>
			<section id="recommended">
				
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