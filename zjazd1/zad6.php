<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <label>Podaj dł. a: <input type="number" name="a" step="0.01" required></label><br>
        <label>Podaj dł. b: <input type="number" name="b" step="0.01" required></label><br>
        <label>Podaj dł. c: <input type="number" name="c" step="0.01" required></label> <br>
        <input type="submit">
    </form>
    <?php
    if (isset($_POST['a']) && isset($_POST['b']) && isset($_POST['c'])) {
        $a = is_numeric($_POST['a']) && $_POST['a'] > 0 ? $_POST['a'] : null;
        $b = is_numeric($_POST['b']) && $_POST['b'] > 0 ? $_POST['b'] : null;
        $c = is_numeric($_POST['c']) && $_POST['c'] > 0 ? $_POST['c'] : null;
        if ($a && $b && $c) {
            echo $a + $b > $c && $a + $c > $b && $b + $c > $a ? "TRUE" : "FALSE";
        } else {
            echo "BŁĄD";
        }
    }
    ?>
</body>

</html>