<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\HomeControlador#index',

    ],

    '/login' => [

        'GET' => '\Controlador\LoginControlador#loginPage',
        'POST' => '\Controlador\LoginControlador#login',
    ],

    '/cadastroUsuario' =>[

        'GET' => '\Controlador\CadastroUsuarioControlador#index',
        'POST' => '\Controlador\CadastroUsuarioControlador#armazenar',

    ]

];
