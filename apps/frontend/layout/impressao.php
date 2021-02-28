<?php
header("Content-type: text/html; charset=ISO-8859-1;");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php //echo($this->headers); ?>
    <link rel="stylesheet" href="<?php echo(APP_JS_PREFIX); ?>css/style_front.css"/>
    <link rel="stylesheet" href="<?php echo(APP_JS_PREFIX); ?>css/desktop_front.css" media="screen and (min-device-width: 1024px)"/>
    <link rel="stylesheet" href="<?php echo(APP_JS_PREFIX); ?>css/responsivo.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script>
        window.onload = function() { window.print(); }
    </script>

</head>
<body class="<?=$this->bodyClasses;?>">
<header id="insideHeader">
    <?php
    if(empty($this->heading['PAGETITLE'])){
        // Prevent object overload notice
        $headings = $this->heading;
        $headings['PAGETITLE'] = $this->pageTitle;
        $this->heading = $headings;
    }

    ?>

    <?php $this->insertBlock("home", "heading", $this->heading); ?>

    <?php echo $this->content; ?>
