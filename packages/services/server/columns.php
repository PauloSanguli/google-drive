<?php
    function Enum($_table){
        $enum_columns = array(
            "usuario"=>"nome,password,email",
            "arquivo"=>"nome_ficheiro","ficheiro","usuario_id",
            "compartilhados"=>"usuario_id,arquivo_id,email_amigo",
            "comentarios"=>"conteudo,arquivo_id,email",
            "respostas"=>"conteudo,comentarios_id,email"
        );
        return $enum_columns[$_table];
    }
?>