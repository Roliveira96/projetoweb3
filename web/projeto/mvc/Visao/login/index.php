<h1 class="hide">cod_1992</h1>



<div class="row">
    <h4 class="center">Login</h4>
    <h6 class="center">Por favor entre com suas informações</h6>


    <div class="col offset-s3 s6  offset-m3 m6 ">
        <div class="card  darken-1 z-depth-3">
            <div class="card-content" >

                <div class="center-block site">


                        <form action="<?= URL_RAIZ . 'login'?>" method="post" class="form-inline pull-left">
                            
                            
                            <div class="form ">
                                <img class="img_login" src="<?=URL_IMG.'login.png' ?>">
                            </div>
                            <div class="form">
                                <input id="usuario" name="usuario" class="form-control campo-form" autofocus
                                       placeholder="Email">
                            </div>
                            <div class="form">
                                <input id="texto" name="senha"   type="password" placeholder="Senha">
                            </div>

                            <div class="center form" >

                                <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>

                            
                            
                        </form>
                
                </div>
            </div>
        </div>
    </div>




</div>
<h6 class="center"><a href="<?= URL_RAIZ . 'cadastroUsuario' ?>" >Crie sua conta gratuitamente!</a></h6>