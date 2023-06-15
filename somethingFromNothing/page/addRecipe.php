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
		<script src="../JS/addRecipe.js" defer></script>
		<style>
			.image {
				height: 400px;
				max-width: 100%;
				max-height: 400px;
				border: 1px solid #ccc;
				margin-bottom: 20px;
				display: flex;
				justify-content: center;
				align-items: center;
				padding-top: 0;
			}

			.image input[type="file"] {
				display: none;
			}

			.image label {
				position: relative;
				z-index: 10;
				cursor: pointer;
				padding: 10px 20px;
				background-color: #337ab7;
				color: #fff;
				border-radius: 5px;
			}

			.image label:hover {
				background-color: #286090;
			}

			.image label:active {
				background-color: #204d74;
			}

			.image label:focus {
				outline: none;
			}

			.image:hover {
				width: 100%;
			}

			input[name="title"] {
				padding: 1%;
				width: 100%;
				font-weight: bold;
			}

			.checked {
				border: 1px solid green;
			}

			#modalPreparation {
				overflow: auto;
			}

			#modalPreparation textarea {
				height: 20%;
			}
		</style>
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
						<label>
							Dodaj zdjęcie
							<input type="file" accept=".jpg,.png" capture="user environment">
						</label>
						<div></div>
					</div>
					<div class="details">
						Tytuł:<input type="text" name="title">
						Opis:
						<div class="description" name="description">
							<div class="addToAddDescription"></div>
							<button class="open-modal-btn-description">Dodaj Opis</button>
						</div>
						<div class="ingredients">
							<h3>Składniki:</h3>
							<table class="ingredients">
							</table>
							<button id="addIngridient" class="open-modal-btn">dodaj składnik</button>
						</div>
					</div>
					<div class="instructions">
						<h3>Instrukcje:</h3>
						<ul class="instruction">

						</ul>
						<button id="addPreparation" class="open-modal-btn-preparation">dodaj składnik</button>
					</div>
				</div>
			</section>
		</main>

		<?php echo $footer; ?>
	</body>
	<div id="modal-description" class="modal">
		<div class="modal-content fade-in">
			<span class="close">&times;</span>
			<h2>Podaj opis potrawy</h2>
			<textarea placeholder="Podaj opis" class="content"></textarea>
			<button class="addToAdd-btn">Dodaj</button>
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
	<div id="modalPreparation" class="modal">
		<div class="modal-content fade-in">
			<span class="close">&times;</span>
			<h2>dodaj etapy przygotowania potrawy</h2>
			<ol>
				<li>
					<span>Czas przygotowania: <input type="number" type="time">min</span>
					<textarea placeholder="Podaj opis" class="content"></textarea>
				</li>
			</ol>
			<button class="addToAdd-btn">Dodaj</button>
		</div>
	</div>
	<script id="ingredient-template" type="text/x-handlebars-template">
		<div class="ingredient-box">
			<label>
			<div class="ingredient-tile">
					<input type="checkbox" value="{{id}}" data-name={{name}}>
					{{name}} 
			</div>
			</label>
		</div>
	
	</script>

	</html>