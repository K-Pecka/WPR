<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <label>
            Podaj wartość:<input type="number" name="a" required>
        </label>
        <br>
        <input type="submit">
    </form>
    <?php
    if (isset($_POST['a'])) {
        $a = is_numeric($_POST['a']) && $_POST['a'] >= 0 ? $_POST['a'] : null;
        if ($a != null) {
            echo round(sqrt($a), 2);
        } else {
            echo "BŁĄD";
        }
    }
    ?>
</body>

</html>