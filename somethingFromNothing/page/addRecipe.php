<?php
session_start();
require_once '../module/setPage.php';

if (!isset($nav) || !isset($head) || !isset($footer) || !isset($footer)) {
	header('Location: error.php');
}
if (!isset($_SESSION['id'])) {
	header('Location: /');
}
?>
<DOCTYPE html>
	<html>

	<head>
		<?php echo $head; ?>
		<script src="../JS/module.js" defer></script>
		<link rel="stylesheet" href="../style/addRecipe.css">
	</head>

	<body>
		<?php echo $nav; ?>
		<main id="content">
			<header>
				<?php echo $header ?>
			</header>
			<section id="recipe">
				<div class="recipe">
					<div class="image">
						<p>dodaj zdjęcie</p>
					</div>
					<div class="details">
						<h2><input type="text" name="title"></h2>
						<button class="open-modal-btn">Dodaj Opis</button>
						<div class="description" name="description">
						</div>
						<div class="ingredients">
							<h3>Składniki:</h3>
							<ul class="ingredients">
							</ul>
							<button id="addIngridient" class="open-modal-btn">dodaj składnik</button>
						</div>
					</div>
					<div class="instructions">
						<h3>Instrukcje:</h3>
						<ul class="ingredients">

						</ul>
						<div>Dodaj instrukcje</div>
					</div>
				</div>
			</section>
		</main>

		<?php echo $footer; ?>
	</body>
	<div id="modalDescription" class="modal">
		<div class="modal-content fade-in">
			<span class="close">&times;</span>
			<h2>Podaj opis potrawy</h2>
			<textarea placeholder="Podaj opis" class="content"></textarea>
			<button class="addToAdd">Dodaj</button>
		</div>
	</div>
	<div id="modalIngredients" class="modal">
		<div class="modal-content fade-in">
			<span class="close">&times;</span>
			<h2>Wybierz składniki</h2>
			<div class="ingredients-grid" id="addIng">
			</div>
			<button class="addToAdd">Dodaj</button>
		</div>
	</div>

	<script id="ingredient-template" type="text/x-handlebars-template">
		<div class="ingredient-box">
			<div class="ingredient-tile">
				<label>
					<input type="checkbox" value="{{id}}">
					{{name}} </label>
			</div>
		</div>
	
	</script>

	</html>