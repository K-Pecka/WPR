<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <label>
            Wartość a: <input type="number" name="a" required>
        </label>
        <br>
        <label>
            Wartość b: <input type="number" name="b" required>
        </label>
        <br>
        <input type="submit">
    </form>
    <?php
    if (isset($_POST['a']) && isset($_POST['b'])) {
        $a = is_numeric($_POST['a']) ? $_POST['a'] : null;
        $b = is_numeric($_POST['b']) ? $_POST['b'] : null;
        echo
        "<br>" . $a . " + " . $b . " = " . ($a + $b) .
            "<br>" . $a . " - " . $b . " = " . ($a - $b) .
            "<br>" . $a . " * " . $b . " = " . ($a * $b) .
            "<br>" . $a . " % " . $b . " = ";
        try {
            if (!$a || !$b) {
                throw new Exception("<span style='color:red'>BŁĄD</span>");
            }
            if ($b == 0) {
                throw new Exception("<span style='color:red'>BŁĄD</span>");
            }
            echo $a % $b;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    ?>
</body>

</html>