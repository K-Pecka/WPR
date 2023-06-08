<?php
session_start();

$_SESSION['id'] = 1;

$config = json_decode(file_get_contents('../config/config.json'));

require_once '../module/html.php';
if (!isset($nav) || !isset($head) || !isset($footer)) {
	//header('Location: error.php');
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
				<div>
					<h1>Kulinarna Magia z Kliku składników</h1>
					<p>Daj się porwać w wir gotowania i odkryj, jak zamienić codzienne składniki z lodówki w wyjątkowe kulinaria. Zaskocz swoje podniebienie, eksperymentując z prostymi przepisami, które nie wymagają skomplikowanych technik ani długiego czasu gotowania. Nasze przepisy płyną prosto z społeczności osób, które cenią sobie łatwość i chcą się podzielić wyczarowanymi smakowitymi arcydziełami.</p>
					<p>Zapomnij o skomplikowanych przepisach i długiej liście zakupów. Dzięki naszym wskazówkom i pomysłom na wykorzystanie dostępnych składników w Twojej lodówce, każdy posiłek stanie się niezwykłą ucztą. Od chwilowego zastrzyku energii w postaci pysznego smoothie po kremowe zupy, soczyste sałatki i wykwintne dania główne - wszystko to możesz zrobić z prostych składników, które już posiadasz.</p>
				</div>

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
		<?php echo $footer; ?>
	</body>
	<script id="recipe-template" type="text/x-handlebars-template">
		<div class="recipe" data-id="{{id}}">
			<div class="image"><img src="../image/recipe/{{image}}" alt="{{title}}"></div>
			<div class="title">{{title}}</div>
			<div class="rating">
				<div class="stars">
					{{#each rating}}
					<span>{{this}}</span>
					{{/each}}
				</div>
				<div class="reviews">{{review}}</div>
			</div>
			<div class="time">Czas przygotowania: {{time}} min</div>
			<div class="discription">
				{{description}}
			</div>
  		</div>
	</script>

	</html>