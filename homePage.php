<?php
session_start();
define('Access', TRUE);
?>
<!DOCTYPE html>
<html lang='pl'>

<head>
    <meta charset='utf-8'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
    <article>
        <header>
            <?php
            include 'header.php';
            ?>
            <?php
            require_once('connection.php');
            if (!isset($_SESSION['name'])) {
                header("Location: login.php");
            }
            ?>
        </header>
        <main style="margin:0;">
            <form id='selectForm' action='homePage.php' method='post'>
                <select id="select" name="choose" onchange="selectForm()">
                    <option value="">proszę wybrać</option>
                    <option value="osoby">Osoby</option>
                    <option value="mandaty">Mandaty</option>
                </select>
            </form>
            <?php
            if (isset($_POST["choose"])) {
                if ($_POST["choose"] == "osoby") {
                    $queryToGetData = "select * from people ";
                    $queryToGetData .= isseter($_POST["imie"]) ? "where imie = '" . $_POST["imie"] . "' " : '';
                    $queryToGetData .= isseter($_POST["nazwisko"]) ? (isseter($_POST["imie"])  ? "and nazwisko ='" . $_POST["nazwisko"] . "'" : "where nazwisko = '" . $_POST["nazwisko"] . "' ") : '';
                    $queryToGetData .= isseter($_POST["miasto"]) ? (isseter($_POST["nazwisko"])  || isseter($_POST["imie"]) ? " and miasto ='" . $_POST["miasto"] . "'" : " where miasto = '" . $_POST["miasto"] . "' ") : '';
                } elseif ($_POST["choose"] == "mandaty") {
                    $queryToGetData = "select * from mandaty join people on people.id= mandaty.idPerson ";
                    $queryToGetData .= isseter($_POST["powod"]) ? "where komentarz = '" . $_POST["powod"] . "'" : '';
                }
                $data = new ConnectToDb;
                $data->makeConnection();
                if (!isset($_POST["offset"]) || $_POST["offset"] == null) {
                    $_POST["offset"] = 0;
                }
                $dataLenght = $data->doQuery($queryToGetData . " LIMIT 18446744073709551610 OFFSET " . $_POST["offset"] . "");
                $queryToGetData .= " LIMIT 10 OFFSET " . $_POST["offset"] . "";
                $gotData = $data->doQuery($queryToGetData);
                if (mysqli_num_rows($dataLenght) > 0) {
                    if ($_POST["choose"] == "osoby") {
                        $osoby = ['id', 'imie', 'nazwisko', 'uczelnia', 'zawod', 'miasto', 'pensja', 'informacje'];
                        echo "<table style='width:100%'>
                        <tr>";
                        foreach ($osoby as $value)
                            echo "<th>" . $value . "</th>";
                        echo "</tr>";
                        while ($row = mysqli_fetch_assoc($gotData)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['imie'] . "</td>";
                            echo "<td>" . $row['nazwisko'] . "</td>";
                            echo "<td>" . $row['uczelnia'] . "</td>";
                            echo "<td>" . $row['zawod'] . "</td>";
                            echo "<td>" . $row['miasto'] . "</td>";
                            echo "<td>" . $row['pensja'] . "</td>";
                            echo "<td><form action ='infoPage.php' method='post'><input style='display:none;' name ='id' value=" . $row['id'] . "><input type=submit value=informacje></form></td>";
                            echo "</tr>";
                        }
                    } elseif ($_POST["choose"] == "mandaty") {
                        $mandaty = ['kwota', 'komentarz', 'idPerson', 'imie', 'nazwisko', 'miasto'];
                        echo "<table style='width:100%'>
                        <tr>";
                        foreach ($mandaty as $value)
                            echo "<th>" . $value . "</th>";
                        echo "</tr>";
                        while ($row = mysqli_fetch_assoc($gotData)) {
                            $info = ['kwota', 'komentarz', 'idPerson', 'imie', 'nazwisko', 'miasto'];
                            echo "<tr>";
                            foreach ($mandaty as $value)
                                echo "<td>" . $row[$value] . "</td>";
                            echo "</tr>";
                        }
                    }
                    echo "</table>";
                    if ($_POST["choose"] == "osoby")
                        echoForm(['choose', 'imie', 'nazwisko', 'miasto']);
                    elseif ($_POST["choose"] == "mandaty")
                        echoForm(['choose', 'powod']);
                    if (isset($_POST['offset']) && $_POST['offset'] != 0) {
                        echo "<input style='display:none;' name ='offset' value=" . ($_POST["offset"] - 10) . ">";
                        echo "<input type=submit value='poprzednia strona'></form>";
                    }
                    if ($_POST["choose"] == "osoby")
                        echoForm(['choose', 'imie', 'nazwisko', 'miasto']);
                    elseif ($_POST["choose"] == "mandaty")
                        echoForm(['choose', 'powod']);
                    if (mysqli_num_rows($dataLenght) > 10) {
                        echo "<input style='display:none;' name ='offset' value=" . ($_POST["offset"] + 10) . ">";
                        echo "<input type=submit value='Następna strona'></form><p>zostało jeszcze " . (mysqli_num_rows($dataLenght) - 10) . " rekordów do wyświetlenia</p>";
                    };
                }
            }
            function echoForm($names)
            {
                echo "<form action ='HomePage.php' method='post' style ='display: inline'>";
                foreach ($names as $value)
                    echo "<input style='display:none;' name ='" . $value . "' value=" . $_POST[$value] . ">";
            }
            echo "<br><br><a href='formularz.php'><button>Dodaj Dane</button></a>";
            ?>
        </main>
        <footer>Strona opracowana przez: Rafał Struś</footer>
    </article>
    <script src="form.js"></script>
</body>

</html>