<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="croppie.css" />
    <link rel="stylesheet" href="style.css" />
    <script src="croppie.js"></script>
</head>
<body>
    <div id="wrapper">
        <form action="upload.php" method="post" enctype="multipart/form-data" id="myform">
            <input type="file" name="fileToUpload" id="fileToUpload" oninput="postMyImage()" style="display:none;">
            <div id="vanilla-demo"><div id="warn">Upload an image first!</div></div>
            <label for="fileToUpload">Choose a file</label>
            <input type="button" value="done" class="vanilla-result" onclick="cropMyImage()">
            <div id="demo"></div>
        </form>
    </div>
    <form action="base64.php" method="post" id="base64" style="display:none;">
        <input type="text" name="base64ImageToUpload" id="base64ImageToUpload">
    </form>
    
    <?php
    if(isset($_SESSION['image'])){
        $imageuploaded = $_SESSION['image'];
        echo "<script> imageuploaded = 'tmp/$imageuploaded'</script>";
    }
    ?>
    <script>
        var imageuploaded;
        var button = document.getElementsByClassName("vanilla-result");
        var overlay = document.getElementById('warn');
        if(imageuploaded == undefined){
            button[0].disabled=true;
            overlay.style.visibility="visible";
        }
        var el = document.getElementById('vanilla-demo');
        var theForm = document.getElementById('myform');
        var base64Form = document.getElementById('base64');
        var vanilla = new Croppie(el, {
            viewport: { width: 200, height: 200, type: 'circle'},
            boundary: { width: 350, height: 250 },
            showZoomer: false,
        });
        vanilla.bind({
            url: imageuploaded,
        });
        function cropMyImage(){
            vanilla.result({
                type: 'base64',
                //size: { width: 100, height: 100 },
                circle: false
                }).then(function(base64) {
                
                // document.getElementById("demo").innerHTML = "<img style='border-radius:50%' src='"+base64+"'>";
                document.getElementById("base64ImageToUpload").value = base64;
                base64Form.submit();
            });
        }
        function postMyImage(){
            theForm.submit();
        }
    </script>
    
</body>
</html>