<?php

    $servidor = "localhost:3306";
    $usuario = "root";
    $senha = "";
    $banco_de_dados = "chat";

    $conexao = mysqli_connect($servidor, $usuario, $senha, $banco_de_dados);

    mysqli_set_charset($conexao, 'utf8');
    date_default_timezone_set('America/Sao_Paulo');

    if(!$conexao){

        header('location:../index.php');
        mysqli_close($conexao);

    }
?>