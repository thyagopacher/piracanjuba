<!-- Aside -->
<aside>
	<h1 class="HomeDashboard"><a href="<?php echo($this->editorial->getURL());?>">Painel</a></h1>
	<?php if(!empty($this->itens[0])): ?>
	<!-- Menu -->
	<ul class="mainMenu">
		<?php $i=0;$mnuLast = ""; foreach($this->itens as $item): ?>
			<?php if($item != NULL):  ?>
		<?php if($i > 0 && $mnuLast != $item->getMNUGRP()):?>
			</ul>
		</li>
		<?php endif; ?>
		<?php if($mnuLast != $item->getMNUGRP()): ?>
		<li>
			<a href="#"><?php echo(preg_replace("/([0-9]+)(\. )/", "", $item->getMNUGRP())); ?></a>
			<ul>
				<?php $mnuLast = $item->getMNUGRP(); endif; ?>
				<li<?php if(!empty($this->selectedMenu) && $this->selectedMenu->getMNUID() == $item->getMNUID()){?> class="selected"<?php } ?>><a href="<?php echo($this->generateEdtURL(array($item->getMNUTIP()))); ?>" rel="menu-<?php echo($item->getMNUID()); ?>"><?php echo($item->getMNUTIT()); ?></a></li>
		<?php endif; $i++; endforeach; ?>
	</ul>
	<!-- /Menu -->
	<?php endif; ?>
</aside>
<!-- /Aside -->