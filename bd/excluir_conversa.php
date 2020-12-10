<?php


    session_name('usuario');
    session_start();

    //CADASTRO DE USUARIOS
    require 'conexao_bd.php';

    //VERIFICA SE O USUAIO EFETUOU O LOGIN
    if(!isset($_SESSION['nome_usuario']) && !isset($_POST['id_conversa']) && !isset($_POST['id_usuario_conversando'])){

        unset($_SESSION['id_usuario']);
        unset($_SESSION['nome_usuario']);
        unset($_SESSION['id_usuario_conversar_temp']);
        unset($_SESSION['nome_usuario_conversar_temp']);

        header('location:../telas_erros/acesso_negado.html');
        
        session_destroy();

    }else{

        $id_usuario = $_SESSION['id_usuario'];

        $id_conversa = $_POST['id_conversa']; //ID DA RESPECTIVA CONVERSA
        $id_usuario_conversando = $_POST['id_usuario_conversando']; //ID DO OUTRO USUARIO QUE ESTA NA CONVERSA





        //PEGA AS MENSAGENS DA RESPECTIVA CONVERSA
        function Verificar_Coversa_Mensagens(){

            require 'conexao_bd.php';

            global $id_conversa;

            $comando_verificar_mensagens = "SELECT * FROM mensagens WHERE id_conversa_mensagens = '$id_conversa'";

            $inquerir_verificacao = mysqli_query($conexao, $comando_verificar_mensagens);

            return $inquerir_verificacao;
        }






        //EXCLUIU A CONVERSA SE NAO CONTER MENSAGENS COM O ID DA CONVERSA
        function Excluir_Conversa(){

            require 'conexao_bd.php';

            global $id_conversa;

            $numero_mensagens_conversa = mysqli_num_rows(Verificar_Coversa_Mensagens());

            if($numero_mensagens_conversa == 0){

                $comando_deletar_conversas = "DELETE FROM conversas WHERE id_conversa = '$id_conversa'";
        
                $inquerir_exclusao = mysqli_query($conexao, $comando_deletar_conversas);
        
            }

        }






        $verificar_mensagens = Verificar_Coversa_Mensagens();

        //PEGA TODAS AS MENSAGENS COM O ID DA CONVERSA
        while($verificar_exclusao = mysqli_fetch_array($verificar_mensagens)){


            //VERIFICA SE O OUTRO USUARIO JA EXCLUIU AS MENSAGENS
            if($verificar_exclusao['id_usuario_excluiu_primeiro'] == 0){
    
                $teste[] = $verificar_exclusao['id_usuario_excluiu_primeiro']; //ARMAZENA TODOS OS IDS DE EXCLUSAO RELACIONADOS A 0

                foreach ($teste as $deletar) {


                    $comando_atualizar_mensagens = "UPDATE mensagens SET id_usuario_excluiu_primeiro = '$id_usuario' WHERE id_conversa_mensagens = '$id_conversa' AND id_usuario_excluiu_primeiro = '$deletar'";

                    $inquerir_atualizacao_mensagens = mysqli_query($conexao, $comando_atualizar_mensagens);


                    //REMOVE AS CONVERSAS DA LISTA DE CONVERSA DO USUARIO
                    $comando_atualizar_conversas = "UPDATE conversas SET id_usuario_excluiu_primeiro = '$id_usuario' WHERE id_conversa = '$id_conversa'";

                    $inquerir_atualizacao_conversas = mysqli_query($conexao, $comando_atualizar_conversas);


                }



            //VERIFICA NO CASO DO OUTRO USUARIO JA TER EXCLUIDO AS MENSAGENS
            }else if($verificar_exclusao['id_usuario_excluiu_primeiro'] != 0 && $verificar_exclusao['id_usuario_excluiu_primeiro'] != $id_usuario){
                
                $teste[] = $verificar_exclusao['id_usuario_excluiu_primeiro']; //ARMAZENA TODOS OS IDS DE EXCLUSAO DIFERENTES DE 0 E DIFERENTES DO ID DO USUARIO

                foreach ($teste as $deletar) {


                    $comando_deletar_mensagens = "DELETE FROM mensagens WHERE id_usuario_excluiu_primeiro = '$deletar'";

                    $inquerir_exclusao = mysqli_query($conexao, $comando_deletar_mensagens);

                }

                Excluir_Conversa();



            }

        }
    }

?>