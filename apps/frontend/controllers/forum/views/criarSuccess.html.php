
<!--DESTAQUE TOPO-->
<div id="destaque-topo">
	<div class="logo-segmento-interno"><img src="<?php echo (APP_JS_PREFIX); ?>img/logos-categoria/<?php if(!empty($this->items["PDT_URL"])): echo ($this->logos("/".$this->items["PDT_URL"])); endif; ?>" width="300" height="210" /></div>
	<!---redes sociais--->
	<?php $this->insertBlock("home", "redesocial"); ?>
	
	
	<!--área de pesquisa-->
	<?php $this->includePartial("home", "busca"); ?>

	<div class="titulo-pagina">
		<div class="box-titulo">
			<h1 class="cor-<?php if(!empty($this->items["PDT_URL"])): echo ($this->cores("/".$this->items["PDT_URL"])); endif; ?>"><?php echo ((!empty($this->items['PDT_NOM']))?$this->items['PDT_NOM']:"Cidade Alerta - Marcelo Rezende");?></h1>
		</div>		 
	</div>	
	
	<div class="geral">&nbsp;</div>
	<div class="geral">&nbsp;</div>
	<form action="<?php echo(APP_WEB_PREFIX); ?>forum/novo.html" method="post">
		<?php if(!empty($this->errors)): ?>
			<ul class="errors">
				<?php foreach($this->errors as $error): ?>
				<li><?php echo($error); ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
		<fieldset>
			<input type="text" name="forum[titulo]" id="forum-titulo" placeholder="Título" <?php echo($this->writeValue('titulo', @$_POST['forum'])); ?>/>
			<textarea name="forum[texto]" id="forum-texto" class="tinymce"><?php echo($this->writeValue('texto', @$_POST['forum'], 'textarea')); ?></textarea>
			<input type="hidden" name="forum[user][uid]" id="forum-uid" class="facebook-uid"/>
			<input type="hidden" name="forum[user][email]" id="forum-email" class="facebook-email" />
			<input type="hidden" name="forum[user][name]" id="forum-name" class="facebook-name" />
			<button type="submit" class="btn">Salvar</button>
		</fieldset>
	</form>
</div>
<!--FINAL DESTAQUE TOPO-->