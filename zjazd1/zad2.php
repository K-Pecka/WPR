<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <label>
            Długość a: <input type="number" name="a" step="0.01" required>
        </label>
        <br>
        <label>
            Długość b: <input type="number" name="b" step="0.01" required>
        </label>
        <br>
        <input type="submit">
    </form>
    <?php
    if (isset($_POST['a']) && isset($_POST['b'])) {
        $a = is_numeric($_POST['a']) && $_POST['a'] > 0 ? $_POST['a'] : null;
        $b = is_numeric($_POST['b']) && $_POST['b'] > 0 ? $_POST['b'] : null;
        if ($a != null && $b != null) {
            echo "<br>P = " . $a . " * " . $b . " = " . $a * $b;
        } else {
            echo "BŁĄD";
        }
    }
    ?>
</body>

</html>