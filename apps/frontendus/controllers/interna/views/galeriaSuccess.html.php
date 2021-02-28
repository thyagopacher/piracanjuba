
<?php

	$news = $this->vars['content'];

	$url = $this->items['PDT_URL'];


	$cor = $this->cores("/".$url);
?>
<!--DESTAQUE TOPO-->
<div id="destaque-topo">
	<div class="logo-segmento-interno"><img src="<?php echo (APP_JS_PREFIX); ?>img/logos-categoria/cidade-alerta.png" width="300" height="210" /></div>

    <!---redes sociais--->
    <?php $this->insertBlock("home", "redesocial"); ?>


    <!--área de pesquisa-->
    <?php $this->includePartial("home", "busca"); ?>



 	<div class="geral">&nbsp;</div>
    <div class="titulo-pagina">
		<div class="box-titulo">
			<h1 class="cor-<?php echo ($cor); ?>"><?php echo ($news['CNT_TIT']); ?></h1>
		</div>
    </div>



	<?php if(!empty($news['CNT_TXT'])): ?>
		<div class="geral">&nbsp;</div>
	<div class="geral"><?php echo ($news['CNT_TXT']); ?></div>
<?php endif; ?>
	<?php
	$size = (!empty($news['CNT_TAG']))?$news['CNT_TAG']:"750x665";
	$s = $this->fileFormats[$size];
	?>
    <div class="geral">&nbsp;</div>
		<div class="sliderShow <?php echo(Slugfy("width-".$size)); ?>">
			<div class="mask">
				<?php
					if (!empty($news['fotos'])):
				?>
			    	<ul>
						<?php
							foreach($news['fotos'] as $foto):
								if (!empty($foto['fto'])):
								$fto = $foto['fto'];
						?>
			        	<li>
									<img src="<?php echo ($fto[$size]); ?>" />
									<div class="hidden">
										<h3><?php echo(($foto['ARC_TIT'])); ?></h3>
										<div>
											<?php echo(($foto['ARC_TXT'])); ?>
										</div>
									</div>
								</li>
						<?php endif; endforeach; ?>
					<?php endif; ?>
				</ul>
			</div>
			<nav>
				<a class="btnPrev" href="#prev">&lt;</a>
				<a class="btnNext" href="#next">&gt;</a>
			</nav>
			<div class="shower"></div>
		</div>

		<style>
			.hidden {
				display: none;
			}

		.sliderShow {
			position: relative;
			clear:both;
		}
		.sliderShow .mask  {
			width: 750px;
			height: 665px;
			position: relative;
			overflow: hidden;
		}
		.sliderShow .mask ul {
			position: absolute;
		}
		.sliderShow .mask ul li {
			width: 750px;
			float: left;
		}
		.sliderShow nav {
			width: 60px;
			position: absolute;
			top: 600px;
			right: 50px;
		}
		.sliderShow nav a {
			width: 30px;
			height: 30px;
			float: left;
			display: block;
			text-decoration: none;
			text-align: center;
			line-height: 30px;
			background-color: #144FB0;
			color: #FFFFFF;
			/*transição dos elementos*/
			-webkit-transition: all .2s ease-out;
			-moz-transition: all .2s ease-out;
			-o-transition: all .2s ease-out;
			transition: all .2s ease-out;
			cursor: pointer;
		}
		.sliderShow nav a:hover {
			background-color: #fff;
			color: #144FB0;
		}
		.shower {
			background: #f1f1f1;
			padding: 20px 30px;
			border-bottom: 1px solid #0a529c;
		}

	.sliderShow:before {
    content: "";
    display: block;
    width: 1px;
    height: 1px;
    overflow: hidden;
    border-bottom: 10px solid transparent;
    border-right: 10px solid transparent;
    border-left: 10px solid transparent;
		border-top: 10px solid #f1f1f1;
    position: absolute;
    right: 20%;
    top: 0;
    margin-left: -10px;
		z-index: 1000;
	}
	.titulo-pagina {
		height: auto;
	}
		</style>
		<style>
			.width-<?php echo($size); ?> {
				margin: 0 auto;
			}
			.width-<?php echo($size); ?>, .width-<?php echo($size); ?> .mask {
				width: <?php echo($s[0]); ?>px;
			}
			.width-<?php echo($size); ?> .mask {
				height: <?php echo($s[1]); ?>px;
			}
			.sliderShow nav {
				top: <?php echo(($s[1]-40)); ?>px;
			}
		</style>
	<script>
	function SliderGal($){
		$.fn.SliderGal = function (options){
			var defaults = {};
			var opts  = $.extend(defaults, options);
			return this.each(function (){
				var $this = $(this), $mask = $(".mask", $this), $slide = $("ul", $mask), $itens = $("li", $slide), $desc = $(".shower", $this), $btnPrev = $(".btnPrev", $this), $btnNext = $(".btnNext", $this);


				var width = $itens.width() * $itens.length;
				$slide.css({"width": width+"px"});

				var $first = $("li:first", $slide);

				$.fn.SliderGal.setItem = function ($item){
					$itens.removeClass("active");
					$item.addClass("active");
					var html = $(".hidden", $item).html();
					$desc.animate({opacity: 0}, 500, function (){
						$desc.html(html);
						$desc.animate({opacity: 1}, 500);
					})

				}
				$.fn.SliderGal.setItem($first);

				$btnPrev.click(function (){
					var $currentSelected = $("li.active", $slide);
					var $to = $currentSelected.prev("li");
					if($to[0]){
						var index = $itens.index($to);

						var wdt = $itens.width();
						var pos  = ((wdt*index)*(-1));
						$slide.animate({left: pos+"px"}, 500, function (){
							$.fn.SliderGal.setItem($to);
						});
					}
					return false;
				})
				$btnNext.click(function (){
					var $currentSelected = $("li.active", $slide);
					var $to = $currentSelected.next("li");
					if($to[0]){
						var index = $itens.index($to);

						var wdt = $itens.width();
						var pos  = ((wdt*index)*(-1));
						$slide.animate({left: pos+"px"}, 500, function (){
							$.fn.SliderGal.setItem($to);
						});
					}

					return false;
				})

			})
		}
	}
	SliderGal(jQuery)
	$(document).ready(function (){
		$(".sliderShow").SliderGal();
	})
	</script>

    <div class="geral">&nbsp;</div>


 </div>


    <!--FINAL DAS NOTICIAS RELACIONADAS-->
