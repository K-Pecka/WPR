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
    <input type="text" name="a"><br>
    <input type="submit">
</form>
<?php
if (isset($_POST['a'])) {
    $alf = str_split("abcdefghijklmnopqrstuvwxyz");

    $a = str_replace(' ', '', strtolower($_POST['a']));
    $arr = array_unique(str_split($a));
    sort($arr);
    sort($alf);
    echo $arr == $alf ? "TRUE" : "FALSE";
}
?>
</body>

</html>