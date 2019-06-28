<h1 class="hide">cod_1999</h1>


<div class="col offset-s3 s6  offset-m3 m6 ">
    <div class="card  darken-1 z-depth-3">
        <div class="card-content">
            <div class="row">
                <h4 class="center">Relatório de Questões</h4>


                    <div class="col s12 m12 center">


                            <form action="<?= URL_RAIZ . 'quest/relatorioPage' ?>" method="get"
                                  class="form-inline pull-left">
                                <label class="control-label" for="produtoId">Produto</label>

                                <?php $this->incluirVisao('util/select.php', []) ?>
                                <button type="submit" class="btn btn-primary center-block largura100">Filtrar</button>

                            </form>

                    </div>


                <?php




                if ( isset($relatorio['acertos']) && isset($relatorio['erros'])): ?>


                    <?php
                    $acertos = $relatorio['acertos'];
                    $erros = $relatorio['erros'];
                    ?>


                    <div class="col s12 m6">
                        <div class="card">

                            <div class="card-image">
                                <img class="imagensQuest responsive-img "
                                     src="<?= URL_IMG . $acertos->getImagem() ?>">
                                <span class="card-title tituloCard"><?php echo $acertos->getTitulo() ?></span>
                            </div>


                            <div class="card-content">
                                <p>
                                    <?php echo $acertos->getDescricao() . "<hr>";
                                    echo '<h5> A que povo mais errou! 😥 </h5>';
                                    echo "<h5>Erros: " . $acertos->getQuantidadeErros($acertos->getId()) . "</h5>";
                                    echo "<h5>Acertos: " . $acertos->getQuantidadeAcertos($acertos->getId()) . "</h5>";
                                    echo "<h6>Dificuldade: " . $acertos->getDificuldade() . "</h6>";
                                    ?>
                                </p>
                            </div>

                            <ul class="collapsible">
                                <li>
                                    <div class="collapsible-header"><i class="material-icons">edit</i>Responder
                                    </div>
                                    <div class="collapsible-body">


                                        <form action="<?= URL_RAIZ . 'quest/responderPage' ?>" method="post">

                                            <input type="" name="id_quest" value="<?php echo $acertos->getId() ?>">
                                            <label> Input vai ficar oculto</label>

                                            <?php
                                            $arrays = $acertos->buscarPorIdAlternativas($acertos->getId());

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
                                                <button class="btn waves-effect waves-light"
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


                    <div class="col s12 m6">
                        <div class="card">

                            <div class="card-image">
                                <img class="imagensQuest responsive-img "
                                     src="<?= URL_IMG . $erros->getImagem() ?>">
                                <span class="card-title tituloCard"><?php echo $erros->getTitulo() ?></span>
                            </div>


                            <div class="card-content">
                                <p>
                                    <?php echo $erros->getDescricao() . "<hr>";
                                    echo '<h5> A que povo mais acertou! 😎 </h5>';
                                    echo "<h5>Acertos: " . $erros->getQuantidadeAcertos($erros->getId()) . "</h5>";
                                    echo "<h5>Erros: " . $erros->getQuantidadeErros($erros->getId()) . "</h5>";
                                    echo "<h6>Dificuldade: " . $erros->getDificuldade() . "</h6>";


                                    ?>
                                </p>
                            </div>

                            <ul class="collapsible">
                                <li>
                                    <div class="collapsible-header"><i class="material-icons">edit</i>Responder
                                    </div>
                                    <div class="collapsible-body">


                                        <form action="<?= URL_RAIZ . 'quest/responderPage' ?>" method="post">

                                            <input type="" name="id_quest" value="<?php echo $erros->getId() ?>">
                                            <label> Input vai ficar oculto</label>

                                            <?php
                                            $arrays = $erros->buscarPorIdAlternativas($erros->getId());

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
    </div>
</div>