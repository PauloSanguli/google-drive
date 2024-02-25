<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../src/components/sign_in.css">
    <link rel="stylesheet" href="../src/utils/css/flexbox.min.css">
    <link rel="stylesheet" href="../src/utils/css/default.css">
</head>
<body>
    <form action="../../../index.php?sign_in=true" method="post" class="display-column align-center justify-center">
        <header class="display-column align-center justify-center">
            <span data-text-banner>cell funy</span>
            <p> < Welcome to caf drive / ></p>
        </header>
        <aside class="display-column align-center justify-space-around">
            <label for="inp_name" class="display-column align-flex-start justify-space-between">
                <span data-name>name</span>
                <input type="text" name="name">
            </label>
            <label for="inp_pwd" class="display-column align-flex-start justify-space-between">
                <span data-pwd>password</span>
                <input type="password" name="pwd" id="field-pwd">
            </label>
            <label for="inp_email" class="display-column align-flex-start justify-space-between">
                <span data-email>email</span>
                <input type="email" name="email">
            </label>
            <label for="inp_check" class="display-row align-center justify-flex-start" data-remember-box>
                <input type="checkbox" name="inp_check">
                <span data-check>remember me 3 days</span>
            </label>
            <div class="display-column align-center justify-space-between" data-buttons>
                <input type="submit" value="Regist user" data-submit-datas>
                <p>- or -</p>
                <a href="login.php">Login in your account</a>
            </div>
        </aside>
    </form>
</body>
</html>
<?php
    require("login.php");
?>