<?php
    // session_start();

     if(!isset($_SESSION["customer_user_id"])){
         header("location: pages/login.php");   
    }
?>