<?php

use PhpMyAdmin\Header;

session_start();
$path = "login.php";
$message = isset($_SESSION['message']) ? $_SESSION['message'] : "";
if (isset($_SESSION['message'])) {
    session_destroy();
}
if (isset($_POST['login']) && isset($_POST['pass'])) {
    if ($_POST['login'] == "admin" && $_POST['pass'] == "pass") {
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['pass'] = $_POST['pass'];
    } else {
        $message = "Incorrect login or password!";
    }
}
if (isset($_SESSION['login']) && isset($_SESSION['pass'])) {
    Header("Location:form.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reservation</title>
    <style>
        .message {
            margin-top: 10px;
            color: red;
        }

        legend {
            text-transform: uppercase;
            font-family: 'Courier New', Courier, monospace;
            font-weight: 600;
        }

        form {
            width: 100%;
        }

        body {
            display: flex;
            justify-content: center;
            background-color: rgb(147, 147, 147);
        }

        main {
            margin-top: 15%;
            margin-bottom: 10%;
            width: 80%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        fieldset {
            display: flex;
            flex-wrap: wrap;
            flex: 1;
            flex-wrap: wrap;
            justify-content: center;
            width: 80%;
            min-height: 50%;
            padding: 10%;
        }

        input {
            background-color: rgb(200, 200, 200);
            border: 1px solid rgb(170, 170, 170);
            width: 80%;
            padding: 1%;
            margin: auto;
        }

        input[type='submit'] {
            width: 60%;
        }

        input:focus {
            border: 1px solid rgb(50, 50, 50);
            outline: none;
        }

        table {
            width: 100%;
        }

        label {
            display: flex;
            width: 100%;
            margin-top: 2%;
            text-align: center;
        }

        .error {
            font-size: large;
            color: rgb(150, 0, 0);

        }

        a:hover,
        a:visited,
        a:link {
            color: blue;
            text-decoration: none;
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <main>
        <fieldset>
            <legend>Log in</legend>
            <form method="POST">
                <label>
                    <input type="text" name="login">
                </label>
                <label>
                    <input type="password" name="pass">
                </label>
                <label>
                    <input type="submit" value="log in">
                </label>
            </form>
            <?php echo "<span class='message'>" . $message . "</span>"; ?>
        </fieldset>
    </main>
</body>

</html>