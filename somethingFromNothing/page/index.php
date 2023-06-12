<?php
session_start();
$config = json_decode(file_get_contents('../config/config.json'));

require_once '../module/html.php';
if (!isset($nav) || !isset($head) || !isset($footer) || !isset($footer)) {
	header('Location: error.php');
}
?>
<DOCTYPE html>
	<html>

	<head>
		<?php echo $head; ?>
	</head>

	<body>
		<?php echo $nav; ?>
		<main id="content">
			<header>
				<?php echo $header ?>
			</header>
			<!--section id="ingredients">
				<h2 class="section-title">Składniki</h2>
				<div id="addIngredients">
					<div id="search">
						<input>
					</div>
					<ol id="ingredientList"></ol>
				</div>
			</section>
			<section-- id="sort">
				<h2>Przepisy</h2>
				<div class="sorting-methods">
					<label for="sortMethod">Sortuj według:</label>
					<select id="sortMethod">
						<option value="name">Nazwa</option>
						<option value="time">Czas przygotowania</option>
						<option value="difficulty">Stopień trudności</option>
					</select>
				</div>
				<div class="slider-container">
					<label class="slider-label">Średnia ilość ocen:</label>
					<input type="range" min="0" max="10000" value="0" class="slider" id="ratingSlider">
					<span class="slider-value" id="ratingValue">0</span>
				</div>
				<div class="slider-container">
					<label class="slider-label">Średnia ocen i ilość składników:</label>
					<div class="star-ratings">
						<input type="radio" name="rating" id="rating-1">
						<label for="rating-1"></label>

						<input type="radio" name="rating" id="rating-2">
						<label for="rating-2"></label>

						<input type="radio" name="rating" id="rating-3">
						<label for="rating-3"></label>

						<input type="radio" name="rating" id="rating-4">
						<label for="rating-4"></label>

						<input type="radio" name="rating" id="rating-5">
						<label for="rating-5"></label>
					</div>
				</div>
			</section-->
			<section id="recipes">
			</section>

		</main>
		<?php var_dump($_SESSION);
		echo $footer; ?>
	</body>

	</html>