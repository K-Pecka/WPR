<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <input type="number" name="a"><br>
        <input type="number" name="b"><br>
        <input type="number" name="c"><br>
        <input type="submit">
    </form>
    <?php
    if (isset($_POST['a']) && isset($_POST['b']) && isset($_POST['c'])) {
        $a = is_numeric($_POST['a']) ? $_POST['a'] : 1;
        $b = is_numeric($_POST['b']) ? $_POST['b'] : 1;
        $c = is_numeric($_POST['c']) ? $_POST['c'] : 1;
        echo "<br>";
        if ($a >= $b && $a >= $c) {
            echo $a . " ≥ ";
            echo $b >= $c ? $b . " ≥ " . $c : $c . " ≥ " . $b;
        } else
        if ($b >= $c && $b >= $a) {
            echo $b . " ≥ ";
            echo $a >= $c ? $a . " ≥ " . $c : $c . " ≥ " . $a;
        } else
        if ($c >= $b && $c >= $a) {
            echo $c . " ≥ ";
            echo $b >= $a ? $b . " ≥ " . $a : $a . " ≥ " . $b;
        }
    }
    ?>
</body>

</html>