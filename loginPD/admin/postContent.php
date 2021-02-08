<?php
    session_start(); 
    if($_SESSION['role'] == 'admin'){
    require_once('../connection.php');
    date_default_timezone_set('Europe/Riga');
    
    $un = $_SESSION['username'];
    $datetime = date('Y-m-d H:i:s');
    $visualdate = date('H:i ∙ d M y');
    $txt = $_POST['postText'];

    $q = "INSERT INTO `posts`(`id`,`username`,`datetime`,`visualdate`,`content`)
    VALUES('','$un','$datetime','$visualdate','$txt')";
    mysqli_query($conn, $q);
    }
    header("location: admin");
?>