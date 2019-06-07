<h1 class="hide">cod_1999</h1>


<div class="col offset-s3 s6  offset-m3 m6 ">
    <div class="card  darken-1 z-depth-3">
        <div class="card-content">
            <div class="row">
                <h4 class="center">Crie suas quests</h4>
                <h6 class="center">Seja desafiador ou nem tanto! 😅 </h6>

                <form action="<?= URL_RAIZ . 'criarPage' ?>" method="post" class="form-inline pull-left">

                    <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'erros']) ?>


                    <!-- inicio Imput titulo -->

                    <?php if (isset($titulo)) : ?>

                        <div class="input-field col m8 s12">
                            <input placeholder="O que é uma diagrama" id="titulo" name="titulo" onclick="M.toast({html: value+' Sempre é bom inserir um titulo que chame a atenção!'
                                })" type="text" value="<?= $titulo ?>"
                                   class="validate">
                            <label for="first_name">Titulo da pergunta</label>

                            <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'nome']) ?>

                        </div>


                    <?php else : ?>


                        <div class="input-field col m8 s12">
                            <input placeholder="O que é uma diagrama" id="titulo" name="titulo" onclick="M.toast({html: value+' Sempre é bom inserir um titulo que chame a atenção!'
                                })" type="text"
                                   class="validate">
                            <label for="first_name">Titulo da pergunta</label>


                            <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'nome']) ?>

                        </div>
                    <?php endif ?>


                    <!-- fim Imput titulo -->

                    <div class="input-field col m4 s12">
                        <select name="select" id="select">
                            <option value="facil">Fácil 😇</option>
                            <option value="media">Mediana 😐</option>
                            <option value="dificil">Difícil 😟</option>
                        </select>
                        <label>Materialize Select</label>

                    </div>


                    <!-- inicio Imput descricao -->


                    <?php if (isset($descricao)) : ?>

                        <div class="input-field col m12 s12">

                        <textarea class="materialize-textarea" placeholder="Ex. teste" id="textarea1"
                                  onclick="M.toast({html:  'Na descrição é recomendado sempre detalhar a sua questão, desta forma deixando bem mais compreensivo a questão!'})"><?= $descricao ?></textarea>
                            <label for="textarea1">Descrição da questão</label>

                            <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'sobrenome']) ?>

                        </div>


                    <?php else : ?>
                        <div class="input-field col m12 s12">

                        <textarea id="descricao" name="descricao" class="materialize-textarea"
                                  onclick="M.toast({html:  'Na descrição é recomendado sempre detalhar a sua questão, desta forma deixando bem mais compreensivo a questão!'})"></textarea>
                            <label for="textarea1">Descrição da questão</label>

                            <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'sobrenome']) ?>

                        </div>


                    <?php endif ?>

                    <!-- fim Imput descricao -->


            </div>
            <!--imagem perfil-->


            <div class="row">
                <div class="input-field col offset-s2 s12  m12  ">

                    <div class="file-field input-field">
                        <div class="btn">
                            <span>Imagem para a questão</span>
                            <input id="foto" name="foto" type="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>
                </div>

            </div>


            <!--enviar para banco-->
            <div class="center form">

                <button class="btn waves-effect waves-light" type="submit" name="action">Salvar questão
                    <i class="material-icons right">cloud_done
                    </i>
                </button>
            </div>


            </form>


        </div>

    </div>
</div>
