<?php
	class InternaController extends DefaultController
	{
		private function initContent($vars = NULL){
			$this->initConteudoJson($vars);
			if(!empty($this->content['editorials'][0]['CAT_QTD'])){
				$this->initProdutoJson(array("NOSEO" => true, "VARS" => array("ID" => $this->content['editorials'][0]['CAT_QTD'])));
			}
			$this->bodyId = "interna";
		}
		public function noticia($vars = NULL)
		{
			$this->initContent($vars);
		}
		public function video($vars = NULL)
		{
			$this->initContent($vars);
		}
		public function galeria($vars = NULL)
		{

			$configs = Configurator::init();
			$this->fileFormats = $configs->getViewConfig("imageFormats");


			$this->initContent($vars);
		}
		public function seteerros($vars = NULL)
		{
			$this->initContent($vars);
			//var_dump($this);
			/*if(!empty($vars['JSON'])){
				$this->items = $vars['JSON'];
			}else{
				if(Document::hasFile(APP_JSON_PATH."SITE_".APP_DEFAULT_EDITORIAL."_VD.json")){
					$this->items = json_decode(file_get_contents(APP_JSON_PATH."SITE_".APP_DEFAULT_EDITORIAL."_VD.json"), true);
				}
			}*/
		}
		public function pagina($vars = NULL)
		{
			$this->initContent($vars);
			if(!empty($this->json["CNT_EMB"])){
				if($this->verifyTemplateExists($this->json["CNT_EMB"])){
					$this->setTemplate($this->json["CNT_EMB"]);
				}
			}
		}
	}
?>
