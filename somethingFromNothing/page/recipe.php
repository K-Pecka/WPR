<?php
session_start();

$_SESSION['id'] = 1;

$config = json_decode(file_get_contents('../config/config.json'));


require_once '../module/html.php';


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
	<script id="recipe-template" type="text/x-handlebars-template">
		<div class="recipe">
					<div class="image">
						<img src="../image/recipe/{{image}}" alt="Przepis">
					</div>
					<div class="details">
						<h2>{{title}}</h2>
						<div class="rating">
							<div class="stars">
								{{#each rating}}
								<span>{{this}}</span>
								{{/each}}
							</div>
							<span class="reviews">({{review}} ocen)</span>
						</div>
						<div class="description">{{description}}</div>
						<p class="time">Czas gotowania: {{time}} minut</p>
						<div class="ingredients">
							<h3>Składniki:</h3>
							<ul class="ingredients">
								{{#each ingridients}}
								<li>{{this}}</li>
								{{/each}}
							</ul>
						</div>
					</div>
					<div class="instructions">
							<h3>Instrukcje:</h3>
							<ul class="ingredients">
								{{#each preparations}}
								<li>{{description}} - {{time}} minutes</li>
								{{/each}}
							</ul>
						</div>
				</div>
	</script>

	</html>