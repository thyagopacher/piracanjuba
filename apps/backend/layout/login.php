<?php header("Content-type: text/html; charset=iso-8859-1"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="iso-8859-1">
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<?php echo($this->headers); ?>

</head>
<body class="<?php echo($this->bodyClasses); ?>">
	<?php print($this->content); ?>
</body>
</html>
