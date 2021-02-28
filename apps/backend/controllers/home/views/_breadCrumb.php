<?php 
$arr = array();
foreach($this->links as $link => $name): 
	$arr[] = "<a href=\"{$link}\">{$name}</a>";
endforeach; 
$arr[(count($arr)-1)] = strip_tags($arr[(count($arr)-1)]);
?>
<p class="breadcrumb">Você está aqui: <?php echo(join(" &gt; ", $arr)); ?></p>