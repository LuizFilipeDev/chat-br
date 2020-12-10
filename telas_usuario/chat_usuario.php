
<?php
    session_name('usuario');
    session_start();

    //VERIFICA SE O USUAIO EFETUOU O LOGIN
    if(!isset($_SESSION['nome_usuario'])){

        unset($_SESSION['id_usuario']);
        unset($_SESSION['nome_usuario']);
        unset($_SESSION['id_usuario_conversar_temp']);
        unset($_SESSION['nome_usuario_conversar_temp']);

        header('location:../index.php');
        
        session_destroy();

    }else{

        //ARMAZENA NOME E ID DO USUARIO DA SESSAO
        $nome_usuario = $_SESSION['nome_usuario'];
        $id_usuario = $_SESSION['id_usuario'];

        require '../bd/conexao_bd.php';

        //VERIFICA SE RECEBEU ID E NOME USUARIO DA PESSOA COM QUEM IRA CONVERSAR
        if(isset($_POST['id_usuario_conversar']) && isset($_POST['nome_usuario_conversar'])){

            $_SESSION['id_usuario_conversar_temp'] = mysqli_real_escape_string($conexao, $_POST['id_usuario_conversar']);
            $_SESSION['nome_usuario_conversar_temp'] = mysqli_real_escape_string($conexao, $_POST['nome_usuario_conversar']);

        }

        //ARMAZENA NOME E ID DO USUARIO QUE IRA RECEBER AS MENSAGENS TEMPORARIAMENTE
        $id_usuario_conversar = $_SESSION['id_usuario_conversar_temp'];
        $nome_usuario_conversar = $_SESSION['nome_usuario_conversar_temp'];

        echo $id_usuario_conversar; //REMOVER
        echo $nome_usuario_conversar; //REMOVER
        echo $nome_usuario; //REMOVER
        echo $id_usuario; //REMOVER


?>

<!DOCTYPE html>

<html lang="pt-BR">

    <head>

        <noscript><meta http-equiv="refresh" content="0; url=../telas_erros/sem_js_index_usuario.html"></noscript>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chat</title>

        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/chat_usuario.css">

        <script src="../js/font.js"></script>

    </head>

    <body>

        <div class = "container">

            <!--INICIO TITULO DA PAGINA-->
            <div id = "titulo" class = "text-center col-sm-12 col-md-8 col-lg-8 col-xl-8 offset-md-2 offset-lg-2 offset-xl-2">

                <h2><small>Conversando com</small> <?php echo $nome_usuario_conversar?></h2>

            </div>
            <!--FIM TITULO DA PAGINA-->


            <!--INICIO PAINEL DO CHAT-->
            <div id  = "painel" class = "shadow-lg p-3 rounded col-sm-12 col-md-8 col-lg-8 col-xl-8 offset-md-2 offset-lg-2 offset-xl-2">
                
                <!--INICIO MENSAGENS-->
                <div id = "atualizar-pagina">

                    <?php

                        //PEGA TODAS AS MENSAGENS DOS USUARIOS NA CONVERSA NO BD
                        $comando_buscar_mensagens = "SELECT * FROM mensagens WHERE  id_usuario_mensagens = '$id_usuario' AND id_usuario_destino_mensagens = '$id_usuario_conversar'
                                                                                    OR id_usuario_mensagens = '$id_usuario_conversar' AND id_usuario_destino_mensagens = '$id_usuario' 
                                                                                    ORDER BY id_mensagens ASC";

                        $inquerir_mensagens = mysqli_query($conexao, $comando_buscar_mensagens);



                        //INICIO WHILE MOSTRAR MENSAGENS
                        while($mensagens = @mysqli_fetch_array($inquerir_mensagens)){


                            $data_formatada =  date('d/m/Y H:i', strtotime($mensagens['data_mensagem']));


                            if($mensagens['id_usuario_excluiu_primeiro'] != $id_usuario){
                                //INICIO VERIFICAÇÃO SE A MENSAGEM É DO MESMO USUARIO DA SESSAO
                                if($mensagens['nome_usuario_mensagens'] !=  $nome_usuario){

                    ?>
                                
                                <div id = "mensagem" class = "shadow p-3 mb-5 col-sm-12 col-md-6 col-lg-6 col-xl-6">

                                    <h4><?php echo $mensagens['nome_usuario_mensagens']?></h4>
                                    <p class = "mensagem"><?php echo $mensagens['mensagem_usuario_mensagens']?></p>
                                    <div class = "data-mensagem"><?php echo $data_formatada?></div>
            
                                </div>
                    
                    <?php
                            //SE NAO FOR O MESMO USUARIO DA SESSAO ELE MOSTRA A MENSAGEM DE OUTRA FORMA
                                }else{
                    
                    ?>

                                <div id = "mensagem-usuario" class = "text-right shadow p-3 mb-5 col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 offset-md-6 offset-lg-6 offset-xl-6">

                                    <h4><?php echo $mensagens['nome_usuario_mensagens']?></h4>
                                    <p class = "mensagem"><?php echo $mensagens['mensagem_usuario_mensagens']?></p>
                                    <div class = "data-mensagem"><?php echo $data_formatada?></div>
                                    
                                </div>
                    
                    <?php
                                }
                                //FIM VERIFICAÇÃO SE A MENSAGEM É DO MESMO USUARIO DA SESSAO
                        }
                        //FIM WHILE MOSTRAR MENSAGENS

                    }

                    ?>

                </div>
                <!--FIM MENSAGENS-->


            </div>
            <!--FIM PAINEL DO CHAT-->


            <!--INICIO CAMPO TEXTO E BOTAO ENVIAR-->
            <div id = "campo-texto" class = "rounded col-sm-12 col-md-8 col-lg-8 col-xl-8 offset-md-2 offset-lg-2 offset-xl-2">

                <div class="form-group">

                    <textarea class="shadow p-3 rounded form-control" id="text-area" rows="3" placeholder = "Escreva alguma coisa para <?php echo $nome_usuario_conversar?>.."></textarea>

                </div>

                <a href = "#atualizar-pagina" onclick = "Mandar_Mensagem('<?php echo $nome_usuario?>', <?php echo $id_usuario?>, <?php echo $id_usuario_conversar?>, '<?php echo $nome_usuario_conversar?>')" id = "btn-enviar-mensagem" type="button" class="btn btn-success shadow p-3 mb-4 rounded">Enviar Mensagem</a>
                
                <a href = "index_usuario.php" type="button" id = "btn-voltar-menu" class="btn btn-danger shadow p-3 mb-5 rounded">Voltar</a>

            </div>
            <!--FIM CAMPO TEXTO E BOTAO ENVIAR-->

        </div>
        
        <script src="../js/jquery.js"></script>
        <script src="../js/popper.min.js" ></script>
        <script src="../js/bootstrap.min.js"></script>

        <script>


            //VERIFICA SE O MOUSE ESTA EM CIMA DA PAGINA DAS MENSAGENS 
            let atualizar_posicao_scroll = true;

                        
            $( "#painel" ).on( "mouseenter", function() { //SE ESTIVER ELE NAO ATUALIZA POSIÇÃO DO SCROLL


                atualizar_posicao_scroll = false;

                console.log(atualizar_posicao_scroll); //REMOVER

            }).on( "mouseleave", function() { //SE NÃO ESTIVER ELE NÃO ATUALIZA A POSIÇÃO DOP SCROLL

                atualizar_posicao_scroll = true;

                console.log(atualizar_posicao_scroll); //REMOVER

            });





            //SETA O SCROLL NO FIM DA PAGINA APOS ATUALIZAÇÃO
            $('#painel').scrollTop($(this).height() + 10000);





            //ATUALIZA A PAGINA DE MENSAGENS APOS DETERMINADO TEMPO
            setInterval(function(){  

                $( "#atualizar-pagina" ).load( "chat_usuario.php #atualizar-pagina", function() {

                    if(atualizar_posicao_scroll == true){//ATUALIZA A POSIÇÃO DO SCROLL DA PAGINA DAS MENSAGENS PARA A ULTIMA MENSAGEM

                        $('#painel').animate({
                            scrollTop:($(this).height() + 10000)
                        }, 1000, function(){

                            //atualizar_posicao_scroll = false;
                            
                        });

                    }

                });

            }, 1000);






            function Mandar_Mensagem(nome_usuario_mandou, id_usuario_mandou, id_usuario_destino, nome_usuario_destino){
                
                var v_nome_usuario = nome_usuario_mandou;
                var v_id_usuario = id_usuario_mandou;
                var v_id_usuario_destino = id_usuario_destino;
                var v_nome_usuario_destino = nome_usuario_destino;


                var v_mensagem = $('#text-area').val();

                //alert('-----JAVASCRIPT------'+v_nome_usuario + '-----' + v_id_usuario + '-----' + v_id_usuario_destino + '-----' + v_nome_usuario_destino + '-----' + v_mensagem);

                if(v_mensagem != ''){

                    $.ajax({

                        type:'POST',
                        url:'../bd/registrar_mensagem.php',
                        dataType: "html",
                        data:{nome:v_nome_usuario, id:v_id_usuario, id_destino:v_id_usuario_destino, nome_destino:v_nome_usuario_destino, mensagem:v_mensagem},
                        success:function(data){
                            //alert(data);
                        }

                    });

                    $('#text-area').val('');

                }else{

                    alert('Escreva algo para mandar !');
                }


            }





        </script>
        
    </body>

</html>
<?php
    }
    mysqli_close($conexao);
?>