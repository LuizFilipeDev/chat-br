<?php
    //LOGOUT DE USUARIOS

    session_name('usuario');
    session_start();


    //VERIFICA SE O USUAIO EFETUOU O LOGIN
    if(!isset($_SESSION['id_usuario'])){

        unset($_SESSION['id_usuario']);
        unset($_SESSION['nome_usuario']);
        unset($_SESSION['id_usuario_conversar_temp']);
        unset($_SESSION['nome_usuario_conversar_temp']);

        header('location:../telas_erros/acesso_negado.html');
        
        session_destroy();

    }else{

        require 'conexao_bd.php';

        $id_usuario = mysqli_real_escape_string($conexao, $_SESSION['id_usuario']); //REMOVE A POSSIBILIDADE DE UM INJECT NO BD


        $comando_mudar_status = "UPDATE usuarios SET status_online = 0 WHERE id_usuario = '$id_usuario'"; //SETA O USUARIO COMO OFFLINE

        $mudar_status = mysqli_query($conexao, $comando_mudar_status);


        unset($_SESSION['id_usuario']);
        unset($_SESSION['nome_usuario']);
        unset($_SESSION['id_usuario_conversar_temp']);
        unset($_SESSION['nome_usuario_conversar_temp']);
        

        header('location:../index.php');

        mysqli_close($conexao);

    }


?>