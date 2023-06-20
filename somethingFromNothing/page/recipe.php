<?php
session_start();
require_once '../module/setPage.php';

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
			<section>
				<section id="comment">
					<h2>Comments</h2>
					<form id="comment-form" method="POST">
						<div class="comment-author">
							<img class="comment-avatar" src="{{avatar}}" alt="User Avatar">
							<h4></h4>
						</div>
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
			</section>

		</main>
		<?php echo $footer; ?>
	</body>

	</html>