<?php
    //REGISTRAR MENSAGENS

    session_name('usuario');
    session_start();

    require 'conexao_bd.php';


    //VERIFICA SE O USUAIO EFETUOU O LOGIN
    if(!isset($_SESSION['nome_usuario']) && !isset($_POST['nome']) && !isset($_POST['id'])){

        unset($_SESSION['id_usuario']);
        unset($_SESSION['nome_usuario']);
        unset($_SESSION['id_usuario_conversar_temp']);
        unset($_SESSION['nome_usuario_conversar_temp']);

        header('location:../telas_erros/acesso_negado.html');
        
        session_destroy();

    }else{

        //REMETENTE

        $nome_usuario = mysqli_real_escape_string($conexao, $_POST['nome']);

        $id_usuario = mysqli_real_escape_string($conexao, $_POST['id']);



        $data_mensagem = date('Y-m-d H:i');

        $data_mensagem_string = strval($data_mensagem);

        //DESTINATARIO

        $id_usuario_destino = mysqli_real_escape_string($conexao, $_POST['id_destino']);

        $nome_usuario_destino = mysqli_real_escape_string($conexao, $_POST['nome_destino']);

        $mensagem = mysqli_real_escape_string($conexao, $_POST['mensagem']);


        //CONVERTER OS IDS      

        $id_usuario_convert = intval($id_usuario);

        $id_usuario_destino_convert = intval($id_usuario_destino);


        //FUNÇÃO RESPONSAVEL POR CADASTRAR AS MENSAGENS
        function Cadastrar_Mensagem($id_conversa){

            global $id_usuario_convert, $nome_usuario, $id_usuario_destino_convert, $nome_usuario_destino, $mensagem, $data_mensagem_string;

            require 'conexao_bd.php';

            $comando = "INSERT INTO mensagens(id_usuario_mensagens, nome_usuario_mensagens, id_usuario_destino_mensagens, nome_usuario_destino_mensagens,
                                            mensagem_usuario_mensagens, id_conversa_mensagens, id_usuario_excluiu_primeiro, data_mensagem)
            VALUES('$id_usuario_convert', '$nome_usuario','$id_usuario_destino_convert', '$nome_usuario_destino', '$mensagem', '$id_conversa', 0, '$data_mensagem_string')";

            $inquerir = mysqli_query($conexao, $comando);


            //RECUPERAR CONVERSA COM USUARIO
            $comando_atualizar_conversas = "UPDATE conversas SET id_usuario_excluiu_primeiro = 0 WHERE id_conversa = '$id_conversa'";

            $inquerir_atualizacao_conversas = mysqli_query($conexao, $comando_atualizar_conversas);

        }


        //INICIO VERIFICAÇÃO DA EXISTENCIA DA CONVERSA COM O USUARIO

        function Verificar_Usuario(){

            require 'conexao_bd.php';

            global $id_usuario, $id_usuario_destino;

            $comando_verificar_usuario_existente = "SELECT * FROM conversas WHERE id_usuario_conversa = '$id_usuario' AND id_usuario_iniciou_conversa = '$id_usuario_destino' 
                                                    OR id_usuario_conversa = '$id_usuario_destino' AND id_usuario_iniciou_conversa = '$id_usuario'";

            $inquerir_verificacao_usuario_existente = mysqli_query($conexao, $comando_verificar_usuario_existente);

            return $inquerir_verificacao_usuario_existente;

        }


        $usuario_existente = mysqli_num_rows(Verificar_Usuario());
        
        $selecionar_conversa = mysqli_fetch_row(Verificar_Usuario());




        
        //SE CASO O USUARIO NAO ESTIVER INICIADO A CONVERSA COM A PESSOA, UMA NOVA CONVERSA SERÁ INICIADA
        if($usuario_existente <= 0){


            
            //IRA REGISTRAR UMA NOVA CONVERSA
            $comando_iniciar_conversa = "INSERT INTO conversas(id_usuario_conversa, nome_usuario_conversa, id_usuario_iniciou_conversa, nome_usuario_iniciou_conversa, id_usuario_excluiu_primeiro)
                                                        VALUES('$id_usuario_destino', ' $nome_usuario_destino', '$id_usuario', '$nome_usuario', 0)";

            $inquerir_conversa = mysqli_query($conexao, $comando_iniciar_conversa);


            $selecionar_conversa_verificada = mysqli_fetch_row(Verificar_Usuario());


            Cadastrar_Mensagem($selecionar_conversa_verificada[0]);

            mysqli_close($conexao);


        }else{


            //CADASTRA A MENSAGEM DE ACONDO COM A CONVERSA EXISTENTE
            Cadastrar_Mensagem($selecionar_conversa[0]);

            mysqli_close($conexao);



        }
    
    }

?>