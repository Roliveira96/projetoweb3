<div class="center-block site">
    <h1 class="text-center">Listagem de pedidos</h1>
    <p>
        <a href="<?= URL_RAIZ . 'lancar_pedido' ?>">Lançar pedido</a>
    </p>
    <?php if (count($pedidos) == 0) : ?>
        <p>Nenhum pedido encontrado.</p>
    <?php endif ?>
    <?php foreach ($pedidos as $pedido) : ?>
        <p>
            Número da mesa: <?= $pedido->getMesa() ?>.
            Quantidade de lanches: <?= $pedido->getQuantidade() ?>.
        </p>
    <?php endforeach ?>
</div>
