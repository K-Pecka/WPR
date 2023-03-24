<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <label>
            Podaj numer miesiąca:<input type="number" name="a" required>
        </label>
        <br>
        <input type="submit">
    </form>
    <?php
    if (isset($_POST['a'])) {
        $a = $_POST['a'];
        switch ($a) {
            case 1:
                $m = "Styczeń, 31 dni";
                break;
            case 2:
                $m = "Luty, 28 dni";
                break;
            case 3:
                $m = "Marzec, 31 dni";
                break;
            case 4:
                $m = "Kwiecień, 30 dni";
                break;
            case 5:
                $m = "Maj, 31 dni";
                break;
            case 6:
                $m = "Czerwiec, 30 dni";
                break;
            case 7:
                $m = "Lipiec, 31 dni";
                break;
            case 8:
                $m = "Sierpień, 31 dni";
                break;
            case 9:
                $m = "Wrzesień, 30 dni";
                break;
            case 10:
                $m = "Październik, 31 dni";
                break;
            case 11:
                $m = "Listopad, 30 dni";
                break;
            case 12:
                $m = "Grudzień, 31 dni";
                break;
            default:
                $m = "BŁAD";
        }
        echo $m;
    }
    ?>
</body>

</html>