<?php

    session_name('usuario');
    session_start();

    //LOGIN DE USUARIOS
    require 'conexao_bd.php';

    //VERIFICA SE O USUAIO EFETUOU O LOGIN
    if(!isset($_POST['numero_usuario']) && !isset($_POST['senha_usuario'])){

        unset($_SESSION['id_usuario']);
        unset($_SESSION['nome_usuario']);
        unset($_SESSION['id_usuario_conversar_temp']);
        unset($_SESSION['nome_usuario_conversar_temp']);

        header('location:../telas_erros/acesso_negado.html');
        
        session_destroy();

    }else{

        $telefone = mysqli_real_escape_string($conexao, $_POST['numero_usuario']); //REMOVE A POSSIBILIDADE DE UM INJECT NO BD
        $senha = mysqli_real_escape_string($conexao, $_POST['senha_usuario']); //REMOVE A POSSIBILIDADE DE UM INJECT NO BD



        $telefone_formatado = preg_replace("[^a-zA-Z0-9_]", "", $telefone); //REMOVE TODOS CARACTERES ESPECIAS

        $numero_telefone = str_replace("(", "", str_replace(")", "", $telefone_formatado)); //REMOVE TODOS CARACTERES ESPECIAS



        $senha_formatada = preg_replace("[^a-zA-Z0-9_]", "", $senha); //REMOVE TODOS CARACTERES ESPECIAIS

        $senha_criptografada = md5($senha_formatada); //CRIPTOGRAFA A SENHA


        //VERIFICA SE O USUARIO EXISTE NO BANCO DE DADOS
        $comando_verificar_usuario = "SELECT * FROM usuarios WHERE telefone_usuario = '$numero_telefone' AND senha_usuario = '$senha_criptografada'"; 

        $inquerir_usuario = mysqli_query($conexao, $comando_verificar_usuario);

        $usuario_existente = mysqli_num_rows($inquerir_usuario);

        $usuario = mysqli_fetch_array($inquerir_usuario);


        if($usuario_existente > 0 && $usuario['status_online'] == 0){

            

            session_name('usuario'); //INICIA A SESSAO DO USUARIO
            session_start();

            $_SESSION['nome_usuario'] = $usuario['nome_usuario']; //ARMAZENA NA SESSAO O USUARIO
            $_SESSION['id_usuario'] = $usuario['id_usuario']; //ARMAZENA NA SESSAO O USUARIO

            $id_usuario = $usuario['id_usuario'];


            $comando_mudar_status = "UPDATE usuarios SET status_online = 1 WHERE telefone_usuario = '$numero_telefone'"; // SETA O USUARIO COMO ONLINE

            $mudar_status = mysqli_query($conexao, $comando_mudar_status);


            header('location:../telas_usuario/index_usuario.php');

            mysqli_close($conexao);



        }else if($usuario_existente > 0 && $usuario['status_online'] == 1){



            header('location:../telas_erros/index_erro_online.php');

            mysqli_close($conexao);

        }else{



            header('location:../telas_erros/index_erro.php');

            mysqli_close($conexao);


        }

    }
?>