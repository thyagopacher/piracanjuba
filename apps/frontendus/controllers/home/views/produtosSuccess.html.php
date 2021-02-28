<section id="insideContent">
	<div class="alignContent">
		<ul class="productList">

			<?php
			$i = 1;

			foreach($this->categorias as $categoria){

				$foto = $categoria->getCATFTO();
				if(!empty($foto)){
					$foto = $foto->getFile()->getPath2();
				}else{
					$foto = "";
				}
				$prod = $this->produto[$categoria->CAT_ID];
				if(!empty($prod)){
					$fotoProd = $prod->getCNTFTO();

					if(!empty($fotoProd)){
						$fotoProd = $fotoProd->getFile()->getFormat("250x250");
					}else{
						$fotoProd = "";
					}
				}else{
					$fotoProd = "";
				}

				$fto = $categoria->getCATFTO();


				if(empty($this->produto[$categoria->CAT_ID]) || empty($fto)){
					continue;
				}
				$content = $this->produto[$categoria->CAT_ID];

				?>
				<li class="bebidas">

					<div class="background" style="background-image: url(<?=$foto;?>);"></div>
					<div class="description">
						<a href="<?=$this->produto[$categoria->CAT_ID]->getUrl()?>"><img src="<?=$fotoProd?>"></a>
						<h3><a href="produtos/<?=Slugfy2($this->produto[$categoria->CAT_ID]->CNT_TIT);?>-<?=$this->produto[$categoria->CAT_ID]->CNT_ID?>"><?=$categoria->CAT_NOM?></a></h3>
					</div>
				</li>
			<?php

			}
			?>


		</ul>
	</div>
</section>
