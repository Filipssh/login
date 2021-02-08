<?php
session_start();
$imageuploaded = $_SESSION['image'];
unlink("tmp/$imageuploaded");
unset($_SESSION['image']);
$data = $_POST["base64ImageToUpload"];
$filename_path = md5(time().uniqid()).".png";
// echo $base64_string_img;
// echo "<br>";
$decoded = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
//$decoded = base64_decode($base64_string_img);
//echo $decoded;
file_put_contents("cropped/".$filename_path,$decoded);
$_SESSION['userImage'] = "../croppie/cropped/".$filename_path;
header("location: ../loginPD/create.php");
?>