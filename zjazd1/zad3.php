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
        <input type="submit">
    </form>
<?php
    if(isset($_POST['a']))
    {
        $a=is_numeric($_POST['a']) ? $_POST['a'] : 1;
        echo round(sqrt($a),2);
    }
?>
</body>
</html>