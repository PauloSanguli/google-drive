<?php
    include("columns.php");

    function insert_query($table_name, $values, $conn)
    {
        $parameters = Enum($table_name);
        $query = "INSERT INTO $table_name($parameters) VALUES ($values)";

        return execute_query($query,$conn);
    }

    function select_query($table_name, $conn){
        $query = "SELECT * FROM $table_name";

        $query_prepare = $conn->prepare($query);
        $query_prepare->execute();

        return $query_prepare->fetchall();
    }

    function select_distint_query($id, $column, $conn){
        $query = $conn->prepare("SELECT * from `$column` WHERE `id`='$id'");
        $query->execute();

        return $query->fetchAll()[0];
    }

    function delete_query($table_name, $id, $conn){
        $query = "DELETE FROM $table_name WHERE `id`=$id";
        return execute_query($query, $conn);
    }

    function update_query($table_name, $id, $value, $col, $conn){
        $query = "UPDATE $table_name SET $col='$value' WHERE `id`=$id";
        return execute_query($query,$conn);
    }

    function count_f($table_name, $id, $conn){
        $query = $conn->prepare("SELECT * FROM $table_name WHERE `usuario_id`=$id");
        $query->execute();
        // $query->fetchAll();
        return $query->rowCount();
    }

    function execute_query($query, $conn){
        try{
            $conn->exec($query);
        }
        catch(Exception $error){
            echo $error;
            return false;
        }
        return true;
    }
?>
