<?php
    $banco = new mysqli("localhost", "root", "", "db_games");
    if($banco -> connect_errno){
        echo "Foi encontrado um erro  ao conectar ao banco de dados";
        die();
    }
    //Comptibilidade Utf-8
    $banco -> query("SET NAMES 'utf8'");
    $banco -> query("SET character_set_connection=utf8");
    $banco -> query("SET character_set_client=utf8");
    $banco -> query("SET character_set_results=utf8");
    
    
?>