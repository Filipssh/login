<?php 
    session_start();
    if(isset($_SESSION['username'])){
        session_destroy();
        header("location: login");
    }else{
        header("location: login");
    }
?>