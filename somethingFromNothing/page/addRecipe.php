<?php
$config = json_decode(file_get_contents('../config/config.json'));

require_once '../module/nav.php';
require_once '../module/head.php';
require_once '../module/footer.php';

session_start();

$_SESSION['id'] = 1;
$addRecipe = isset($_SESSION['id']) ? "<a href=\"" . $config->path->addRecipePath . "\" target=\"_blank\"><img src=\"../image/icon/add.png\" class=\"icon\"\"></a>" : "";

$head = str_replace("{{banner_IMG}}", "../" . $config->mainIcon, $head);
$head = str_replace("{{TITLE}}", $config->title, $head);

$nav = str_replace("{{ADD_RECIPE}}", $addRecipe, $nav);
$nav = str_replace("{{banner_IMG}}", "../" . $config->mainIcon, $nav);

?>
<DOCTYPE html>
	<html>

	<head>
		<?php echo $head; ?>
		<link rel="stylesheet" href="../style/style.css">
		<link rel="stylesheet" href="../style/media.css">
		<link rel="stylesheet" href="../style/footer.css">
		<link rel="stylesheet" href="../style/nav.css">
		<link rel="stylesheet" href="../style/recipe.css">
		<link rel="stylesheet" href="../style/addRecipe.css">
	</head>

	<body>
		<?php echo $nav; ?>
		<main id="content">
			<header>
				<div>
					<h1>Kulinarna Magia z Kliku składników</h1>
					<p>Daj się porwać w wir gotowania i odkryj, jak zamienić codzienne składniki z lodówki w wyjątkowe kulinaria. Zaskocz swoje podniebienie, eksperymentując z prostymi przepisami, które nie wymagają skomplikowanych technik ani długiego czasu gotowania. Nasze przepisy płyną prosto z społeczności osób, które cenią sobie łatwość i chcą się podzielić wyczarowanymi smakowitymi arcydziełami.</p>
					<p>Zapomnij o skomplikowanych przepisach i długiej liście zakupów. Dzięki naszym wskazówkom i pomysłom na wykorzystanie dostępnych składników w Twojej lodówce, każdy posiłek stanie się niezwykłą ucztą. Od chwilowego zastrzyku energii w postaci pysznego smoothie po kremowe zupy, soczyste sałatki i wykwintne dania główne - wszystko to możesz zrobić z prostych składników, które już posiadasz.</p>
				</div>

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
				<div>
					<div class="ingredient-tile">
						<label>
							<input type="checkbox" data-id="{{id}}">
							this</label>
					</div>
				</div>

			</div>
			<button class="addToAdd">Dodaj</button>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/handlebars@4.7.7/dist/handlebars.min.js"></script>

	<script src="../JS/fetch.js"></script>
	<script src="../JS/dark-mode.js"></script>
	<script src="../JS/nav.js"></script>
	<script src="../JS/menu.js"></script>
	<script src="../JS/module.js"></script>

	<script id="ingredient-template" type="text/x-handlebars-template">
		<div>
			<div class="ingredient-tile">
				<label>
					<input type="checkbox" value="{{id}}">
					{{name}} </label>
			</div>
		</div>
	
	</script>

	</html>