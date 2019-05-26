<div class="center-block site">
    <h1 class="text-center">Lançar pedido</h1>
    <p>
        <a href="<?= URL_RAIZ ?>">Voltar para listagem</a>
    </p>
    <form action="<?= URL_RAIZ . 'lancar_pedido' ?>" method="post">
        <input name="mesa" placeholder="Número da mesa">
        <input name="quantidade" placeholder="Quantidade">
        <input type="submit" value="Enviar">
    </form>
</div>
