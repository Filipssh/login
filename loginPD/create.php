<?php
    session_start();
    if (empty($_SESSION['carryOver'])){
        $_SESSION['carryOver'] = array("","","","","");
    }else{
        echo "<script>carryOver = true;</script>";
    }

    if (empty($_SESSION['userImage'])){
        $_SESSION['userImage'] = "placeholder.png";
    }
    
    require_once('connection.php');
    if(isset($_POST['cancel'])){
        if($_SESSION['userImage'] != "placeholder.png"){
            unlink($_SESSION['userImage']);
            unset($_SESSION['userImage']);
        }
        unset($_SESSION['carryOver']);
        header("location: index");
    }

    if(isset($_POST['addImg'])){
        $info = array(
            $_POST['username'],
            $_POST['name'],
            $_POST['phone'],
            $_POST['password']
        );
        $_SESSION['carryOver'] = $info;
        header("location: ../croppie/index");
    }

    if(isset($_POST['create'])){
        $un = mysqli_real_escape_string($conn, $_POST['username']);
        $nm = mysqli_real_escape_string($conn, $_POST['name']);
        $ph = mysqli_real_escape_string($conn, $_POST['phone']);
        $pw = mysqli_real_escape_string($conn, $_POST['password']);
        $co = mysqli_real_escape_string($conn, $_POST['confirm']);
        if(     strlen($un) >= 4 &&
                strlen($nm) > 0 &&
                strlen($un) <= 15 &&
                strlen($ph) == 8 &&
                is_numeric($ph) &&
                strlen($pw) >= 4 &&
                $pw == $co){
            $pw = password_hash($pw, PASSWORD_BCRYPT);
            $q = "SELECT * FROM `users` WHERE username='$un'";
            $r = mysqli_query($conn, $q);
            $user = mysqli_fetch_assoc($r);
            $img = $_SESSION['userImage'];
            if (mysqli_num_rows($r) === 0){
                $q = "INSERT INTO `users`(`id`,`username`,`name`,`role`,`password`,`phone`,`image`)
                VALUES('','$un','$nm','user','$pw','$ph','$img')";
                mysqli_query($conn, $q);
                session_destroy();
                echo "<p>$un created <a href='login'>return to login</a></p>";
            }else{
                echo "<script>keepInfo('$un','$ph');</script>";
                echo "<p>username already taken</p>";
            }
        } 
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

    <form action='' method='post' autocomplete="off">
        <div id="imageContainer">
            <img class="uImg" src = "<?php echo $_SESSION['userImage']?>">
            <input type="submit" class="delett" value='+' name="addImg">
            <!-- href="../croppie/index" -->
            <!-- TODO: nomainīt a uz input type submit un saglabāt ievietoto info starp bildes ievadi-->
        </div>
        <input type='text' value="<?php echo $_SESSION['carryOver'][0];?>" name='username' placeholder='username' onkeyup='checkUsername()'>
        <p id='username'>username must be 4 to 15 characters long</p>
        <input type='text' value="<?php echo $_SESSION['carryOver'][1];?>" name='name' placeholder='name' onkeyup='checkName()'>
        <p id='name'>your name can't be blank</p>
        <input type='text' value="<?php echo $_SESSION['carryOver'][2];?>" name='phone' placeholder='phone number' onkeyup='checkPhone()'>
        <p id='phone'>please enter a valid phone number</p>
        <input type='password' value="<?php echo $_SESSION['carryOver'][3];?>" name='password' placeholder='password' onkeyup='checkPW()'>
        <p id='password'>password must be at least 4 characters long</p>
        <input type='password' name='confirm' placeholder='confirm password' onkeyup='checkCON()'>
        <p id='confirm'>the passwords don't match</p>
        <input type='submit' value='register' name='create' disabled="true">
        <input type='submit' value='cancel' name='cancel'>
        
    </form>
    <script>
        var carryOver;
        window.onload = function (){
            if(carryOver){
                checkUsername();
                checkName();
                checkPhone();
                checkPW();
                checkCON();
            }
        }
        let a=b=c=d=e=false; // criteria to enable the register button
        function buttonGrey(){
            let button = document.getElementsByName("create");
            if(a && b && c && d && e){
                button[0].disabled=false;
            }else{
                button[0].disabled=true;
            }
        }
        function checkUsername() {
            let un = document.getElementsByName("username");
            let Err = document.getElementById("username");
            if(un[0].value != ""){
                a=evaluate(un,Err,un[0].value.length >= 4 && un[0].value.length <= 15);
            }
            buttonGrey();
        }
        function checkName() {
            let nm = document.getElementsByName("name");
            let Err = document.getElementById("name");
            if(nm[0].value != ""){
                e=evaluate(nm,Err,nm[0].value.length > 0);
            }
            buttonGrey();
        }
        function checkPhone(){
            let ph = document.getElementsByName("phone");
            let Err = document.getElementById("phone");
            if(ph[0].value != ""){
                b=evaluate(ph,Err,ph[0].value.length == 8 && ph[0].value == Number(ph[0].value));
            }
            buttonGrey();
        }
        function checkPW(){
            let pw = document.getElementsByName("password");
            let Err = document.getElementById("password");
            if(pw[0].value != ""){
                c=evaluate(pw,Err,pw[0].value.length >= 4);
            }
            buttonGrey();
        }
        function checkCON(){
            let co = document.getElementsByName("confirm");
            let pw = document.getElementsByName("password");
            let Err = document.getElementById("confirm");
            if(co[0].value != ""){
                d=evaluate(co,Err,co[0].value == pw[0].value);
            }
            buttonGrey();
        }
        function evaluate(name,err,condition){
            if (condition){
                name[0].style.borderColor = "rgb(10, 214, 71)";
                err.style.display = "none";
                return true;
            }else{
                name[0].style.borderColor = "rgb(35, 149, 255)";
                err.style.display = "inline";
                return false;
            }
        }
        function keepInfo(username,phone){
            let un = document.getElementsByName("username");
            let ph = document.getElementsByName("phone");
            un[0].value=username;
            ph[0].value=phone;
        }
    </script>
</body>
</html>