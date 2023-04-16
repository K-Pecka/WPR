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
            <option value="add">+</option>
            <option value="subtract">-</option>
            <option value="multiply">*</option>
            <option value="divide">/</option>
        </select>
        <input name="b" type="number" step="0.01" required>
        <input type="submit">
    </form>
    <br><br>
    <?php
    require_once("simpleCalculator.php");
    $operationSign = array("add" => "+", "subtract" => "-", "multiply" => "*", "divide" => "/");
    if (isset($_GET['a'])) {
        $calc = new SimpleCalculator($_GET['a'], $_GET['b']);
        if ($calc->check()) {
            echo $calc->renderResult("");
            switch ($_GET['type']) {
                case "add":
                    $calc->add();
                    break;
                case "subtract":
                    $calc->subtract();
                    break;
                case "multiply":
                    $calc->multiply();
                    break;
                case "divide":
                    $calc->divide();
                    break;
            }
            try {
                if (isset($operationSign[$_GET['type']]))
                    $index = $_GET['type'];
                else
                    throw new Exception("operation does not exist");
                echo $calc->renderResult($operationSign[$index]);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {
            echo "ERROR";
        }
    }
    ?>
</body>

</html>