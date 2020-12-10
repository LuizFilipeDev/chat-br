<?php

    session_name('usuario');
    session_start();

    require 'conexao_bd.php';

    //VERIFICA SE O USUAIO EFETUOU O LOGIN
    if(!isset($_POST['nome_usuario']) && !isset($_POST['id_usuario_desbloqueio']) && !isset($_POST['id_usuario_desbloqueou'])){

        unset($_SESSION['id_usuario']);
        unset($_SESSION['nome_usuario']);
        unset($_SESSION['id_usuario_conversar_temp']);
        unset($_SESSION['nome_usuario_conversar_temp']);

        header('location:../telas_erros/acesso_negado.html');
        
        session_destroy();

        mysqli_close($conexao);

    }else{


    $id_desbloqueio = $_POST['id_usuario_desbloqueio'];

    $id_usuario_desbloqueou = $_POST['id_usuario_desbloqueou'];


    $comando_desbloqueio = "DELETE FROM usuarios_bloqueados WHERE id_usuario_bloqueou = '$id_usuario_desbloqueou' AND id_usuario_bloqueado = '$id_desbloqueio'";
    
    $inquerir_desbloqueio = mysqli_query($conexao, $comando_desbloqueio);


    mysqli_close($conexao);

    }

?>