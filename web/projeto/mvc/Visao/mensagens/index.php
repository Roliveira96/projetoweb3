
<div class="col s6 m6">
    <div class="card  darken-1">
        <div class="card-content ">

            <div class="center-block site">
                <h1 class="text-center">Chat Online</h1>
                <h2>Escreva a mensagem</h2>
                <div class="clearfix margin-bottom">
                    <form action="<?= URL_RAIZ ?>" method="post" class="form-inline pull-left">
                        <div class="form-group">
                            <input id="usuario" name="usuario" class="form-control campo-form" autofocus placeholder="Usuário">
                        </div>
                        <div class="form-group">
                            <input id="texto" name="texto" class="form-control campo-form" placeholder="Texto">
                        </div>
                        <button type="submit" class="btn btn-default">Enviar mensagem</button>
                    </form>
                </div>
                zgsadhdaf
                <h2>Mensagens</h2>
                <div class="row">
                    <?php foreach ($mensagens as $mensagem) : ?>

                        <div class="col s6 m6">
                            <div class="card grey darken-1">
                                <div class="card-content white-text">
                                    <span class="card-title"><strong><?= $mensagem->getUsuario() ?>:</strong></span>
                                    <p><?= $mensagem->getTexto() ?></p>
                                </div>

                            </div>
                        </div>






                    <?php endforeach ?>
                </div>
            </div>
        </div></div></div>