<h1 class="hide">cod_1999</h1>


<div class="col offset-s3 s6  offset-m3 m6 ">
    <div class="card  darken-1 z-depth-3">
        <div class="card-content">
            <div class="row">


                <?php
              echo "<hr>" . $valores['alternativa'];
              echo "<hr>" . $valores['resultado'];
              echo "<hr>" . $valores['id_quest'];


                if ($questoes) : ?>
                    <?php foreach ($questoes as $questao): ?>


                        <div class="col s12 m6">
                            <div class="card">
                                <div class="card-image">
                                    <img class="imagensQuest responsive-img "
                                         src="<?= URL_IMG . $questao->getImagem() ?>">
                                    <span class="card-title tituloCard"><?php echo $questao->getTitulo() ?></span>
                                </div>



                                <?php if ($valores['id_quest'] == $questao->getId()) : ?>
                                    <?php if ($flash) : ?>
                                        <div class="animated jackInTheBox faster delay-1s">
                                            <div class="card-panel teal lighten-2 center text-darken-2">
                                                <?= $flash ?>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                <?php endif ?>


                                <div class="card-content">
                                    <p>
                                        <?php echo $questao->getDescricao() . "<hr>";

                                        echo "id:  " . $questao->getId() . " <hr>";


                                        ?>
                                    </p>
                                </div>

                                <ul class="collapsible">
                                    <li>
                                        <div class="collapsible-header"><i class="material-icons">edit</i>Responder
                                        </div>
                                        <div class="collapsible-body">


                                            <form action="<?= URL_RAIZ . 'quest/responderPage' ?>" method="post">

                                                <input type="" name="id_quest" value="<?php echo $questao->getId() ?>">
                                                <label> Input vai ficar oculto</label>

                                                <?php
                                                $arrays = $questao->buscarPorIdAlternativas($questao->getId());

                                                foreach ($arrays as $alternativa)  : ?>

                                                    <p>
                                                        <label>
                                                            <input name="alternativaCorreta"
                                                                   value="<?php echo $alternativa ?>" type="radio"/>
                                                            <span>  <?php echo $alternativa ?></span>
                                                        </label>
                                                    </p>
                                                    <br>
                                                    <hr>

                                                <?php endforeach ?>
                                                <div class="center">
                                                    <button class="btn waves-effect waves-light" type="submit"
                                                            name="action">Salvar
                                                        <i class="material-icons right">send</i>
                                                    </button>
                                                </div>

                                            </form>
                                        </div>
                                    </li>
                                </ul>

                            </div>
                        </div>


                    <?php endforeach ?>
                <?php else: ?>

                    <div class="col s12 m12">
                        <div class="card blue-grey darken-1">
                            <div class="card-content white-text">
                                <span class="card-title">Ops....</span>
                                <p>Me desculpe, mas... não temos questões para responder!
                                    Porém poderá criar diversas questões para seus amigos possam responder! 😉</p>
                            </div>

                        </div>
                    </div>


                <?php endif; ?>


            </div>

        </div>

        <div class="row center">
            <?php if ($pagina > 1) : ?>
                <a href="<?= URL_RAIZ . 'quest?p=' . ($pagina - 1) ?>" class="btn btn-default">Página anterior</a>
            <?php endif ?>
            <?php if ($pagina < $ultimaPagina) : ?>
                <a href="<?= URL_RAIZ . 'quest?p=' . ($pagina + 1) ?>" class="btn btn-default">Próxima página</a>
            <?php endif ?>
        </div>


    </div>
</div>
