
<?php 
session_start(); 

if(!isset($_SESSION['username'])){
    header("location: login");
}
if($_SESSION['role'] == 'admin'){
    header("location: admin/admin");
}

require_once('connection.php');
$un = $_SESSION['username'];
$q = "SELECT * FROM `users` WHERE username='$un'";
$r = mysqli_query($conn, $q);
$user = mysqli_fetch_assoc($r);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div id="nav">
        <div></div>
        <div id="navbar">
            <a class="navButton" href="logout">log out</a>
        </div>
    </div>
    <div id="wrapper">
        <div id="user">
            <img src="<?php echo $user['image'];?>">
            <p class="name"><?php echo $user['name'];?></p>
            <p class="username">@<?php echo $user['username'];?></p>
        </div>
        <div id="about">
            *about user*
        </div>
        <div id="newPost">
        </div>
        <div id="feed">
            <?php
            date_default_timezone_set('Europe/Riga');
            $endDate = new DateTime(date('Y-m-d H:i:s'));

            foreach ($conn->query("SELECT * FROM `posts` ORDER BY `datetime` DESC") as $posts) {
                $startDate = new DateTime(date($posts['datetime']));
                $dateSent = $posts['visualdate'];
                $posterUsername = $posts['username'];
                $content = nl2br($posts['content']);
                $interval = $startDate->diff($endDate);
                $timeSince = reformatTime($interval);
                
                $q = "SELECT * FROM `users` WHERE username='$posterUsername'";
                $r = mysqli_query($conn, $q);
                $poster = mysqli_fetch_assoc($r);
                $posterImg = $poster['image'];
                $posterName = $poster['name'];
                $posterUsername = $poster['username'];

                echo"<div class='feedPost'>
                <div class='feedPoster'>
                    <img class='feedPosterImg' src='$posterImg'>
                    <div>
                        <div class='feedPosterName'>$posterName</div>
                        <div class='feedPosterUsername'>@$posterUsername</div>
                    </div>
                    <div class='feedTimeSince'>$timeSince</div>
                </div>
                <p class='feedContent'>$content</p>
                <div class='feedPostDate'>$dateSent</div>
                </div>";
            }
            function reformatTime($input){
                $year = $input->y;
                $month = $input->m;
                $day = $input->d;
                $hour = $input->h;
                $minute = $input->i;
                if($year > 0){
                    return timeEval($year,"gada","gadiem");
                }else if($month > 0){
                    return timeEval($month,"mēneša","mēnešiem");
                }else if($day > 0){
                    return timeEval($day,"dienas","dienām");
                }else if($hour > 0){
                    return timeEval($hour,"stundas","stundām");
                }else if($minute > 0){
                    return timeEval($minute,"minūtes","minūtēm");
                }else{
                    return "tikko";
                }
            }
            function timeEval($time,$single,$multi){
                if($time == 1){
                    return "pirms $single";
                }else if($time % 10 == 1 && $time % 100 != 11){
                    return "pirms $time $single";
                }else{
                    return "pirms $time $multi";
                }
            }
            ?>
        </div>
        <div id="footer">
            *footer*
        </div>
    </div>
    
</body>
</html>