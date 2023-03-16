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
        <input type="number" name="a" required><br>
        <input type="number" name="b" required><br>
        <input type="number" name="c" required><br>
        <input type="submit">
    </form>
    <?php
    if (isset($_POST['a']) && isset($_POST['b']) && isset($_POST['c'])) {
        $a = is_numeric($_POST['a']) ? $_POST['a'] : null;
        $b = is_numeric($_POST['b']) ? $_POST['b'] : null;
        $c = is_numeric($_POST['c']) ? $_POST['c'] : null;
        echo "<br>";
        if($a == null || $b == null || $c == null)
        {
            echo "BŁĄD";
        }else
        if ($a >= $b && $a >= $c) {
            echo $b >= $c ? $a . " ≥ ".$b . " ≥ " . $c : $a . " ≥ ".$c . " ≥ " . $b;
            echo "<br>";
            echo $b >= $c ? $c . " ≤ ".$b . " ≤ " . $a : $b . " ≤ ".$c . " ≤ " . $a;
        } else
        if ($b >= $c && $b >= $a) {
            echo $a >= $c ? $b . " ≥ ".$a . " ≥ " . $c : $b . " ≥ ".$c . " ≥ " . $a;
            echo "<br>";
            echo $a >= $c ? $c . " ≤ ".$a . " ≤ " . $b : $a . " ≤ ".$c . " ≤ " . $b;
        } else
        if ($c >= $b && $c >= $a) {
            echo $b >= $a ? $c . " ≥ ".$b . " ≥ ".$a : $c." ≥ ".$a . " ≥ " . $b;
            echo "<br>";
            echo $b >= $a ? $a . " ≤ ".$b . " ≤ ".$c : $b." ≤ ".$a . " ≤ " . $c;
        }
    }
    ?>
</body>

</html>