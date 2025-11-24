<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obsługa tabeli z bazy danych</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>

<body>
    <?php
    include 'connect.php';
    ?>
    <div class="container">
        <div class="back">
            <p>Powrót</p>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#4b7eec" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
            </svg>
        </div>
        <div class="main">
            <div class="hero">
                <h1>Zarządzaj danymi z tabeli student</h1>
            </div>
            <div class="content">
                <div class="table">
                    <div class="column-name">
                        <?php
                        $sth = $conn->prepare("SHOW COLUMNS FROM student");
                        $sth->execute();
                        while ($row = $sth->fetch()) {
                            if ($row['Field'] == 'id') continue;
                            if ($row['Field'] == 'nr_indeksu') $row['Field'] = 'Numer indeksu';
                            if ($row['Field'] == 'imie') $row['Field'] = 'Imię';
                            if ($row['Field'] == 'nazwisko') $row['Field'] = 'Nazwisko';
                            if ($row['Field'] == 'wiek') $row['Field'] = 'Wiek';
                            if ($row['Field'] == 'ulica') $row['Field'] = 'Ulica';
                            if ($row['Field'] == 'kod_pocztowy') $row['Field'] = 'Kod pocztowy';
                            if ($row['Field'] == 'miasto') $row['Field'] = 'Miasto';
                            if ($row['Field'] == 'plec') $row['Field'] = 'Płeć';
                            echo "<div class='column-item'>" . $row['Field'] . "</div>";
                        }
                        echo "<div class='column-item'>Akcje</div>";
                        ?>
                    </div>
                    <div class="table-content">
                        <?php
                        $sth = $conn->prepare("SELECT id, nr_indeksu, imie, nazwisko, wiek, ulica, kod_pocztowy, miasto, plec FROM student");
                        $sth->execute();
                        $results = $sth->fetchAll();
                        $number = 0;
                        if (count($results) > 0) {
                            foreach ($results as $row) {
                                $number % 2 !== 0 ? $bgColor = '#f3f2f2ff' : $bgColor = 'white';
                                echo "<div class='row' style='background-color: " . $bgColor . ";'>";
                                echo "<div class='row-item data'>" . ($row['nr_indeksu']) . "</div>";
                                echo "<div class='row-item-input hidden'><input type='text' placeholder='Nr indeksu' class='input-field' name='nr_indeksu_edit' maxlength='50' value='" . ($row['nr_indeksu']) . "' required id='nr_indeksu_edit'></div>";
                                echo "<div class='row-item data'>" . ($row['imie']) . "</div>";
                                echo "<div class='row-item-input hidden'><input type='text' placeholder='Imię' class='input-field' name='imie_edit' maxlength='50' value='" . ($row['imie']) . "' required id='imie_edit'></div>";
                                echo "<div class='row-item data'>" . ($row['nazwisko']) . "</div>";
                                echo "<div class='row-item-input hidden'><input type='text' placeholder='Nazwisko' class='input-field' maxlength='50' name='nazwisko_edit' value='" . ($row['nazwisko']) . "' required id='nazwisko_edit'></div>";
                                echo "<div class='row-item data'>" . ($row['wiek']) . "</div>";
                                echo "<div class='row-item-input hidden'><input type='number' placeholder='Wiek' class='input-field' min='0' max='99' name='wiek_edit' value='" . ($row['wiek']) . "' required id='wiek_edit'></div>";
                                echo "<div class='row-item data'>" . ($row['ulica']) . "</div>";
                                echo "<div class='row-item-input hidden'><input type='text' placeholder='Ulica' class='input-field' maxlength='100' name='ulica_edit' value='" . ($row['ulica']) . "' required id='ulica_edit'></div>";
                                echo "<div class='row-item data'>" . ($row['kod_pocztowy']) . "</div>";
                                echo "<div class='row-item-input hidden'><input type='text' name='kod_pocztowy_edit' id='kod_pocztowy_edit' placeholder='Kod pocztowy' value='" . ($row['kod_pocztowy']) . "' required pattern='[0-9]{2}-[0-9]{3}'></div>";
                                echo "<div class='row-item data'>" . ($row['miasto']) . "</div>";
                                echo "<div class='row-item-input hidden'><input type='text' placeholder='Miasto' class='input-field' name='miasto_edit' maxlength='100' value='" . ($row['miasto']) . "' required id='miasto_edit'></div>";
                                echo "<div class='row-item data'>" . ($row['plec']) . "</div>";
                                if ($row['plec'] == 'Mężczyzna') {
                                    $selectedMale = 'selected';
                                    $selectedFemale = '';
                                    $selectedOther = '';
                                } elseif ($row['plec'] == 'Kobieta') {
                                    $selectedMale = '';
                                    $selectedFemale = 'selected';
                                    $selectedOther = '';
                                } else {
                                    $selectedMale = '';
                                    $selectedFemale = '';
                                    $selectedOther = 'selected';
                                }
                                echo "<div class='row-item-input hidden'><select class='input-field' name='plec_edit' id='plec_edit' required>
                                    <option value='Mężczyzna' " . $selectedMale . ">Mężczyzna</option>
                                    <option value='Kobieta' " . $selectedFemale . ">Kobieta</option>
                                    <option value='Inna' " . $selectedOther . ">Inna</option>
                                </select></div>";
                                echo '<div class="row-item">
                                            <div class="edit-buttons">
                                                <input type="button" class="select-edit-button" value="Edytuj">
                                                <input type="button" class="delete-button" value="Usuń">
                                                <input type="button" class="abort-edit-button" value="Cofnij">
                                                <input type="button" class="edit-button" value="Potwierdź">
                                                <input type="hidden" class="id-field" value="' . $row['id'] . '">
                                            </div>
                                        </div>';
                                echo "</div>";
                                $number++;
                            }
                        } else {
                            echo "<p class='no-data'>Brak danych w tabeli.</p>";
                        }
                        ?>
                        <form class="row add" action="addRecord.php" method="POST">
                            <div class="row-item">
                                <input type="text" placeholder="Numer indeksu" class="input-field" name="nr_indeksu" required pattern="[0-9]{6}" id="nr_indeksu">
                            </div>
                            <div class="row-item">
                                <input type="text" placeholder="Imię" class="input-field" name="imie" maxlength="50" required id="imie">
                            </div>
                            <div class="row-item">
                                <input type="text" placeholder="Nazwisko" class="input-field" maxlength="50" name="nazwisko" required id="nazwisko">
                            </div>
                            <div class="row-item">
                                <input type="number" placeholder="Wiek" class="input-field" min="0" max="99" name="wiek" required id="wiek">
                            </div>
                            <div class="row-item">
                                <input type="text" placeholder="Ulica" class="input-field" maxlength="100" name="ulica" required id="ulica">
                            </div>
                            <div class="row-item">
                                <input type="text" name="kod_pocztowy" id="kod_pocztowy" placeholder="Kod pocztowy" required pattern="[0-9]{2}-[0-9]{3}">
                            </div>
                            <div class="row-item">
                                <input type="text" placeholder="Miasto" class="input-field" name="miasto" maxlength="100" required id="miasto">
                            </div>
                            <div class="row-item">
                                <select class="input-field" name="plec" id="plec" required>
                                    <option value="" disabled selected>Wybierz płeć</option>
                                    <option value="Mężczyzna">Mężczyzna</option>
                                    <option value="Kobieta">Kobieta</option>
                                    <option value="Inna">Inna</option>
                                </select>
                            </div>
                            <div class="row-item">
                                <input type="submit" class="add-button" value="Dodaj">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="about">
                <h2>Jakub Strzelczak</h2>
                <p>Numer albumu: 227684</p>
                <h4>listopad 2025</h4>
            </div>
        </div>
    </div>
</body>

</html>