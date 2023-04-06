<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reservation</title>
    <style>
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
        }

        td {
            height: min(5vh, 100px);
        }

        input {
            background-color: rgb(200, 200, 200);
            border: 1px solid rgb(170, 170, 170);
        }

        table {
            width: 100%;
        }

        label {
            width: 50%;
            text-align: center;
        }

        fieldset:last-child label {
            width: 100%;
        }

        fieldset:last-child :is(input, select):not(input[type="submit"]) {
            width: 80%;
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
        class Form
        {
            public function reservation()
            {
        ?>
                <form method="post">
                    <?php
                    for ($i = 1; $i <= $_GET['numberOfGuests']; $i++) {
                        echo '
                        <fieldset>
                        <legend>Personalia osoby ' . $i . ':</legend>
                        <label>Imię*:
                        <input type="text" name="name[]" required></label>

                        <label>Nazwisko*:
                        <input type="text" name="surname[]" required></label>
                    
                    </fieldset>
                    ';
                    }

                    ?>
                    <fieldset>
                        <table>
                            <legend>Rezerwacja:</legend>
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
                                        <option value="Popielniczka">Popielniczka dla palacza</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4"><input type="submit" value="Zarezerwuj"></td>
                            </tr>
                    </fieldset>
                </form>
                </table>
            <?php
            }
            public function numberOfGuests()
            {
            ?>
                <fieldset>
                    <legend>Na ile osób zarezerwować:</legend>
                    <table>
                        <form method="GET">
                            <tr>
                                <td><label for="guests">Ilość osób (1-4)*:</label></td>
                                <td>
                                    <select id="guests" name="numberOfGuests" required>
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
                </fieldset>
        <?php
            }
            public function description($POST)
            {
                $description = "
                <fieldset>
                <legend>Podsumowanie rezerwacji:</legend>";
                for ($i = 0; $i < count($POST['name']); $i++) {
                    $description .= "
                    <fieldset>
                        <legend>Personalia osoby " . ($i + 1) . ":</legend>
                        <table>
                        <tr>
                            <td>Imie: </td><td>" . $POST['name'][$i] . "</td>
                        </tr>
                        <tr>
                            <td>Nazwisko: </td><td>" . $POST['surname'][$i] . "</td>
                        </tr>
                        </table>
                    </fieldset>";
                }
                $description .= "<table>";
                $description .= "<tr><td>Address: </td><td>" . $POST['address'] . "</td></tr>";
                $description .= "<tr><td>Karta kredtowa: </td><td>" . $POST['credit_card_number'] . "</td></tr>";
                $description .= "<tr><td>Emile: </td><td>" . $POST['email'] . "</td></tr>";
                $description .= "<tr><td>Data przybycia: </td><td>" . $POST['date_of_stay'] . "</td></tr>";
                $description .= "<tr><td>Czas przybycia: </td><td>" . (empty($POST['arrival_time']) ? "-" : $POST['arrival_time']) . "</td></tr>";
                $description .= "<tr><td>Dodatkowe łóżko: </td><td>" . (!isset($POST['extra_bed']) ? "NIE" : "TAK") . "</td></tr>";
                if (isset($POST['amenities'])) {
                    $description .= "<tr><td>Udogodnienie: </td><td>";
                    for ($i = 0; $i < count($POST['amenities']); $i++) {
                        $description .= $POST['amenities'][$i] . "<br>";
                    }
                    $description .= "</td></tr>";
                }
                echo $description . "</table></fieldset>";
            }
        }

        $form = new Form();
        if (isset($_GET['numberOfGuests']) && !isset($_POST['name'])) {
            $form->reservation();
        } else if (isset($_POST['name'])) {
            $form->description($_POST);
        } else {
            $form->numberOfGuests();
        }
        ?>
    </main>
</body>

</html>