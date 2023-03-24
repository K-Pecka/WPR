<!DOCTYPE html>
<html>

<head>
    <title>Document</title>
</head>

<body>

    <?php
    $mess = "";
    if (isset($_POST['n']) && isset($_POST['m'])) {
        $n = is_numeric($_POST['n']) && $_POST['n'] > 0 ? $_POST['n'] : null;
        $m = is_numeric($_POST['m']) && $_POST['m'] > 0 ? $_POST['m'] : null;
        $input = "";
        if ($n == null || $m == null || $m != $n) {
            $mess = "BŁĄD";
            unset($_POST['n'], $_POST['m']);
        } else {
            for ($i = 1; $i <= max($n, $m); $i++) {
                $input .= "Wartość $i :";
                $input .= $n >= $i ? "<input name='tab[]' placeholder='value n' required> " : "";
                $input .= $m >= $i ? "<input name='tab2[]' placeholder='value m' required>" : "";
                $input .= "<br>";
            }
            echo
            "<form method='post'>
            $input
            <input type='submit' name='submit'>
        </form>";
        }
    }
    if (!isset($_POST['n']) && !isset($_POST['m'])) {
        echo '<form method="post">
            <label for="n">Podaj n:</label>
            <input type="number" id="n" name="n" required><br><br>
            <label for="m">Podaj m:</label>
            <input type="number" id="m" name="m" required><br><br>
            <input type="submit" name="submit">
        </form>';
        echo $mess;
    }

    if (isset($_POST['tab']) && isset($_POST['tab2'])) {
        $tab = $_POST['tab'];
        $tab2 = $_POST['tab2'];
        $sum = 0;
        for ($i = 0; $i < min(count($tab), count($tab2)); $i++) {
            $sum += $tab[$i] * $tab2[$i];
        }
        echo "<br><br>Wynik: " . $sum;
    }
    ?>
</body>

</html>