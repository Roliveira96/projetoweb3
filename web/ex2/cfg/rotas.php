<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\PedidoControlador#index',
    ],
    '/lancar_pedido' => [
        'GET' => '\Controlador\PedidoControlador#criar',
        'POST' => '\Controlador\PedidoControlador#armazenar',
    ],
];
