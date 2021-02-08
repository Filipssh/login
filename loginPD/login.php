<?php session_start(); 
    if(isset($_SESSION['username'])){
        header("location: index");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action='' method='post'>
        <input type='text' name='username' placeholder='username'>
        <input type='password' name='password' placeholder='password'>

        <input type='submit' value='login' name='login'>
        <input type='submit' value='register' name='create'>
        </form>
<?php
    require_once('connection.php');
    if(isset($_POST['login'])){
        $un = $_POST['username'];
        $pw = $_POST['password'];
        $q = "SELECT * FROM `users` WHERE username='$un'";
        $r = mysqli_query($conn, $q);
        $user = mysqli_fetch_assoc($r);

        if (mysqli_num_rows($r) != 0){// pārbauda rindiņu daudzumu
            if($user['username'] == $un && password_verify($pw, $user['password'])){
                $_SESSION['username'] = $un;
                $_SESSION['role'] = $user['role'];
                header("location: index");
            }else{
                echo "incorrect username or password";
            }
        }else{
            echo "incorrect username or password";
        }
    }
    if(isset($_POST['create'])){
        header("location: create");
    }
?>

</body>
</html>
