
<?php

    session_name('usuario');
    session_start();

    require 'bd/conexao_bd.php';

    if(isset($_SESSION['nome_usuario'])){

        header('location:telas_usuario/index_usuario.php');

        mysqli_close($conexao);
        
    }else{

    //LIMPA TODAS AS VARIAVEIS REGISTRADAS EM SESSAO
    unset($_SESSION['nome_usuario']);
    unset($_SESSION['id_usuario']);
    unset($_SESSION['id_usuario_conversar_temp']);
    unset($_SESSION['nome_usuario_conversar_temp']);

    session_destroy(); //DESTROI A SESSAO ATUAL
    
?>

<!DOCTYPE html>

<html lang="pt-BR">

    <head>

        <noscript> <meta http-equiv="refresh" content="0; url=telas_erros/sem_js.html"> </noscript>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chat</title>

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/index.css">

        <script src="js/font.js"></script>

    </head>

    <body>

        <div class = "container">

            <!--INICIO TITULO DA PAGINA-->
            <div id  = "titulo" class = "text-center col-sm-12 col-md-4 col-lg-4 col-xl-4 offset-md-4 offset-lg-4 offset-xl-4">

                <h1 id  = "titulo-texto"><i class="fas fa-users fa-x2"></i> ChatBr</h1>

            </div>
            <!--FIM TITULO DA PAGINA-->


            <div class = "row">

                <!--INICIO INFORMACOES DA PAGINA-->
                <div id = "informacoes" class = "text-center col-sm-12 col-md-12 col-lg-6 col-xl-6">

                    <p><i class="fas fa-user-alt"></i> Conheça novas pessoas.</p>
                    <p><i class="fas fa-user-plus"></i> Faça novas amizades.</p>
                    <p><i class="fas fa-smile"></i> Respeite.</p>

                </div>
                <!--FIM INFORMACOES DA PAGINA-->


                <!--INICIO PAINEL DE ACESSO DA PAGINA-->
                <div id = "painel-entrar" class = "jumbotron col-sm-12 col-md-12 col-lg-6 col-xl-6">

                    <form action="bd/login_usuario.php" method = "POST">


                        <!--BLOCO DO NUMERO DE TELEFONE-->
                        <div class="input-group mb-3 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            
                            <div class="input-group-prepend">

                                <span id = "span-telefone-texto" class="input-group-text">Número</span>

                            </div>

                            <input type="text" class="form-control" id = "telefone-texto" placeholder = "Digite seu telefone.." name = "numero_usuario" required>

                        </div>



                        <!--BLOCO DA SENHA-->
                        <div class="input-group mb-3 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            
                            <div class="input-group-prepend">

                                <span id = "span-senha-texto" class="input-group-text">Senha</span>

                            </div>

                            <input type="password" class="form-control" id = "senha-texto" placeholder = "Digite sua senha.." name = "senha_usuario" required>

                        </div>



                        <!--BLOCO DO BOTAO-->
                        <div class = "text-center col-sm-12 col-md-8 col-lg-8 col-xl-8 offset-md-2 offset-lg-2 offset-xl-2">

                            <button id = "btn-entrar-chat" class="btn" type="submit">ENTRAR</button>
                            
                            <button id = "btn-criar-conta" class="btn" type="button"  data-toggle="modal" data-target="#modal-cadastrar-usuario">CADASTRAR</button> 

                        </div>
                        

                    </form>

                </div>
                <!--FIM PAINEL DE ACESSO DA PAGINA-->

            </div>

            <!--INICIO INFORMCACOES EXTRAS DA PAGINA-->
            <div id = "informacoes-extras-conteudo" class = "d-flex justify-content-center col-sm-12 col-md-8 col-lg-8 col-xl-8 offset-md-2 offset-lg-2 offset-xl-2">

                <ul id = "informacoes-extras" class="list-group list-group-horizontal">

                    <li class="list-group-item">Qualquer dúvida ou problema é só entrar em contato - teste@gmail.com</li>

                </ul>

            </div>
            <!--FIM INFORMCACOES EXTRAS DA PAGINA-->

        </div>
        

        <!--INICIO RODAPE DA PAGINA-->
        <footer>

            <div id = "rodape" class = "text-center col-sm-12 col-md-12 col-lg-12 col-xl-12">

                <p>© ChatBr</p>

            </div>

        </footer>
        <!--FIM RODAPE DA PAGINA-->




        <!--INICIO MODAL REGISTRAR USUARIO-->
        <div class="modal fade bd-example-modal-lg" id="modal-cadastrar-usuario" tabindex="-1" role="dialog">
        
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

                <div class="modal-content">
                    
        
                    <!--TOPO DO MODAL-->
                    <div class="modal-header" id = "topo-modal-cadastrar-usuario">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    

                    <!--CORPO DO MODAL-->
                    <div class="modal-body" id = "corpo-modal-cadastrar-usuario">
                        
                        <div class="container">

                                                
                            <!--BLOCO DO NOME-->
                            <div class="input-group mb-3 col-sm-12 col-md-8 col-lg-8 col-xl-8 offset-md-2 offset-lg-2 offset-xl-2">
                                
                                <div class="input-group-prepend">

                                    <span id = "span-nome-cadastro" class="input-group-text">Nome</span>

                                </div>

                                <input type="text" class="form-control" id = "nome-cadastro" placeholder = "Digite seu nome.." name = "nome_usuario" required>

                            </div>

                        
                            <!--BLOCO DO NUMERO DE TELEFONE-->
                            <div class="input-group mb-3 col-sm-12 col-md-8 col-lg-8 col-xl-8 offset-md-2 offset-lg-2 offset-xl-2">
                                
                                <div class="input-group-prepend">

                                    <span id = "span-telefone-cadastro" class="input-group-text">Número</span>

                                </div>

                                <input type="text" class="form-control" id = "telefone-cadastro" placeholder = "Digite seu telefone.." name = "numero_usuario" required>

                            </div>



                            <!--BLOCO DA SENHA-->
                            <div class="input-group mb-3 col-sm-12 col-md-8 col-lg-8 col-xl-8 offset-md-2 offset-lg-2 offset-xl-2">
                                
                                <div class="input-group-prepend">

                                    <span id = "span-senha-cadastro" class="input-group-text">Senha</span>

                                </div>

                                <input type="password" class="form-control" id = "senha-cadastro" placeholder = "Digite sua senha.." name = "senha_usuario" required>

                            </div>


                        </div>

                    </div>


                    <!--RODAPE DO MODAL-->
                    <div class="modal-footer" id = "rodape-modal-cadastrar-usuario">

                        <div class="container">

                            <div class = "text-center col-sm-12 col-md-8 col-lg-8 col-xl-8 offset-md-2 offset-lg-2 offset-xl-2">

                                <button type="button" class="btn btn-success" id = "btn-registrar-usuario-modal" data-dismiss="modal" data-toggle="modal" data-target="#modal-resultado">CADASTRAR</button>
                                <button type="button" class="btn btn-danger" id = "btn-voltar-modal" data-dismiss="modal">VOLTAR</button>
                            
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
        <!--FIM MODAL REGISTRAR USUARIO-->


        <!-- INICIO MODAL REGISTRAR USUARIO RESULTADO -->
        <div class="modal fade" id="modal-resultado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header" id = "topo-modal-cadastrar-usuario">

                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                        </button>

                    </div>

                    <div class="modal-body" id = "corpo-modal-cadastrar-usuario">
                        <h4 class = "text-white" id = "resultado-registro"></h4>
                    </div>

                    <div class="modal-footer" id = "rodape-modal-cadastrar-usuario">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>

                    </div>

                </div>

            </div>

        </div>
        <!--FIM MODAL REGISTRAR USUARIO RESULTADO-->

        
        <script src="js/jquery.js"></script>
        <script src="js/jquery-mask.js"></script>
        <script src="js/popper.min.js" ></script>
        <script src="js/bootstrap.min.js"></script>

        <script>

            $('#telefone-texto').mask('(00)000000000'); //mascara de campo do telefone

            $('#telefone-cadastro').mask('(00)000000000'); //mascara de campo do telefone cadastro


            $('#btn-registrar-usuario-modal').click(function(){

                var v_nome = $('#nome-cadastro').val();
                var v_telefone = $('#telefone-cadastro').val();
                var v_senha = $('#senha-cadastro').val();

                if(v_nome != "" && v_telefone != "" && v_senha != ""){

                    $.ajax({

                        url:'bd/cadastrar_usuario.php',
                        type:'POST',
                        data:{nome:v_nome, telefone:v_telefone, senha:v_senha},
                        success:function(data){

                            $('#resultado-registro').text(data);

                        }

                    });

                }else{

                    alert('PREENCHA TODOS OS CAMPOS !!')
                }

            });

        </script>
        
    </body>

</html>

<?php
        mysqli_close($conexao);
    }
?>