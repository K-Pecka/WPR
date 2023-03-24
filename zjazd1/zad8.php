<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <label>
            Wartość 1: <input type="number" name="a" step="0.01" required>
        </label>
        <br>
        <label>
            Wartość 2: <input type="number" name="b" step="0.01" required>
        </label>
        <br>
        <label>
            Wartość 3: <input type="number" name="c" step="0.01" required>
        </label>
        <br>
        <input type="submit">
        <br><br>
    </form>
    <?php
    if (isset($_POST['a']) && isset($_POST['b']) && isset($_POST['c'])) {
        $a = is_numeric($_POST['a']) ? $_POST['a'] : null;
        $b = is_numeric($_POST['b']) ? $_POST['b'] : null;
        $c = is_numeric($_POST['c']) ? $_POST['c'] : null;
        if ($a != null && $b != null && $c != null) {
            if (max($a, $b, $c) == $a) {
                echo $b > $c ? $c . " ≤ " . $b . " ≤ " . $a : $b . " ≤ " . $c . " ≤ " . $a;
                echo "<br>";
                echo $b > $c ? $a . " ≥ " . $b . " ≥ " . $c : $a . " ≥ " . $c . " ≥ " . $b;
            } else
            if (max($a, $b, $c) == $b) {
                echo $c > $a ? $a . " ≤ " . $c . " ≤ " . $b : $c . " ≤ " . $a . " ≤ " . $b;
                echo "<br>";
                echo $c > $a ? $b . " ≥ " . $c . " ≥ " . $a : $b . " ≥ " . $a . " ≥ " . $c;
            } else
            if (max($a, $b, $c) == $c) {
                echo $a > $b ? $b . " ≤ " . $a . " ≤ " . $c : $a . " ≤ " . $b . " ≤ " . $c;
                echo "<br>";
                echo $a > $b ? $c . " ≥ " . $a . " ≥ " . $b : $c . " ≥ " . $b . " ≥ " . $a;
            }
        }
    }
    ?>
</body>

</html>