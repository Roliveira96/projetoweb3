<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\HomeControlador#index',

    ],

    '/login' => [

        'GET' => '\Controlador\LoginControlador#loginPage',
        'POST' => '\Controlador\LoginControlador#login',
    ],

    '/cadastroUsuario' => [

        'GET' => '\Controlador\CadastroUsuarioControlador#index',
        'POST' => '\Controlador\CadastroUsuarioControlador#armazenar',

    ],

    '/perfil' => [
        'GET' => '\Controlador\PerfilControlador#index',
    ],

    '/sair' => [
        'GET' => '\Controlador\LoginControlador#destruirLogin',
    ],

    '/quest' => [
        'GET' => '\Controlador\ControladorQuest#index',
    ],

    '/quest_no_logado' => [
        'GET' => '\Controlador\ControladorQuest#noLogado',
    ],

    '/criarPage' => [
        'GET' => '\Controlador\ControladorQuest#criarPageQuest',
        'POST' => '\Controlador\ControladorQuest#salvarQuest'
    ],

    '/responderPage' => [
        'GET' => '\Controlador\ControladorQuest#responderPageQuest',
    ],

    '/relatorioPage' => [
        'GET' => '\Controlador\ControladorQuest#relatorioPageQuest',
    ],

];
