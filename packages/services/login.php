<?php
    function credenciais_usuario($email, $pwd, $conn){
        $connection_pr = new DB("localhost","root", "google_drive");
        $conn = $connection_pr->connect();

        $query = $conn->prepare("SELECT `id` FROM `usuario` WHERE `email`='$email' and `password`='$pwd'");
        $query->execute();
        
        $result = $query->fetchAll()[0];
        
        if($query->rowCount()>0){
            session_start();
            $_SESSION["customer_user_id"] = $result["id"];
            echo "credenciais autenticadas";
        }else{
            echo "credenciais erradas";
        }
    }
?>