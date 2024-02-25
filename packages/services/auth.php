<?php
    session_start();

    function get_user_logged(){
        //get user logged by session

        // $response_auth = Array();
        if(isset($_SESSION["customer_user_id"])){
            $response = Array(json_encode($_SESSION["customer_user_id"]), true);
        }else{
            $response = Array(0, false);
        }
        return $response;
    }
?>