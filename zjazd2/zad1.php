<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Simple calculator</title>
</head>

<body>
    <form>
        <input name="a" type="number" step="0.01" required>
        <select name="type">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select>
        <input name="b" type="number" step="0.01" required>
        <input type="submit">
    </form>
    <br><br>
    <?php
    $arrSign = array('+', '-', '*', '/');
    function calculate($a, $b, $type)
    {
        $result = 0;
        switch ($type) {
            case '+':
                $result = $a + $b;
                break;
            case '-':
                $result = $a - $b;
                break;
            case '*':
                $result = $a * $b;
                break;
            case '/':
                $result = $b == 0 ? null : $a / $b;
                break;
        }
        $a = $a<0 ? "($a)" : $a;
        $b = $b<0 ? "($b)" : $b;
        return $result == null && $result != 0 ? "ERROR, trying to divide by zero!" : $a . " " . $type . " " . $b . " = " . $result;
    }
    if (isset($_GET['a'])) {
        $a = is_numeric($_GET['a']) ? $_GET['a'] : null;
        $b = is_numeric($_GET['b']) ? $_GET['b'] : null;
        $type = in_array($_GET['type'], $arrSign) ? $_GET['type'] : null;
        if ($a != null && $b != null && $type != null) {
            echo calculate($a, $b, $type);
        } else {
            echo "ERROR";
        }
    }
    ?>
</body>

</html>