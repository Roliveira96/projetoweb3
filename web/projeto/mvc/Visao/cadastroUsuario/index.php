
<h1 class="hide">cod_1991</h1>


<div class="row">
    <h4 class="center">Cadastro</h4>
    <h6 class="center">Por favor entre com suas informações corretamente</h6>


    <div class="col offset-s2 s8  offset-m2 m8 ">
        <div class="card  darken-1 z-depth-3">
            <div class="card-content">

                <div class="center-block site">


                    <form action="<?= URL_RAIZ  . 'cadastroUsuario'?>" method="post" class="form-inline pull-left">

                        <div class="form ">
                            <img class="img_login" src="<?= URL_IMG . 'login.png' ?>">
                        </div>
                        <!--nome e sobrenome-->
                        <div class="row">

                            <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'erros']) ?>


                            <div class="input-field col m6 s12">
                                <input placeholder="Ex: João" id="nome" name="nome" onfocusout="M.toast({html: value
                                })" type="text" value="<?= @$nome ?>"
                                       class="validate">
                                <label for="first_name">Primeiro nome</label>

                               <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'nome']) ?>

                            </div>


                            <div class="input-field col m6 s12">
                                <input placeholder="Ex. da Silva" name="sobrenome" id="sobrenome"
                                       value="<?= @$sobrenome ?>" onfocusout="M.toast({html: value
                                })" onblur="validaString(sobrenome , 'sobrenome')" type="text" class="validate">
                                <label for="last_name">Segundo nome</label>
                                <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'sobrenome']) ?>

                            </div>

                        </div>

                        <!--senha e re-senha-->
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <input id="senha" name="senha" type="password" class="validate">
                                <label for="password">Senha</label>
                                <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'senha']) ?>
                                <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'conf']) ?>

                            </div>

                            <div class="input-field col s12 m6">
                                <input id="senhaa" name="senhare" type="password" class="validate">
                                <label for="password">Repita a senha</label>
                                <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'senha1']) ?>
                                <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'conf']) ?>

                            </div>
                        </div>
                        <!--email-->

                        <div class="row">
                            <div class="input-field col s12 ">
                                <input placeholder="Ex: exemplo@gmail.com" name="email" onfocusout="M.toast({html: value
                                })" value="<?= @$email ?>"
                                       id="email" type="email" class="validate">
                                <label for="email">Email</label>
                                 <?php $this->incluirVisao('util/formErroCadastro.php', ['campo' => 'email']) ?>
                            </div>
                        </div>


                        <!--imagem perfil-->


                        <div class="row">
                            <div class="input-field col offset-s2 s12  m12  ">

                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>Imagen para o perfil</span>
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

                            <button class="btn waves-effect waves-light" type="submit" name="action">Salvar
                                <i class="material-icons right">cloud_done
                                </i>
                            </button>
                        </div>


                    </form>


                </div>
            </div>
        </div>
    </div>


</div>
<h6 class="center"><a href="<?= URL_RAIZ . 'login' ?>" >Voltar para tela de Login</a></h6>


<a onclick="M.toast({html: 'Exitem erros'})" class="btn">Toast!</a>