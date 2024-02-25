<?php
    include("packages/services/sistema.php");

    $sistema = new App();
    
    if(isset($_GET["storage"])){
        // send the file in db
        
        if(isset($_POST["filename"]) && $_POST["filename"] != ""){
            $_filename = $_POST["filename"];
        }else{
            $_filename = $_FILES["fih"]["name"];
        }

        $_filesize = $_FILES["fih"]["size"];
        $_file_tmp = $_FILES["fih"]["tmp_name"];
        
        $response = $sistema->armazenar_arquivo($_file_tmp, $_filesize, $_filename);

        header("location: packages/views/main.php?message=$response[0]&color=$response[1]");
    }
    else if(isset($_GET["sign_in"])){
        // create the account

        $username = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["pwd"];

        $sistema->cadastrar_usuario($username, $password, $email);

        $sistema->login($email, $password);

        header("location: packages/views/main.php");
    }else if(isset($_GET["login"])){
        // login user

        $email = $_POST["email"];
        $password = $_POST["pwd"];

        $sistema->login($email, $password);
        header("location: packages/views/main.php");
    }else if(isset($_GET["delete"], $_GET["tamanho"])){
        $responseDelete = $sistema->delete_file($_GET["id"], $_GET["tamanho"]);
        if($responseDelete) {
            $message = "arquivo eliminado";
            $color = "green";
        }else{
            $message = "arquivo não eliminado";
            $color = "red";
        }
        header("location: packages/views/main.php?message=$message&color=$color");
    }
    else{
        // redirect to main page
        header("location: packages/views/main.php");
    }

    ?>
