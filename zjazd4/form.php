<?php

session_start();
$path = "form.php";
if (isset($_POST['logOut'])) {
    session_destroy();
    Header("Location:login.php");
}
if (!isset($_SESSION['login']) || !isset($_SESSION['pass'])) {
    $_SESSION['message'] = "You must be logged in to make a reservation!";
    Header("Location:login.php");
}
if (isset($_GET['numberOfGuests'])) {
    setcookie('numberOfGuests', $_GET['numberOfGuests'], time() + 3600);
    Header("Location:" . $path);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reservation</title>
    <style>
        nav {
            position: fixed;
            top: 20px;
            right: 20px;
            width: 10%;
        }

        #logOut {
            padding: 20%;
            width: 100%;
            cursor: pointer;
        }

        legend {
            text-transform: uppercase;
            font-family: 'Courier New', Courier, monospace;
            font-weight: 600;
        }

        body {
            display: flex;
            justify-content: center;
            background-color: rgb(147, 147, 147);
        }

        main {
            margin-top: 10%;
            margin-bottom: 10%;
            width: max(80vw, 500px);
        }

        fieldset {
            display: flex;
            flex: 1;
            flex-wrap: wrap;
            justify-content: center;
            width: 100%;
            min-height: 10%;
        }

        td {
            height: min(5vh, 100px);
        }

        input,
        select {
            background-color: rgb(200, 200, 200);
            border: 1px solid rgb(170, 170, 170);
        }

        fieldset fieldset:last-child :is(input:not([type="submit"]), select) {
            width: 80%;
        }

        select::-webkit-scrollbar {
            width: 0;
        }

        input:focus,
        select:focus {
            border: 1px solid rgb(50, 50, 50);
            outline: none;
        }

        table {
            width: 100%;
        }

        label {
            width: 50%;
            margin-top: 2%;
            text-align: center;
        }

        fieldset>fieldset:last-child label {
            width: 100%;
        }

        fieldset>fieldset:last-child :is(input, select):not(input[type="submit"]) {
            width: 80%;
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

        input[type="submit"] {
            width: 100%;
            padding: 1%;
        }
    </style>
</head>

<body>
    <nav>
        <form method="POST"><input type="submit" name="logOut" value="Log out" id="logOut"></form>
    </nav>
    <main>
        <?php
        if (isset($_POST['save'])) {

            setcookie('address', $_POST['address'], time() + 3600);
            setcookie('email', $_POST['email'], time() + 3600);
            setcookie('credit_card_number', $_POST['credit_card_number'], time() + 3600);
            setcookie('date_of_stay', $_POST['date_of_stay'], time() + 3600);
            setcookie('name', implode(";", $_POST['name']), time() + 3600);
            setcookie('surname', implode(";", $_POST['surname']), time() + 3600);
            setcookie('arrival_time', $_POST['arrival_time'], time() + 3600);
            setcookie('extra_bed', $_POST['extra_bed'], time() + 3600);
            setcookie('amenities', implode(";", $_POST['amenities']), time() + 3600);
            Header("Location:" . $_SERVER['REQUEST_URI']);
        }
        if (isset($_POST['reset'])) {
            setcookie('address', '', time() - 3600);
            setcookie('email', '', time() - 3600);
            setcookie('credit_card_number', '', time() - 3600);
            setcookie('date_of_stay', '', time() - 3600);
            setcookie('name', '', time() - 3600);
            setcookie('surname', '', time() - 3600);
            setcookie('numberOfGuests', '', time() - 3600);
            setcookie('arrival_time', '', time() - 3600);
            setcookie('extra_bed', '', time() - 3600);
            setcookie('amenities', '', time() - 3600);
            Header("Location:" . $_SERVER['REQUEST_URI']);
        }
        $address_default = isset($_COOKIE['address']) ? $_COOKIE['address'] : "";
        $email_default = isset($_COOKIE['email']) ? $_COOKIE['email'] : "";
        $credit_card_number_default = isset($_COOKIE['credit_card_number']) ? $_COOKIE['credit_card_number'] : "";
        $date_of_stay_default = isset($_COOKIE['date_of_stay']) ? $_COOKIE['date_of_stay'] : "";
        $name_default = isset($_COOKIE['name']) ? explode(";", $_COOKIE['name']) : [];
        $surname_default = isset($_COOKIE['surname']) ? explode(";", $_COOKIE['surname']) : [];
        $amenities_default = isset($_COOKIE['amenities']) ? explode(";", $_COOKIE['amenities']) : [];
        $arrival_time_default = isset($_COOKIE['arrival_time']) ? $_COOKIE['arrival_time'] : "";
        $extra_bed_default = isset($_COOKIE['extra_bed']) ? $_COOKIE['extra_bed'] : "";
        if (isset($_POST['name']) && !isset($_POST['save']) && !isset($_POST['reset'])) {
            $description = "
                <fieldset>
                <legend>Podsumowanie rezerwacji:</legend>";
            for ($i = 0; $i < count($_POST['name']); $i++) {
                $text = $i == 0 ? "Personalia osoby rezerwującej:" : "Personalia osoby " . ($i + 1) . ":";
                $description .= " 
                    <fieldset>
                        <legend>$text</legend>
                        <table>
                        <tr>
                            <td>Imie: </td><td>" . ucfirst(strtolower($_POST['name'][$i])) . "</td>
                        </tr>
                        <tr>
                            <td>Nazwisko: </td><td>" . ucfirst(strtolower($_POST['surname'][$i])) . "</td>
                        </tr>
                        </table>
                    </fieldset>";
            }
            $description .= "<table>";
            $description .= "<tr><td>Address: </td><td>" . $_POST['address'] . "</td></tr>";
            $description .= "<tr><td>Karta kredtowa: </td><td>" . $_POST['credit_card_number'] . "</td></tr>";
            $description .= "<tr><td>Emile: </td><td>" . $_POST['email'] . "</td></tr>";
            $description .= "<tr><td>Data przybycia: </td><td>" . $_POST['date_of_stay'] . "</td></tr>";
            $description .= "<tr><td>Czas przybycia: </td><td>" . (empty($_POST['arrival_time']) ? "-" : $_POST['arrival_time']) . "</td></tr>";
            $description .= "<tr><td>Dodatkowe łóżko: </td><td>" . (!isset($_POST['extra_bed']) ? "NIE" : "TAK") . "</td></tr>";
            if (isset($_POST['amenities'])) {
                $description .= "<tr><td>Udogodnienie: </td><td>";
                for ($i = 0; $i < count($_POST['amenities']); $i++) {
                    $description .= $_POST['amenities'][$i] . "<br>";
                }
                $description .= "</td></tr>";
            }
            echo $description . "</table></fieldset>";
        } else
        if (!isset($_GET['numberOfGuests']) && !isset($_COOKIE['numberOfGuests'])) {
            $login = $_COOKIE['login'];
            echo '<fieldset>
                    <h1>Witaj, ' . $login . '!</h1>
                    <legend>Na ile osób zarezerwować:</legend>
                    <table>
                        <form>
                            <tr>
                                <td><label for="guests">Ilość osób (1-4)*:</label></td>
                                <td>
                                    <select id="guests" name="numberOfGuests" required style="width: 80%">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" value="Wyślij"></td>
                            </tr>
                        </form>
                    </table>
                </fieldset>';
        } else {
            $person = '';
            if (isset($_COOKIE['numberOfGuests']) && ($_COOKIE['numberOfGuests'] > 4 || $_COOKIE['numberOfGuests'] < 1)) {
                echo '
                <span class="error">Wrong data entered, please try again <a href="' . $path . '">Go to home</a></span>';
                exit();
            } else if (isset($_COOKIE['numberOfGuests'])) {

                for ($i = 0; $i < $_COOKIE['numberOfGuests']; $i++) {
                    $text = $i == 0 ? "Personalia osoby rezerwującej:" : "Personalia osoby " . ($i + 1) . ":";
                    $name = isset($name_default[$i]) ? $name_default[$i] : "";
                    $surname = isset($surname_default[$i]) ? $surname_default[$i] : "";
                    $person .= '
                <fieldset>
                <legend>' . $text . '</legend>
                <label>Imię*:
                <input type="text" name="name[]" value="' . $name . '"></label>

                <label>Nazwisko*:
                <input type="text" name="surname[]" value="' . $surname . '" ></label>
            
                </fieldset>
                ';
                }
            }

            echo '<fieldset><legend>Rezerwacja:</legend>
            <form method="post">
            ' . $person . '
            <fieldset>
                <table>
                    <legend>Wymagane informacje:</legend>
                    <tr>
                        <td><label for="address" >Adres*:</label></td>
                        <td><input type="text" id="address" name="address" value="' . $address_default . '" ></td>
                        <td><label for="credit_card_number">Numer karty kredytowej*:</label></td>
                        <td><input type="text" id="credit_card_number" name="credit_card_number"  pattern="[0-9]{16}" value="' . $credit_card_number_default . '"></td>
                    </tr>
                    <tr>
                        <td><label for="email">Adres e-mail*:</label></td>
                        <td><input type="email" id="email" name="email" value="' . $email_default . '"></td>
                        <td><label for="date_of_stay">Data pobytu*:</label></td>
                        <td><input type="date" id="date_of_stay" name="date_of_stay" value="' . $date_of_stay_default . '"></td>
                    </tr>
                    <tr>
                        <td><label for="arrival_time">Godzina przyjazdu:</label></td>
                        <td><input type="time" id="arrival_time" name="arrival_time" value="' . $arrival_time_default . '"></td>
                        <td rowspan="2"><label for="extra_bed">Potrzeba łóżka dla dziecka:</label></td>
                        <td rowspan="2"><input type="checkbox" id="extra_bed" name="extra_bed" value="yes" checked="' . $extra_bed_default . '"></td>
                    </tr>
                    <tr>
                        <td><label for="amenities">Udogodnienia:</label></td>
                        <td>
                            <select id="amenities" name="amenities[]" multiple="">
                                <option value="Klimatyzacja" ' . (in_array("Klimatyzacja", $amenities_default) == true ? "selected" : "") . '>Klimatyzacja</option>
                                <option value="Popielniczka" ' . (in_array("Popielniczka", $amenities_default) == true ? "selected" : "") . '>Popielniczka</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <input type="submit" value="Zarezerwuj" name="booking">
                            <input type="submit" value="Reset" name="reset">
                            <input type="submit" value="Save" name="save">
                        </td>
                    </tr>
            </fieldset>
        </form>
        </table>
        </fieldset>';
        }
        ?>
    </main>
</body>

</html>