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

                <a href="#" class="brand-logo ">Sistema de Perguntas</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="<?= URL_RAIZ ?>">home</a></li>
                    <li><a href="<?= URL_RAIZ . 'login' ?>">login</a></li>
                    <li><a href="<?= URL_RAIZ . 'quest_no_logado' ?>">questões</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<main>


<!--    <ul id="slide-out" class="sidenav">-->
<!--        <li>-->
<!--            <div class="user-view">-->
<!--                <div class="background">-->
<!--                    <img src="images/office.jpg">-->
<!--                </div>-->
<!--                <a href="#user"><img class="circle" src="--><?//= URL_IMG  . 'login.png'?><!--"></a>-->
<!--                <a href="#name"><span class="white-text name">John Doe</span></a>-->
<!--                <a href="#email"><span class="white-text email">jdandturk@gmail.com</span></a>-->
<!--            </div>-->
<!--        </li>-->
<!--        <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>-->
<!--        <li><a href="#!">Second Link</a></li>-->
<!--        <li>-->
<!--            <div class="divider"></div>-->
<!--        </li>-->
<!--        <li><a class="subheader">Subheader</a></li>-->
<!--        <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>-->
<!--    </ul>-->
<!--    <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>-->


    <div class="container">

        <?php $this->imprimirConteudo() ?>


    </div>
</main>


<footer class=" page-footer">


    <div class="footer-copyright">
        <div class="container">
            © 2019 Copyright Ricardo de Oliveira - Universidade Tecnológica Federal do Paraná - UTFPR
            <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
        </div>
    </div>

</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript" src="<?= URL_JS . 'materialize.min.js' ?>"></script>
<script type="text/javascript" src="<?= URL_JS . 'main.js' ?>"></script>
</body>
</html>

