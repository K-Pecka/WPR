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
        $text = $_POST['a'] != "" ? $_POST['a'] : null;
        if ($text) {
            $arr = array_reverse(explode(" ", $text));
            echo "%" . trim(implode(" ", $arr)) . "%$#";
        }
    }
    ?>
</body>

</html>