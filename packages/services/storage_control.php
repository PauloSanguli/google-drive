<?php
    function check_storage($_filesize, $usuario_id, $conn){
        $_filesize = convertData($_filesize);

        $query_select = $conn->prepare("SELECT `espaco` FROM `usuario` WHERE `id`='$usuario_id'");
        $query_select->execute();

        $_storage = $query_select->fetchAll()[0]["espaco"];
        // $_storage *= 1024;

        if($_filesize <= $_storage){
            // query_update_storage($_storage-=$_filesize, $usuario_id, $conn);
            return true;
        }else{
            return false;
        }
    }

    function query_update_storage($storage, $usuario_id, $conn){
        try{
            $query = "UPDATE `usuario` SET `espaco`=$storage WHERE `id`=$usuario_id";
            $conn->exec($query);
        }catch (Exception $error) {
            echo $error;
            return false;
        }
        return true;
    }

    // convert bytes to megabyte
    function convertData($v) {
        return ($v/1024)/1024;
    }
?>
