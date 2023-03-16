<<<<<<< HEAD
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
        <input type="submit">
    </form>
    <?php
    if (isset($_POST['a'])) {
        echo "<pre>";
        $a = is_numeric($_POST['a']) && $_POST['a']>0? $_POST['a'] : null;
        if($a != null)
        {
            for ($i = 0; $i <= $a; $i++) {
                echo str_repeat("*", $i) . "<br>";
            }
            for ($i = $a; $i > 0; $i--) {
                echo str_repeat("*", $i) . "<br>";
            }
            for ($i = 0; $i < $a; $i++) {
                echo str_repeat("&nbsp;", $i) . str_repeat("*", $a - $i) . "<br>";
            }
            for ($i = $a - 1; $i >= 0; $i--) {
                echo str_repeat("&nbsp;", $i) . str_repeat("*", $a - $i) . "<br>";
            }
        }

        echo "</pre>";
    }
    ?>
</body>

=======
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
        <input type="submit">
    </form>
    <?php
    if (isset($_POST['a'])) {
        echo "<pre>";
        $a = is_numeric($_POST['a']) ? $_POST['a'] : 1;
        for ($i = 0; $i <= $a; $i++) {
            echo str_repeat("*", $i) . "<br>";
        }
        for ($i = $a; $i > 0; $i--) {
            echo str_repeat("*", $i) . "<br>";
        }
        for ($i = 0; $i < $a; $i++) {
            echo str_repeat("&nbsp;", $i) . str_repeat("*", $a - $i) . "<br>";
        }
        for ($i = $a - 1; $i >= 0; $i--) {
            echo str_repeat("&nbsp;", $i) . str_repeat("*", $a - $i) . "<br>";
        }
        echo "</pre>";
    }
    ?>
</body>

>>>>>>> origin/main
</html>