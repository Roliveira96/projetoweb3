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

        'GET' => '\Controlador\UsuarioControlador#index',
        'POST' => '\Controlador\UsuarioControlador#armazenar',

    ],


    '/sair' => [
        'GET' => '\Controlador\LoginControlador#destruirLogin',
    ],

    '/questao' => [
        'GET' => '\Controlador\QuestaoControlador#index',
    ],

    '/questao_nao_logado' => [
        'GET' => '\Controlador\QuestaoControlador#naoLogado',
    ],

    '/questao/criarPagina' => [
        'GET' => '\Controlador\QuestaoControlador#criarPaginaQuestao',
        'POST' => '\Controlador\QuestaoControlador#salvarQuestao'
    ],

    '/questao/responderPagina' => [
        'GET' => '\Controlador\QuestaoControlador#responderFiltro',
        'POST' => '\Controlador\QuestaoControlador#respostaQuestao',
    ],

    '/questao/relatorioPagina' => [
        'GET' => '\Controlador\RelatorioControlador#index',
    ],

    '/questao/minhasQuestoesPagina' => [
        'GET' => '\Controlador\MinhasQuestoesControlador#index',
        'POST' => '\Controlador\MinhasQuestoesControlador#editar',
    ],

    '/questao/minhasQuestoesPagina/?' => [
        'DELETE' => '\Controlador\MinhasQuestoesControlador#destruir',
    ],
];
