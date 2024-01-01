# Chat Br

Application developed with a focus on PHP studies. Chat Br is an application similar to Whatsapp but with global access to contacts and a unique layout, a complete system for registering numbers, conversations and blocking numbers.

## Interface

Home screen and registration screen

![01](https://user-images.githubusercontent.com/74942532/139557229-7f555a67-2c3e-4529-be26-e16dfc07c0e1.png)

Screen with options for conversations, contacts and blocked contacts

![02](https://user-images.githubusercontent.com/74942532/139557252-c74e7c81-0fb0-4104-8ecd-11f7e0d2522a.png)

Chat screen

![03](https://user-images.githubusercontent.com/74942532/139557274-a9931e69-645c-495e-8ec0-9e2add66aed7.png)

## What are the functions?

We can list registered users, chat with them and block them.

## Before running the project

`1` To run the project, we use Wamp (https://www.wampserver.com/en/) as our local server. wamp by default can generate different ports than
configured in the project, so go to the file in the directory `\chat-br-php\bd\conexao_bd.php` and configure the variable `$server` with localhost and port
specific file that Wamp generated on your machine.

`2` Import the database located in the `\chat-br-php\banco_de_dados\chat.sql` directory into MySql

After the steps, access the Wamp localhost and enjoy.

## About

Application developed using the following technologies: Wamp (Local Server), MySql (Database), PHP, HTML, CSS, JavaScript and Bootstrap.
