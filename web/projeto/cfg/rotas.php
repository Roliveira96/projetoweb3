<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\HomeControlador#index',

    ],

    '/login' => [

        'GET' => '\Controlador\LoginControlador#loginPage',
        'POST' => '\Controlador\LoginControlador#login',
    ],

    '/login/api'=>[
        'GET' => '\Controlador\LoginControlador#loginPageAPI',
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

    '/quest/criarPage' => [
        'GET' => '\Controlador\ControladorQuest#criarPageQuest',
        'POST' => '\Controlador\ControladorQuest#salvarQuest'
    ],

    '/quest/responderPage' => [
        'GET' => '\Controlador\ControladorQuest#responderPageQuest',
    ],

    '/quest/relatorioPage' => [
        'GET' => '\Controlador\ControladorQuest#relatorioPageQuest',
    ],

];
