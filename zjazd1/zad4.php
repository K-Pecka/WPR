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
        <input type="number" name="a" step="0.1" required><br>
        <input type="number" name="b" step="0.1" required><br>
        <input type="submit">
    </form>
<?php
    if(isset($_POST['a']) && isset($_POST['b']))
    {
        $a=is_numeric($_POST['a']) ? $_POST['a'] : 1;
        $b=is_numeric($_POST['b']) ? $_POST['b'] : 1;
        echo 
        "<br>".$a." + ".$b." = ".($a + $b).
        "<br>".$a." - ".$b." = ".($a - $b).
        "<br>".$a." * ".$b." = ".($a * $b).
        "<br>".$a." % ".$b." = ".($b == 0 ? "<span style='color:red'>BŁĄD</span>" : $a % $b);
    }
?>
</body>
</html>