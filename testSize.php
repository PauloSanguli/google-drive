<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="file_" id="file">
        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php
    if (isset($_FILES["file_"])){
        $file = $_FILES["file_"];
        try{
            $fp = fopen($file["tmp_name"], "rb");
            $_file_readed = fread($fp, $file["size"]);
            $_file_binary = addslashes($_file_readed);
            fclose($fp);

            // echo $_file_binary;
            echo "</br>File size: ",$file["size"];
            echo "</br>File type: ",filetype($file["tmp_name"]);
            echo "</br>File size2: ",filesize($file["tmp_name"]);
        }catch(exception $err) {
            echo $err;
        }
    }
?>