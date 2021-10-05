<?php
include 'functions.php';
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/root.php?ver=3">
    <link rel="stylesheet" type="text/css" href="css/styles.css?ver=3">
    <meta charset="utf-8">
</head>

<body>
    <a href="index.php"><span style="color:white;font-family:Impact, Charcoal, sans-serif;font-size: 30px;text-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);">URZĄD</span></a>
    <?php
    if (isset($_SESSION['name'])) {
        echo "<form id='logout' method='POST'>
        <input  type='submit' name='logout' value='wyloguj się'> 
        </form>
        <div id='themes'>
        <form method='POST'>
        </form>";
    }
    if (isset($_POST['logout'])) {
        session_destroy();
        header('location: login.php');
    }

    ?>
</body>

</html>