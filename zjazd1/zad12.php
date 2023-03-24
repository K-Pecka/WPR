<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>

<body>
	<form method="POST">
		<label>
			Liczba wierszy (A): <input type="number" name="rows" min="1" step="1" required>
		</label>
		<br>
		<label>
			Liczba wierszy (B): <input type="number" name="cols" min="1" step="1" required>
		</label>
		<br>
		<input type="submit">
	</form>
	<hr>
	<?php
	session_start();
	if (isset($_POST['rows']) && isset($_POST['cols'])) {

		if (!isset($_SESSION['count'])) {
			$_SESSION['rows'] = $_POST['rows'];
			$_SESSION['cols'] = $_POST['cols'];
		} else {
			$_SESSION['rows'] = $_POST['rows'] == $_SESSION['rows'] ? $_SESSION['rows'] : $_POST['rows'];
			$_SESSION['cols'] = $_POST['cols'] == $_SESSION['cols'] ? $_SESSION['cols'] : $_POST['cols'];
		}

		$rows = $_SESSION['rows'];
		$cols = $_SESSION['cols'];
		$input = "";
		for ($i = 0; $i < $rows; $i++) {
			for ($j = 0; $j < $cols; $j++) {
				$input .= "<input type='number' name='tab[$i][$j]' placeholder='wartość' required>";
			}
			$input .= "<br>";
		}
		echo "<form method='POST'>
				$input
				<input type='submit'>
				</form>";
	}
	if (isset($_POST['tab'])) {
		$arr = $_POST['tab'];
		echo "<h2>MACIERZ</h2>";
		for ($i = 0; $i < $_SESSION['rows']; $i++) {
			for ($j = 0; $j < $_SESSION['cols']; $j++) {
				echo $arr[$i][$j] . " ";
			}
			echo "<br>";
		}
		echo "<h2>TRANSPOZYCJA</h2>";
		for ($i = 0; $i < $_SESSION['cols']; $i++) {
			for ($j = 0; $j < $_SESSION['rows']; $j++) {
				echo $arr[$j][$i] . " ";
			}
			echo "<br>";
		}
	}
	?>
</body>

</html>