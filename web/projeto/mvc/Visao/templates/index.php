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

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>


</head>
<body >
<header>

    <nav> <div class="container">
        <div class="nav-wrapper">

            <a href="#" class="brand-logo ">Logo</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="<?= URL_RAIZ  ?>">home</a></li>
                <li><a href="<?= URL_RAIZ .'login' ?>">login</a></li>
                <li><a href="collapsible.html">questões</a></li>
            </ul>
            </div>
        </div>
    </nav>
</header>
<main>

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

<script type="text/javascript" src="<?= URL_JS . 'materialize.min.js' ?>"></script>
</body>
</html>

