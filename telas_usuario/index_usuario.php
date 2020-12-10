
<?php
    session_name('usuario');
    session_start();

    //VERIFICA SE O USUAIO EFETUOU O LOGIN
    if(!isset($_SESSION['nome_usuario'])){

        //SE NAO ELE LIMPA TODAS AS SESSOES
        unset($_SESSION['id_usuario']);
        unset($_SESSION['nome_usuario']);
        unset($_SESSION['id_usuario_conversar_temp']);
        unset($_SESSION['nome_usuario_conversar_temp']);

        header('location:../index.php');

        session_destroy(); //DESTROI A SESSAO ATUAL

    }else{

        //SE NAO ELE ARMAZENA O USUARIO E LIMPA O USUARIO DA CONVERSA TEMPORARIA
        $id_usuario = $_SESSION['id_usuario'];
        $nome_usuario = $_SESSION['nome_usuario'];

        unset($_SESSION['id_usuario_conversar_temp']);
        unset($_SESSION['nome_usuario_conversar_temp']);

        echo $id_usuario; //REMOVER
        echo $nome_usuario; //REMOVER




        //FUNÇÃO RESPONSAVEL POR VERIFICAR O STATUS ONLINE/OFFLINE DO USUARIO EM ESPECIFICO PELO ID DENTRO DO BD 
        function Status_Usuario($id_usuario_buscar_status){

            require '../bd/conexao_bd.php';

            $comando_buscar_status = "SELECT status_online FROM usuarios WHERE id_usuario = '$id_usuario_buscar_status'";

            $inquerir_status_usuario = mysqli_query($conexao, $comando_buscar_status);

            $status_usuario = mysqli_fetch_row($inquerir_status_usuario);

            return $status_usuario[0];
        }



?>

<!DOCTYPE html>

<html lang="pt-BR">

    <head>

        <noscript> <meta http-equiv="refresh" content="0; url=../telas_erros/sem_js_index_usuario.html"> </noscript>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Chat</title>

        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/index_usuario.css">

        <script src="../js/font.js"></script>

    </head>

    <body>

        <div class="container">




            <!--INICIO TITULO DO SITE-->
            <div class = "text-center">

                <h2 class = "mb-4 mt-3" >ChatBr</h2>

                <h3>Seja Bem-vindo <?php echo $_SESSION['nome_usuario']?></h3>

            </div>
            <!--FIM TITULO DO SITE-->





            <!--INICIO MENU USUARIO-->
            <div class="shadow-lg p-3 mb-3 col-sm-12 col-md-12 col-lg-8 col-xl-8 offset-lg-2 offset-xl-2" id = "navegacao">


                <!--INICIO LISTA DO MENU USUARIO-->
                <ul class="nav nav-tabs  nav-fill" role="tablist" id = "menu-usuario">



                
                    <li class="nav-item">

                        <a class="nav-link" id="conversas-tab" data-toggle="tab" href="#conversas" role="tab" aria-controls="conversas" aria-selected="true">Conversas Recentes</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link active" id="novos-contatos-tab" data-toggle="tab" href="#novos-contatos" role="tab" aria-controls="novos-contatos" aria-selected="false">Novos Contatos</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" id="contatos-bloqueados-tab" data-toggle="tab" href="#contatos-bloqueados" role="tab" aria-controls="contact" aria-selected="false">Contatos Bloqueados</a>
                    
                    </li>




                </ul>
                <!--FIM LISTA DO MENU USUARIO-->



                <!--INICIO DOS CONTEUDOS DOS LINKS DO MENU USUARIO-->
                <div class="tab-content" id="conteudo-tabela">




                    <!--INICIO CHATS DO USUARIO-->
                    <div class="tab-pane fade " id="conversas" role="tabpanel" aria-labelledby="conversas-tab">

                        <ul class="list-group" id = "lista-conversas">


                            <?php

                                //INICIA A CONEXÃO COM BANCO DE DADOS 
                                require '../bd/conexao_bd.php';


                                //FAZER BUSCA POR CHATS QUE O USUARIO INICIOU OU OUTRAS PESSOAS INICIARAM // COM A REGRA DE EXCLUSAO POR ID
                                //E COM A REGRA DE BLOQUERIO DE USUARIO
                                $comando_buscar_conversas = "SELECT * FROM conversas WHERE id_usuario_iniciou_conversa = '$id_usuario' AND id_usuario_conversa NOT IN (SELECT id_usuario_bloqueado FROM usuarios_bloqueados 
                                WHERE id_usuario_bloqueou = '$id_usuario') OR id_usuario_conversa = '$id_usuario' AND id_usuario_iniciou_conversa NOT IN (SELECT id_usuario_bloqueado FROM usuarios_bloqueados 
                                WHERE id_usuario_bloqueou = '$id_usuario') ORDER BY id_conversa DESC";

                                $inquerir_conversas = mysqli_query($conexao, $comando_buscar_conversas);

                                //INICIO DA BUSCA PELAS CONVERSAS
                                while($conversas = @mysqli_fetch_array($inquerir_conversas)){


                                    if($conversas['id_usuario_excluiu_primeiro'] != $id_usuario){

                            ?>

                            <!-- INICIO PARA MANDAR AS INFORMAÇOES PARA O CHAT-->
                            <form action="chat_usuario.php" method = "POST">


                                
                                <!--INICIO DAS CONVERSAS-->
                                <li class="shadow p-3 mb-3 rounded-bottom list-group-item">



                                    <!--    **********     INICIO MOSTRAR O USUARIO QUE COMEÇOU A CONVERSA     *********     -->

                                    <?php
                                        
                                        //INICIO DA VERIFICAÇÃO SE O USUARIO É O MESMO DA SESSAO PARA TROCAR O NOME APRESENTADO NAS CONVERSAS
                                        if($conversas['id_usuario_conversa'] == $id_usuario){
                                            
                                    ?>


                                    
                                    <input type="hidden" value = "<?php echo $conversas['nome_usuario_iniciou_conversa']?>" name = "nome_usuario_conversar">



                                    <?php 

                                        //INICIO DA VERIFICAÇÃO SE O USUARIO ESTA ONLINE
                                        if(Status_Usuario($conversas['id_usuario_iniciou_conversa']) == 0){

                                    ?>

                                    <i class="fas fa-user-alt" id = "icone-offline" data-toggle="tooltip" data-placement="top" title="Offline!"></i> <?php echo $conversas['nome_usuario_iniciou_conversa']?>
                                    

                                    <?php
                                    
                                        }else{
                                    
                                    ?>

                                    <i class="fas fa-user-alt" id = "icone-online" data-toggle="tooltip" data-placement="top" title="Online!"></i> <?php echo $conversas['nome_usuario_iniciou_conversa']?>


                                    <?php
                                    
                                        }
                                        //FIM DA VERIFICAÇÃO SE O USUARIO ESTA ONLINE
                                    
                                    ?>

                                    <div>
                                        <a  href= "#conversas" onclick = "Excluir_Conversa(<?php echo $conversas['id_conversa']?>, <?php echo $conversas['id_usuario_iniciou_conversa']?>)" type="button" class="float-right btn btn-danger" value = "<?php echo $conversas['id_usuario_iniciou_conversa']?>" id = "btn-excluir-1" name = "id_usuario_conversar"><i class="fas fa-trash-alt fa-2x"  data-toggle="tooltip" data-placement="top" title="Excluir Conversa!"></i></a>
                                    </div>

                                    <div>
                                        <button  type="submit" class="mr-3 float-right btn btn-success" value = "<?php echo $conversas['id_usuario_iniciou_conversa']?>" id = "btn-conversar" name = "id_usuario_conversar"><i class="fas fa-comment-dots fa-2x"  data-toggle="tooltip" data-placement="top" title="Conversar!"></i></button>
                                    </div>
                                    


                                    <!--     **********     FIM MOSTRAR O USUARIO  QUE COMEÇOU A CONVERSA     *********     -->





                                    <!--     *******     INICIO MOSTRAR O USUARIO QUE NAO COMEÇOU A CONVERSA     *******     -->


                                    <?php 

                                        }else{

                                    ?>


                                    <input type="hidden" value = "<?php echo $conversas['nome_usuario_conversa']?>" name = "nome_usuario_conversar">


                                    <?php 
                                    
                                        //INICIO DA VERIFICAÇÃO SE O USUARIO ESTA ONLINE
                                        if(Status_Usuario($conversas['id_usuario_conversa']) == 0){
                                
                                    ?>

                                    <i class="fas fa-user-alt" id = "icone-offline" data-toggle="tooltip" data-placement="top" title="Offline!"></i> <?php echo $conversas['nome_usuario_conversa']?>
                                    

                                    <?php
                                    
                                        }else{
                                    
                                    ?>

                                    <i class="fas fa-user-alt" id = "icone-online" data-toggle="tooltip" data-placement="top" title="Online!"></i> <?php echo $conversas['nome_usuario_conversa']?>


                                    <?php
                                    
                                        }
                                        //FIM DA VERIFICAÇÃO SE O USUARIO ESTA ONLINE
                                    
                                    ?>

                                    <div>
                                        <a href= "#conversas" onclick = "Excluir_Conversa(<?php echo $conversas['id_conversa']?>, <?php echo $conversas['id_usuario_conversa']?>)" type="button" class="float-right btn btn-danger" value = "<?php echo $conversas['id_usuario_iniciou_conversa']?>" id = "btn-excluir-2" name = "id_usuario_conversar"><i class="fas fa-trash-alt fa-2x"  data-toggle="tooltip" data-placement="top" title="Excluir Conversa!"></i></a>
                                    </div>

                                    <div>
                                        <button  type="submit" class="mr-3 float-right btn btn-success" value = "<?php echo $conversas['id_usuario_conversa']?>" id = "btn-conversar" name = "id_usuario_conversar"><i class="fas fa-comment-dots fa-2x"  data-toggle="tooltip" data-placement="top" title="Conversar!"></i></button>
                                    </div>
                                    

                                    <?php 
                                    
                                        }
                                        //FIM DA VERIFICAÇÃO SE O USUARIO É O MESMO DA SESSAO PARA TROCAR O NOME APRESENTADO NAS CONVERSAS
                                        
                                    ?>



                                    <!--     *******     FIM MOSTRAR O USUARIO QUE NAO COMEÇOU A CONVERSA     *******     -->


                                
                                </li>
                                <!--FIM DAS CONVERSAS-->


                            </form>
                            <!-- FIM PARA MANDAR AS INFORMAÇOES PARA O CHAT-->            

                            <?php
                                    }
                            
                                }
                                //FIM DA BUSCA PELAS CONVERSAS

                            ?>

                        </ul>

                    </div>
                    <!--FIM CHATS DO USUARIO-->




                    <!--INICIO NOVOS CONTATOS-->
                    <div class="tab-pane fade show active" id="novos-contatos" role="tabpanel" aria-labelledby="novos-contatos-tab">


                        <ul class="list-group" id = "lista-usuarios">


                            <?php   

                                //BUSCAR TODOS USUARIOS SE NÃO ESTIVEREM NA LISTA DE CONTATOS BLOQUEADOS

                                $comando_buscar_usuarios = "SELECT * FROM usuarios  WHERE id_usuario NOT IN (SELECT id_usuario_bloqueado FROM usuarios_bloqueados 
                                                                                                WHERE id_usuario_bloqueou = '$id_usuario')ORDER BY id_usuario DESC";

                                $inquerir_usuarios = mysqli_query($conexao, $comando_buscar_usuarios);

                                
                                //INICIO BUSCA TODOS OS USUARIOS REGISTRADOS
                                while($usuario = mysqli_fetch_array($inquerir_usuarios)){ 

                                    //INICIO VERIFICAÇAO SE O USUARIO ATUAL ESTA NA LISTA
                                    if($usuario['id_usuario'] != $id_usuario){
                                            
                            ?>
                            
                            <!--MANDA AS INFORMAÇOES PARA O CHAT-->
                            <form action="chat_usuario.php" method = "POST">

                                <li class="shadow p-3 mb-3 rounded-bottom list-group-item">
                                    
                                    <input type="hidden" value = "<?php echo $usuario['nome_usuario']?>" name = "nome_usuario_conversar">
                                    
                                    <?php
                                        //VERIFICAR SE O USUARIO ESTA ONLINE
                                        if($usuario['status_online'] == 1){
                                    
                                    ?>

                                    
                                    <i class="fas fa-user-alt" id = "icone-online" data-toggle="tooltip" data-placement="top" title="Online!"></i> <?php echo $usuario['nome_usuario']?>

                                    <div>

                                        <button  type="submit" class="float-right btn btn-success" value = "<?php echo $usuario['id_usuario']?>" id = "btn-conversar" name = "id_usuario_conversar"><i class="fas fa-comment-dots fa-2x" data-toggle="tooltip" data-placement="top" title="Conversar!"></i></button>
                                    
                                    </div>

                                    <div>

                                        <a  href="#" class="mr-2 float-right btn btn-warning" onclick="Bloquear_Usuario(<?php echo $usuario['id_usuario']?>, '<?php echo $usuario['nome_usuario']?>', <?php echo $id_usuario?>, '<?php echo $nome_usuario?>')" 
                                        id = "btn-bloquear" name = "id_usuario_bloquear"><i class="fas fa-lock fa-2x" data-toggle="tooltip" data-placement="top" title="Bloquear Usuário!"></i></a>

                                    </div>


                                    <?php
                                    
                                        }else{        

                                    ?>

                                    <i class="fas fa-user-alt" id = "icone-offline" data-toggle="tooltip" data-placement="top" title="Offline!"></i> <?php echo $usuario['nome_usuario']?>
                                

                                    <div>
                                       
                                        <button  type="submit" class="float-right btn btn-success" value = "<?php echo $usuario['id_usuario']?>" id = "btn-conversar" name = "id_usuario_conversar"><i class="fas fa-comment-dots fa-2x" data-toggle="tooltip" data-placement="top" title="Conversar!"></i></button>
                                    
                                    </div>

                                    <div>

                                        <a  href="#" class="mr-2 float-right btn btn-warning" onclick="Bloquear_Usuario(<?php echo $usuario['id_usuario']?>, '<?php echo $usuario['nome_usuario']?>', <?php echo $id_usuario?>, '<?php echo $nome_usuario?>')" 
                                        id = "btn-bloquear" name = "id_usuario_bloquear"><i class="fas fa-lock fa-2x" data-toggle="tooltip" data-placement="top" title="Bloquear Usuário!"></i></a>
                                    
                                    </div>
                                        
                                    
                                    <?php 
                                    
                                        }        

                                    ?>
                                </li>

                            </form>

                            <?php

                                    }
                                    //FIM VERIFICAÇAO SE O USUARIO ATUAL ESTA NA LISTA

                                }
                                //FIM BUSCA TODOS OS USUARIOS REGISTRADOS
                            ?>

                        </ul>

                            
                    </div>
                    <!--FIM NOVOS CONTATOS-->

                    


                    <!--INICIO DOS CONTATOS BLOQUEADOS PELO USUARIO-->
                    <div class="tab-pane fade" id="contatos-bloqueados" role="tabpanel" aria-labelledby="contatos-bloqueados-tab">

                        <ul class="list-group" id = "lista-contatos-bloqueados">

                            <?php

                                $comando_contatos_bloqueados = "SELECT * FROM usuarios_bloqueados WHERE id_usuario_bloqueou = '$id_usuario'";

                                $inquerir_contatos_bloqueados = mysqli_query($conexao, $comando_contatos_bloqueados);


                                while($contatos_bloqueados = mysqli_fetch_array($inquerir_contatos_bloqueados)){

                            ?>

                                <li class="shadow p-3 mb-3 rounded-bottom list-group-item">
                                    
                                    <?php echo $contatos_bloqueados['nome_usuario_bloqueado']?>

                                    <a  href="#" class="mr-2 float-right btn btn-warning" onclick="Desbloquear_Usuario(<?php echo $contatos_bloqueados['id_usuario_bloqueado']?>, <?php echo $id_usuario?>)" id = "btn-desbloquear"
                                    name = "id_usuario_desbloquear"><i class="fas fa-unlock fa-2x" data-toggle="tooltip" data-placement="top" title="Desbloquear Usuário!"></i></a>

                                </li>


                            <?php
                            
                                }

                            ?>

                        </ul>

                    </div>  
                    <!--FIM DOS CONTATOS BLOQUEADOS PELO USUARIO-->




                </div>
                <!--FIM CONTEUDO DOS LINKS DO MENU USUARIO-->




            </div>
            <!--FIM MENU USUARIO-->


            <!--INICIO BOTAO SAIR-->
            <div class = "col-sm-12 col-md-12 col-lg-8 col-xl-8 offset-lg-2 offset-xl-2">

                <a href = "../bd/logout_usuario.php" type="button" class="btn btn-danger shadow p-3 mb-3" id = "btn-sair-sistema">SAIR</a>                    

            </div>
            <!--FIM BOTAO SAIR-->

        </div>


        <script src="../js/jquery.js"></script>
        <script src="../js/jquery-mask.js"></script>
        <script src="../js/popper.min.js" ></script>
        <script src="../js/bootstrap.min.js"></script>
        
        <script>

            

            $('[data-toggle="tooltip"]').tooltip();


            //ATUALIZA A PAGINA APOIS ALGUMA AÇÃO DEPENDENTE DO ID DO ESCOPO
            function Atualizar_Pagina(){

                $('[data-toggle="tooltip"]').tooltip('hide'); //REMOVE O TOOLTIP APOS ATUALIZAÇÃOW

                $("#lista-conversas").load("index_usuario.php #lista-conversas");
                $("#lista-usuarios").load("index_usuario.php #lista-usuarios");
                $("#lista-contatos-bloqueados").load("index_usuario.php #lista-contatos-bloqueados");

            }


            
            function Excluir_Conversa(id_conversa, id_conversando){

                var v_id_conversa = id_conversa;
                var v_id_conversando = id_conversando;

                $.ajax({

                    url:'../bd/excluir_conversa.php',
                    type:'POST',
                    data:{id_conversa:v_id_conversa, id_usuario_conversando:v_id_conversando},
                    dataType:'html',
                    success:function(data){
                        //alert(data);
                    }

                });

                Atualizar_Pagina();

            }

            
            function Bloquear_Usuario(id_usuario_bloquear, nome_usuario_bloquear, id_usuario_bloqueou, nome_usuario_bloqueou){
                
                var v_id_usuario_bloquerio = id_usuario_bloquear;
                var v_nome_usuario_bloquerio = nome_usuario_bloquear;
                var v_id_usuario_bloqueou = id_usuario_bloqueou;
                var v_nome_usuario_bloqueou = nome_usuario_bloqueou;


                alert("-USUARIO BLOQUEADO-->" + v_id_usuario_bloquerio + v_nome_usuario_bloquerio + "-USUARIO QUE BLOQUEOU-->" + v_id_usuario_bloqueou + v_nome_usuario_bloqueou);

                $.ajax({

                    url:'../bd/bloquear_usuario.php',

                    type:'POST',

                    data:{id_usuario_bloqueio:v_id_usuario_bloquerio, nome_usuario_bloqueio:v_nome_usuario_bloquerio,
                        id_usuario_bloqueou:v_id_usuario_bloqueou, nome_usuario_bloqueou:v_nome_usuario_bloqueou},

                    dataType:'html'

                });

                Atualizar_Pagina();

            }



            function Desbloquear_Usuario(id_usuario_desbloquear, id_usuario_desbloqueou){
                
                var v_id_usuario_desbloquerio = id_usuario_desbloquear;
                var v_id_usuario_desbloqueou = id_usuario_desbloqueou;

                $.ajax({

                    url:'../bd/desbloquear_usuario.php',

                    type:'POST',

                    data:{id_usuario_desbloqueio:v_id_usuario_desbloquerio, id_usuario_desbloqueou:v_id_usuario_desbloqueou},

                    dataType:'html'

                });

                Atualizar_Pagina();

            }
 
        </script>
        
    </body>

</html>

<?php
    }
    mysqli_close($conexao);
    //ENCERRA A CONEXÃO COM BANCO DE DADOS 
?>