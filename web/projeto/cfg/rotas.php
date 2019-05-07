<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\HomeControlador#index',
        'POST' => '\Controlador\MensagemControlador#armazenar',
    ],

    '/login' => [

        'GET' => '\Controlador\LoginControlador#loginPage',
    ],

    '/cadastroUsuario' =>[

        'GET' => '\Controlador\CadastroUsuarioControlador#index',

    ]

];
