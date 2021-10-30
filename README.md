# Chat Br

Aplicação desenvolvida com foco nos estudos de php. Chat Br é uma aplicação parecida com Whatsapp porém com acesso global de contatos e layout único, sistema completo de cadastro de números, conversas e bloqueio de números.

## Interface

Tela inicial e Tela de cadastro

![01](https://user-images.githubusercontent.com/74942532/139557229-7f555a67-2c3e-4529-be26-e16dfc07c0e1.png)

Tela com as opções de conversas, contatos e contatos bloqueados

![02](https://user-images.githubusercontent.com/74942532/139557252-c74e7c81-0fb0-4104-8ecd-11f7e0d2522a.png)

Tela do chat

![03](https://user-images.githubusercontent.com/74942532/139557274-a9931e69-645c-495e-8ec0-9e2add66aed7.png)

## Quais são as funções?

Podemos listar os usuários cadastrados, conversar com eles e bloqueá-los.

## Antes de rodar o projeto

`1` Para rodar o projeto, utilizamos o Wamp(https://www.wampserver.com/en/) como nosso servidor local. O wamp por padrão pode gerar portas diferentes das
configuradas no projeto, por isso vá ao arquivo no diretório `\chat-br-php\bd\conexao_bd.php` e configure a variável `$servidor` com localhost e porta
específica que o Wamp gerou na sua máquina.

`2` Importe o banco de dados localizado no diretório `\chat-br-php\banco_de_dados\chat.sql` para o MySql

Logo após as etapas, rode o projeto acessando o localhost do Wamp e aproveite.

## Sobre

Aplicação desenvolvida utilizando as seguintes tecnologias: Wamp (Servidor Local), MySql (Banco de dados), PHP, HTML, CSS, JavaScript e Bootstrap.
