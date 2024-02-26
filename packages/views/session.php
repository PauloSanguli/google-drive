<?php
    // session_start();
    function redirectUser() {
        if(!isset($_SESSION["customer_user_id"])){
            header("location: pages/login.php?ad=9",true,302);
        }
    }
    redirectUser();
?>