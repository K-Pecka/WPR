<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>saving to a file</title>
</head>

<body>
    <form method="post">
        <label>Name:
            <input type="text" name="name" required>
        </label>
        <input type="submit">
    </form>
    <?php

    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        if (!empty($name)) {
            $separator = "\n";
            $filename = "data.txt";

            $file = fopen($filename, "a");
            $row = htmlspecialchars($name) . $separator;

            fwrite($file, $row);
            fclose($file);

            echo "the data has been saved!";
        } else {
            echo "The data has not been saved, the data cannot be empty";
        }
    }

    ?>
</body>

</html>