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
        <article>
            <header>
            <?php 
                include 'header.php'; 
            ?>
            <?php
            if(!isset($_SESSION['id'])){
                header("location: login.php");
            }
            ?>
            </header>
            <main style="margin:auto;margin-top:0;text-align:center;">
            <?php
            if(isseter($_POST['id'])){
                require_once('connection.php');
                $data = new ConnectToDb;
                $data->makeConnection();
                $queryToGetDataAboutPerson ="select * from people where id ='".$_POST['id']."'";
                $queryToGetDataAboutMandats ="select mandaty.id,kwota,komentarz from mandaty join people on mandaty.idPerson = people.id where people.id='".$_POST['id']."'";
                $dataPerson = $data->doQuery($queryToGetDataAboutPerson); 
                $dataMandaty = $data->doQuery($queryToGetDataAboutMandats);
                if(mysqli_num_rows($dataPerson)>0){ 
                    while($row = mysqli_fetch_assoc($dataPerson)){
                        echo "id: ".$row['id']."<br>";
                        echo "imie: ".$row['imie']."<br>";
                        echo "nazwisko: ".$row['nazwisko']."<br>";
                        echo "uczelnia: ".$row['uczelnia']."<br>";
                        echo "zawod: ".$row['zawod']."<br>";
                        echo "miasto: ".$row['miasto']."<br>";
                        echo "pensja: ".$row['pensja']."<br>";
                    }
                    if(mysqli_num_rows($dataMandaty)>0){ 
                        echo "<table style='width:50%;border-style: solid;border-color:white;'>
                        <tr>
                        <th>id</th>
                        <th>kwota</th>
                        <th>komentarz</th>";
                    while($row = mysqli_fetch_assoc($dataMandaty)){
                        echo "<tr>";
                        echo "<td>".$row['id']."</td>";
                        echo "<td> ".$row['kwota']."</td>";
                        echo "<td>".$row['komentarz']."</td>";
                        echo "</tr>";

                    }
                    echo "</table>";
                }
                else
                    echo "osoba nie otrzymała jeszcze mandatu";
            }
            }
            ?>
            </main>
            <footer>Strona opracowana przez: Rafał Struś</footer>
        </article>
    </body>
</html>