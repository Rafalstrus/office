<?php
session_start();
define('Access', TRUE);
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Urząd</title>
</head>

<body>
    <?php

    ?>
    <article>
        <header>
            <?php
            include 'header.php';
            ?>
        </header>
        <main>
            <p>Osoba</p>
            <form action='formularz.php' method='post'>
                imie:<br> <input type='text' name='imie'><br>
                nazwisko:<br> <input type='text' name='nazwisko'><br>
                uczelnia:<br> <input type='text' placeholder="jeżeli nie ma 'brak'" name='uczelnia'><br>
                zawód:<br> <input type='text' placeholder="jeżeli nie ma 'brak'" name='zawod'><br>
                miasto:<br> <input type='text' name='miasto'><br>
                pensja:<br> <input type='text' placeholder="liczba" name='pensja'><br>
                <input type='submit' value='Dodaj' name='submit'>
                </form>
                <br><br>
                <p>Mandat</p>
                <form action='formularz.php' method='post'>
                    id osoby:<br> <input type='text' placeholder="liczba" name='idPerson'><br>
                    kwota:<br> <input type='text' placeholder="liczba" name='kwota'><br>
                    powód/komentarz:<br> <input type='text' name='komentarz'><br>
                    <input type='submit' value='Dodaj' name='submit'>
                    </form>
        </main>
        <?php
        if (!isset($_SESSION['id'])) {
            header("location: login.php");
        }
        if (
            isset($_POST['idPerson']) && $_POST['idPerson'] != null && isset($_POST['kwota']) && $_POST['kwota'] != null
            && isset($_POST['komentarz']) && $_POST['komentarz'] != null
        ) {
            $sqlToUpdateMandaty = "INSERT INTO `mandaty`( `idPerson`, `kwota`, `komentarz`) 
            VALUES (" . $_POST['idPerson'] . "," . $_POST['kwota'] . ",'" . $_POST['komentarz'] . "')";
            updataData($sqlToUpdateMandaty);
        }
        if (
            isset($_POST['imie']) && $_POST['imie'] != null && isset($_POST['nazwisko']) && $_POST['nazwisko'] != null
            && isset($_POST['uczelnia']) && $_POST['uczelnia'] != null && isset($_POST['zawod']) && $_POST['zawod'] != null
            && isset($_POST['pensja']) && $_POST['pensja'] != null && isset($_POST['pensja']) && $_POST['pensja'] != null
        ) {
            $sqlToUpdateMandaty = "INSERT INTO `people`( `imie`, `nazwisko`, `uczelnia`, `zawod`, `miasto`, `pensja`) 
            VALUES ('" . $_POST['imie'] . "','" . $_POST['nazwisko'] . "','" . $_POST['uczelnia'] . "','" . $_POST['zawod'] . "',
            '" . $_POST['miasto'] . "'," . $_POST['pensja'] . ")";
            updataData($sqlToUpdateMandaty);
        }
        ?>
        <footer>Strona opracowana przez: Rafał Struś</footer>
    </article>
    <script src="js/scripts.js"></script>
</body>

</html>