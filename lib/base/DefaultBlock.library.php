<?php
	class DefaultBlock {


		public function __construct()
		{
			if(APP_NAME != "backend"){
				$produtoModel =ProdutoModel::getOne(APP_DEFAULT_EDITORIAL);
				$this->site = $produtoModel[0];
			}
		}

		protected function initVars ($vars)
		{
			if(!empty($vars["CONTAINER"]))
			{
				$this->container = $vars["CONTAINER"];
			}
			if(!empty($vars["CONTENT"]))
			{
				$this->content = $vars["CONTENT"];
			}
		}

		protected function generateJsonPath($id){
			return "json/".substr("0000".$id,-4,-2)."/".substr("00".$id,-2)."/";
		}
		protected function initJsonDtq($vars = NULL){
			if(!empty( $vars['ID'])){
				$id = $vars['ID'];
				$dir = Document::generateDirStructure($id);
				if(Document::hasFile($dir."DTQ_".APP_DEFAULT_EDITORIAL."_{$id}.json")){
					$this->items = json_decode(file_get_contents($dir."DTQ_".APP_DEFAULT_EDITORIAL."_{$id}.json"), true);
				}
			}
		}

		protected function loadContent($id){
			if(!empty($id)){
				$dir = Document::generateDirStructure($id);
				if(Document::hasFile($dir."CNT_{$id}.json")){
					return json_decode(file_get_contents($dir."CNT_{$id}.json"), true);
				}
			}
		}
	}
?>
