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
    <div class='element'>
        <form action='login.php' method='post'>
            Login:<br> <input type='text' name='name'><br>
            Password:<br> <input type='password' name='password'><br>
            <input type='submit' value = 'zaloguj się' name='submit'>
        </form>
</div>
</main>
<?php
if(isset($_SESSION['id'])){
    header("location: Homepage.php");
}
if(isset($_POST['submit'])){
    if(isseter($_POST["name"]) && isseter($_POST["password"])){
        $hashedpassword= hash('sha3-512' , $_POST["password"]);
        $sqlToLogin = "select id,name from logins where name = '".$_POST["name"]."' and password = '".$hashedpassword."' ";
        require_once('connection.php');
        $login = new ConnectToDb;
        $login->makeConnection();
        $logincheck = $login->doQuery($sqlToLogin);
        if(mysqli_num_rows($logincheck)>0){
            while($row = mysqli_fetch_assoc($logincheck)){
                foreach($row as $k => $v){
                    $_SESSION[$k] = $v;
                }
            }
            header("Location: homePage.php");
    }
}
}
?>
<footer>Strona opracowana przez: Rafał Struś</footer>
</article>
<script src="js/scripts.js"></script>
</body>
</html>