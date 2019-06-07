<!DOCTYPE html>
<html>
<head>
    <title><?= APLICACAO_NOME ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?= URL_CSS . 'geral.css' ?>">
    <link rel="stylesheet" href="<?= URL_CSS . 'footer.css' ?>">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="<?= URL_CSS . 'materialize.min.css' ?>" media="screen,projection"/>

    <link rel="stylesheet" href="<?= URL_CSS . 'cores.css' ?>">
    <link rel="stylesheet" href="<?= URL_CSS . 'animate.css' ?>">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>


</head>
<body>


<header>
    <nav>
        <div class="container">
            <div class="nav-wrapper">

                <a href="#" class="brand-logo ">Logo</a>

                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="<?= URL_RAIZ ?>">home</a></li>
                    <li><a href="<?= URL_RAIZ . 'quest' ?>">questões</a></li>
                    <li><a href="<?= URL_RAIZ . 'sair' ?>">sair</a></li>

                </ul>


            </div>
        </div>
    </nav>
</header>


<main>
    <div class="container">

        <ul id="slide-out" class="sidenav">
            <li>
                <div class="user-view">
                    <div class="background">
                        <img src="<?= URL_IMG . 'fundo.jpg' ?>">
                    </div>

                    <a href="#user"><img class="circle" src="<?= URL_IMG . 'login.png' ?>"></a>
                    <a href="#name"><span class="white-text name">John Doe</span></a>
                    <a href="#email"><span class="white-text email">jdandturk@gmail.com</span></a>

                </div>

            </li>
            <li><a href="<?= URL_RAIZ . 'criarPage' ?>"><i class="material-icons">add_circle</i>Criar perguntas</a></li>
            <li><a href="<?= URL_RAIZ . 'responderPage' ?>"><i class="material-icons">chat</i>Responder</a></li>

            <li>
                <div class="divider">sdgds</div>
            </li>

            <li><a href="<?= URL_RAIZ . 'relatorioPage' ?>"><i class="material-icons">report </i>Relatório</a></li>
        </ul>


        <a href="#" data-target="slide-out"
           class="sidenav-trigger btn-floating btn-large waves-effect waves-light black">


            <i class="medium material-icons ">menu</i></a>


    </div>

    <div class="container">

        <?php $this->imprimirConteudo() ?>


    </div>
</main>


<footer class=" page-footer">


    <div class="footer-copyright">
        <div class="container">
            © 2014 Copyright Text
            <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
        </div>
    </div>

</footer>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript" src="<?= URL_JS . 'materialize.min.js' ?>"></script>
<script type="text/javascript" src="<?= URL_JS . 'main.js' ?>"></script>
</body>
</html>

