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
        <input type="text" name="a" required><br>
        <input type="submit">
    </form>
<?php
    if(isset($_POST['a']))
    {
        $text = explode(" ",$_POST['a']);
        echo $_POST['a'] != "" && $text[1] != "" && count($text) == 2 ? "%".$text[1]." ".$text[0]."%$#"  : "BŁĄD";
    }
?>
</body>
</html>