<?php
	class Uploads extends Comentarios {
		protected $activeModel = "UploadsModel";
		protected $content;
		protected $FID = "MSG_ID";
		public function getArquivo(){
			$id = parent::getMSGTXT();
			$arquivo = ArquivoModel::getOne($id);
			
			if(!empty($arquivo[0])){
				return $arquivo[0];
			}
			return false;
		}
		public function getMSGTXT(){
			$arquivo = $this->getArquivo();
			if($arquivo){
				return $arquivo->getPath();
			}
			return "";
		}
	}
?>