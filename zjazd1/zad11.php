<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <label>
            Wprowadź tekst:<input type="text" name="a" required>
        </label>
        <br>
        <input type="submit">
    </form>
    <?php
    if (isset($_POST['a'])) {
        $alf = str_split("abcdefghijklmnopqrstuvwxyz");
        $replace = [".", ",", "-", "/", "*", "_", "!", "?", "=", "@", "#", "$", "%", "^", "&", "(", ")", "{", "}", "[", "]", "|", "~", "`", ";", ":", "'", "<", '"', "+", " ", 1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
        $text = str_replace($replace, '', strtolower($_POST['a']));
        $arr = array_unique(str_split($text));
        sort($arr);
        sort($alf);
        echo $arr == $alf ? "TRUE" : "FALSE";
    }
    ?>
</body>

</html>