<?php

    session_name('usuario');
    session_start();

    require 'conexao_bd.php';

    //VERIFICA SE O USUAIO EFETUOU O LOGIN
    if(!isset($_POST['nome_usuario']) && !isset($_POST['nome_usuario_bloqueou']) && !isset($_POST['id_usuario_bloqueou'])){

        unset($_SESSION['id_usuario']);
        unset($_SESSION['nome_usuario']);
        unset($_SESSION['id_usuario_conversar_temp']);
        unset($_SESSION['nome_usuario_conversar_temp']);

        header('location:../telas_erros/acesso_negado.html');
        
        session_destroy();

        mysqli_close($conexao);

    }else{


    $id_bloqueio = $_POST['id_usuario_bloqueio'];
    $nome_bloqueio = $_POST['nome_usuario_bloqueio'];

    $id_usuario_bloqueou = $_POST['id_usuario_bloqueou'];
    $nome_usuario_bloqueou = $_POST['nome_usuario_bloqueou'];

    $comando_bloqueio = "INSERT INTO usuarios_bloqueados(id_usuario_bloqueou, nome_usuario_bloqueou, id_usuario_bloqueado, nome_usuario_bloqueado)
                                                        VALUES('$id_usuario_bloqueou', '$nome_usuario_bloqueou', '$id_bloqueio', '$nome_bloqueio')";
    
    $inquerir_bloqueio = mysqli_query($conexao, $comando_bloqueio);


    mysqli_close($conexao);

    }

?>