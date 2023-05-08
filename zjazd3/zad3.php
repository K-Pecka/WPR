<?php
$path = "zad3.php";
$filename = "reservation.csv";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reservation</title>
    <style>
        .btn {
            width: 80%;
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

        .message {
            font-size: large;
            color: rgb(0, 150, 0);

        }

        a:hover,
        a:visited,
        a:link {
            color: rgb(73 102 73);
            text-decoration: none;
            text-transform: uppercase;
        }

        .rezervation table {
            border-collapse: collapse;
        }

        .rezervation td {
            font-size: 12px;
            border: 1px solid black;
        }

        input[type="submit"] {
            width: 100%;
            padding: 1%;
        }
    </style>
</head>

<body>
    <main>
        <?php
        if (isset($_POST['name'])) {
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

            if (!file_exists($filename)) {
                $file = fopen($filename, 'w');
                fwrite($file, "date of booking;time of booking;data of the booking person;person 2;person 3;person 4;credit card;address emile;adress;date of arrival;time of arrival;extra bed;air conditioning;ashtray\n");
                fclose($file);
            }
            $arrive_time = empty($_POST['arrival_time']) ? "" : $_POST['arrival_time'];
            $extra_bed = isset($_POST['extra_bed']) ? "NO" : "YES";
            $other = array($_POST['credit_card_number'], $_POST['email'], $_POST['address'], $_POST['date_of_stay'], $arrive_time, $extra_bed);
            $name_surname = array();
            $amenities = array();
            for ($i = 0; $i < 4; $i++) {
                if (isset($_POST['name'][$i])) {
                    array_push($name_surname, $_POST['name'][$i]." ".$_POST['surname'][$i]);
                } else {
                    array_push($name_surname, "");
                }
            }
            if (isset($_POST['amenities'])) {
                array_push($amenities, in_array('air conditioning', $_POST['amenities']) ? "YES" : "NO");
                array_push($amenities, in_array('ashtray', $_POST['amenities']) ? "YES" : "NO");
            } else {
                array_push($amenities, "NO", "NO");
            }

            $separator = "\n";
            $row = Date("d-m-y") . ";" . Date("H:i:s") . ";" . implode(";", array_merge($name_surname, $other, isset($amenities) ? $amenities : array())) . $separator;

            try {
                $file = fopen($filename, "a");
                if (fwrite($file, $row) != true) {
                    throw new Exception("Data could not be saved");
                } else {
                    echo "<span class='message'>booking successful!";
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            echo "<a href='" . $path . "'>Go to home</a></span>";
            fclose($file);
        } else
        if (!isset($_GET['numberOfGuests'])) {
            echo '<fieldset>
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
            if (file_exists('reservation.csv') && !isset($_POST['show'])) {
                echo "<form method='POST'><input name='show' type='submit' value='show reservation' class='btn'></form>";
            }
            if (isset($_POST['show'])) {
                echo "
                <fieldset class='rezervation'>
                    <legend>Rezervation</legend>
                    <table>";
                if (file_exists('reservation.csv')) {
                    $plik = file('reservation.csv');

                    for ($i = 0; $i < count($plik); $i++) {
                        echo "<tr>";
                        $line = explode(";", $plik[$i]);
                        for ($j = 0; $j < count($line); $j++) {
                            echo "<td>" . $line[$j] . "</td>";
                        }
                        echo "</tr>";
                    }
                    echo '</table>';
                    echo "</fieldset>";
                } else {
                    echo "ERROR";
                }
            }
        } else {
            $person = '';
            if ($_GET['numberOfGuests'] > 4 || $_GET['numberOfGuests'] < 1) {
                echo '
                <span class="error">Wrong data entered, please try again <a href="' . $path . '">Go to home</a></span>';
                exit();
            }
            for ($i = 0; $i < $_GET['numberOfGuests']; $i++) {
                $text = $i == 0 ? "Personalia osoby rezerwującej:" : "Personalia osoby " . ($i + 1) . ":";
                $person .= '
                <fieldset>
                <legend>' . $text . '</legend>
                <label>Imię*:
                <input type="text" name="name[]" required></label>

                <label>Nazwisko*:
                <input type="text" name="surname[]" required></label>
            
            </fieldset>
            ';
            }
            echo '<fieldset><legend>Rezerwacja:</legend>
            <form method="post">
            ' . $person . '
            <fieldset>
                <table>
                    <legend>Wymagane informacje:</legend>
                    <tr>
                        <td><label for="address">Adres*:</label></td>
                        <td><input type="text" id="address" name="address" required></td>
                        <td><label for="credit_card_number">Numer karty kredytowej*:</label></td>
                        <td><input type="text" id="credit_card_number" name="credit_card_number" required pattern="[0-9]{16}"></td>
                    </tr>
                    <tr>
                        <td><label for="email">Adres e-mail*:</label></td>
                        <td><input type="email" id="email" name="email" required></td>
                        <td><label for="date_of_stay">Data pobytu*:</label></td>
                        <td><input type="date" id="date_of_stay" name="date_of_stay" required></td>
                    </tr>
                    <tr>
                        <td><label for="arrival_time">Godzina przyjazdu:</label></td>
                        <td><input type="time" id="arrival_time" name="arrival_time"></td>
                        <td rowspan="2"><label for="extra_bed">Potrzeba łóżka dla dziecka:</label></td>
                        <td rowspan="2"><input type="checkbox" id="extra_bed" name="extra_bed" value="yes"></td>
                    </tr>
                    <tr>
                        <td><label for="amenities">Udogodnienia:</label></td>
                        <td>
                            <select id="amenities" name="amenities[]" multiple>
                                <option value="Klimatyzacja">Klimatyzacja</option>
                                <option value="Popielniczka">Popielniczka</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4"><input type="submit" value="Zarezerwuj"></td>
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