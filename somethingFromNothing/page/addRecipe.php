<?php
session_start();
require_once '../module/setPage.php';
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
				color: #666;
				padding: 1%;
				width: 100%;
				font-weight: bold;
				width: 3em;
				font-size: 1.5em;
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



			body {
				font-family: Arial, sans-serif;
			}

			h3 {
				margin-top: 0;
			}

			/* Sekcja przepisu */
			#recipe {
				margin: 0 auto;
				padding: 20px;
			}

			.recipe {
				background-color: #f9f9f9;
				padding: 20px;
				border-radius: 8px;
				box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
			}

			/* Zdjęcie */
			.image {
				text-align: center;
				margin-bottom: 20px;
			}

			.image label {
				display: block;
				color: #666;
				font-size: 14px;
				margin-bottom: 10px;
				cursor: pointer;
			}

			.image input[type="file"] {
				display: none;
			}

			.details {
				margin-bottom: 20px;
			}

			.details input[type="text"] {
				width: 100%;
				padding: 5px;
				border: 1px solid #ccc;
				border-radius: 4px;
				margin-bottom: 10px;
			}

			.description {
				border: 1px solid #ccc;
				border-radius: 4px;
				padding: 5px;
				margin-bottom: 10px;
				width: 100%;
				min-height: 2em;
			}

			.description .addToAddDescription {
				cursor: pointer;
				color: #666;
				text-align: justify;
			}

			.ingredient {
				width: 100%;
				margin-bottom: 5%;
				display: grid;
				grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
				gap: 20px;
			}

			.ingredients {
				width: 100%;
			}

			.ingredient-row {
				display: flex;
				align-items: center;
				margin-bottom: 10px;
			}

			.ingredient-row span {
				font-weight: bold;
				margin-right: 10px;
			}

			.ingredient-row input,
			.ingredient-row select {
				padding: 5px;
				border: 1px solid #ccc;
			}

			.ingredient-row select {
				width: 100px;
			}


			.ingredients input[name="value"] {
				width: 50px;
				text-align: center;
			}

			.instructions {
				margin-bottom: 20px;
			}

			.instructions ul {
				padding-left: 20px;
				margin-bottom: 10px;
			}

			.instructions ul li {
				margin-bottom: 5px;
			}

			.instructions ul li p {
				display: inline;
			}

			.instructions ul li span {
				font-weight: bold;
				margin-left: 10px;
			}

			/* Przyciski */
			button {
				background-color: #4CAF50;
				color: #fff;
				border: none;
				padding: 10px 20px;
				border-radius: 4px;
				cursor: pointer;
				margin-top: 10px;
				align-self: flex-end;
			}

			.open-modal-btn {
				margin-top: 10px;
			}

			/* Wykorzystanie flexbox dla przycisków */
			.details,
			.ingredients,
			.instructions {
				width: 100%;
				display: flex;
				justify-content: space-between;
				align-items: flex-start;
				flex-wrap: wrap;
				flex-direction: column;
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
							<div class="addToAddDescription">Kliknij przycisk i dodaj opis</div>
						</div>
						<button class="open-modal-btn-description">Dodaj Opis</button>
						<div class="ingredients">
							<h3>Składniki:</h3>
							<div class="ingredient">
								<div class="ingredient-row">
									<span>Makaron</span>
									<div><input name="value"></div>
									<div><Select>
											<option>OK</option>
										</Select>
									</div>
								</div>
								<div class="ingredient-row">
									<span>Makaron</span>
									<div><input name="value"></div>
									<div><Select>
											<option>OK</option>
										</Select>
									</div>
								</div>
								<div class="ingredient-row">
									<span>Makaron</span>
									<div><input name="value"></div>
									<div><Select>
											<option>OK</option>
										</Select>
									</div>
								</div>
								<div class="ingredient-row">
									<span>Makaron</span>
									<div><input name="value"></div>
									<div><Select>
											<option>OK</option>
										</Select>
									</div>
								</div>
								<div class="ingredient-row">
									<span>Makaron</span>
									<div><input name="value"></div>
									<div><Select>
											<option>OK</option>
										</Select>
									</div>
								</div>
								<div class="ingredient-row">
									<span>Makaron</span>
									<div><input name="value"></div>
									<div><Select>
											<option>OK</option>
										</Select>
									</div>
								</div>
							</div>
							<button id="addIngridient" class="open-modal-btn">dodaj składnik</button>
						</div>
					</div>
					<div class="instructions">
						<h3>Instrukcje:</h3>
						<ul class="instruction">
							<li>
								<p>Przygotuj</p><span>5 min</span>
							</li>
						</ul>
						<button id="addPreparation" class="open-modal-btn-preparation">dodaj składnik</button>
					</div>
					<button id="addRecipe">Dodaj Przepis</button>
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