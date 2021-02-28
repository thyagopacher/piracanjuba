<?php header("Content-type: text/html; charset=iso-8859-1"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
<head>
	<meta charset="iso-8859-1">
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<?php echo($this->headers); ?>
	<script type="text/javascript" src="<?php echo(APP_JS_PREFIX); ?>js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo(APP_JS_PREFIX); ?>js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo(APP_JS_PREFIX); ?>js/tiny_mce/jquery.tinymce.js"></script>
	<script type="text/javascript" src="<?php echo(APP_JS_PREFIX); ?>js/masonry.pkgd.min.js"></script>
	<script type="text/javascript" src="<?php echo(APP_JS_PREFIX); ?>js/funcs.js?122"></script>
	
</head>
<body class="<?php echo($this->bodyClasses); ?>">
	<!-- Header -->
	<header>
		<?php if($this->isUserLogged()): ?>
		<?php $this->insertBlock("home", "userspace");  ?>
		
		<!-- Logo -->
		<a class="siteLogo" href="<?php echo($this->Site->getURL()); ?>">Container Digital</a>
		<!-- /Logo -->
		<?php $this->insertBlock("home", "siteSelector"); ?>
		<?php $this->insertBlock("home", "EditorialMenus"); ?>
		
		
	</header>
	<!-- /Header -->
	<?php endif; ?>
	<div class="contentFrame">
		<?php $this->insertBlock("home", "Menu"); ?>
		<!-- Section -->
		<section>
			<!-- Spacer -->
			<div id="homeDashboard" class="spacer">
					<?php echo($this->content); ?>
			</div>
			<!-- /Spacer -->
		</section>
		<!-- /Section -->
	</div>
</body>
</html>