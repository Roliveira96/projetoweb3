<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\MensagemControlador#index',
        'POST' => '\Controlador\MensagemControlador#armazenar',
    ],

    '/login' => [

        'GET' => '\Controlador\LoginControlador#loginPage',
    ]

];
