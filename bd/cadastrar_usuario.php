<?php

    session_name('usuario');
    session_start();

    //CADASTRO DE USUARIOS
    require 'conexao_bd.php';

    //VERIFICA SE O USUAIO EFETUOU O LOGIN
    if(!isset($_SESSION['nome_usuario']) && !isset($_POST['nome']) && !isset($_POST['telefone'])){

        unset($_SESSION['id_usuario']);
        unset($_SESSION['nome_usuario']);
        unset($_SESSION['id_usuario_conversar_temp']);
        unset($_SESSION['nome_usuario_conversar_temp']);

        header('location:../telas_erros/acesso_negado.html');
        
        session_destroy();

    }else{

        $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
        $telefone = mysqli_real_escape_string($conexao, $_POST['telefone']);
        $senha = $_POST['senha'];

        $data_cadastro = date('Y-m-d H:i');

        $data_cadastro_string = strval($data_cadastro);

        $nome_formatado = preg_replace("[^a-zA-Z0-9_]", "", $nome); //REMOVE TODOS CARACTERES ESPECIAS


        $telefone_formatado = preg_replace("[^a-zA-Z0-9_]", "", $telefone); //REMOVE TODOS CARACTERES ESPECIAS

        $numero_telefone = str_replace("(", "", str_replace(")", "", $telefone_formatado)); //REMOVE TODOS CARACTERES ESPECIAS


        $senha_formatada = preg_replace("[^a-zA-Z0-9_]", "", $senha); //CRIPTOGRAFA A SENHA

        $senha_criptografada = md5($senha_formatada);
        

        //VERIFICAR SE O NUMERO JA ESTA CADASTRADO NO SISTEMA
        $comando_verificar = "SELECT * FROM usuarios WHERE telefone_usuario = '$numero_telefone' OR nome_usuario = '$nome_formatado'";

        $inquerir_verificacao = mysqli_query($conexao, $comando_verificar);

        $usuario = mysqli_num_rows($inquerir_verificacao);

        //VERIFICA SE OS CAMPOS ESTAO PREENCHIDOS PARA FAZER O REGISTRO NO BANCO
        if($nome_formatado != "" && $numero_telefone != "" && $senha_criptografada != "" && $usuario == 0){



            $comando_cadastrar = "INSERT INTO usuarios(nome_usuario, telefone_usuario, senha_usuario, status_online, data_cadastro)
            VALUES('$nome_formatado', '$numero_telefone', '$senha_criptografada', 0, '$data_cadastro_string')";

            $inquerir_cadastro = mysqli_query($conexao, $comando_cadastrar);

            echo 'Cadastro efetuado com sucesso!';

            mysqli_close($conexao);

        }else{

            echo 'Telefone de usuário ou nome de usuário já está cadastrado!';

            mysqli_close($conexao);
        }
        
    }

?>