<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <label>
            Podaj jak duży ma być wzór:<input type="number" name="a" required>
        </label><br>
        <input type="submit">
    </form>
    <?php
    if (isset($_POST['a'])) {

        $a = is_numeric($_POST['a']) && $_POST['a'] > 0 ? $_POST['a'] : null;
        if ($a) {
            echo "<pre>";
            for ($i = 0; $i <= $a; $i++) {
                echo str_repeat("*", $i) . "\n";
            }
            for ($i = $a; $i > 0; $i--) {
                echo str_repeat("*", $i) . "\n";
            }
            for ($i = 0; $i < $a; $i++) {
                echo str_repeat(" ", $i) . str_repeat("*", $a - $i) . "\n";
            }
            for ($i = $a - 1; $i >= 0; $i--) {
                echo str_repeat(" ", $i) . str_repeat("*", $a - $i) . "\n";
            }
            echo "</pre>";
        } else {
            echo "BŁĄD";
        }
    }
    ?>
</body>

</html>