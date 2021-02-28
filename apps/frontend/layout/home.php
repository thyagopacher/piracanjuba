<?php
header("Content-type: text/html; charset=UTF-8;");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Piracanjuba</title>
        <link rel="stylesheet" href="<?php echo(APP_JS_PREFIX); ?>css/style_front.css"/>
        <link rel="stylesheet" href="<?php echo(APP_JS_PREFIX); ?>css/desktop_front.css"
              media="screen and (min-device-width: 1024px)"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="<?php echo(APP_JS_PREFIX); ?>js/funcs_front.js"></script>

    </head>
<body class="<?=$this->bodyClasses;?>">
  <?php $this->insertBlock("home", "barRedes"); ?>
<!--  Header -->
<header id="heading">
    <nav id="primary-menu" class="main-menu">
        <ul>
            <li><a href="#" id="brandName">Piracanjuba</a></li>
            <li class="submenu">
                <a href="/a-piracanjuba" class="a-piracanjuba"><span>A Piracanjuba</span></a>
                <ul class="submenu">
                    <li><a href="#">Lipsum</a></li>
                </ul>
            </li>
            <li class="submenu">
                <a href="/produtos" class="produtos"><span>Produtos</span></a>
                <ul class="submenu">
                    <li><a href="#">Lipsum</a></li>
                </ul>
            </li>
            <li class="submenu">
                <a href="/receitas" class="receitas"><span>Receitas</span></a>
                <ul class="submenu">
                    <li><a href="#">Lipsum</a></li>
                </ul>
            </li>
            <li>
                <a href="/dicas-de-nutricao" class="dicas-de-nutricao"><span>Dicas de nutrição</span></a>
            </li>
            <li class="submenu">
                <a href="/produtos-de-leite" class="produtor-de-leite"><span>Produtor de leite</span></a>
                <ul class="submenu">
                    <li><a href="#">Lipsum</a></li>
                </ul>
            </li>
            <li>
                <a href="/fale-conosco" class="fale-conosco"><span>Fale conosco</span></a>
            </li>

        </ul>
    </nav>
</header>

<?php echo $this->content; ?>

<?php $this->insertBlock("home", "rodapePiracanjuba", array("CONTENT" => $this->content)); ?>
<?php $this->insertBlock("home", "aleitamento"); ?>

</body>
</html>
