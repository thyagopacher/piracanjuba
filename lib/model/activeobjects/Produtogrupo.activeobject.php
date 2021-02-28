<?php
	class Produtogrupo extends ActiveObject {
		protected $activeModel = "ProdutogrupoModel";
		protected $FID = "SEC_ID";
		public function getSECID()
		{
			return $this->returnKey("SEC_ID");
		}

		public function getSECIGR()
		{
			return $this->returnKey("SEC_IGR");
		}

		public function getSECIPR()
		{
			return $this->returnKey("SEC_IPR");
		}

		public function getProperties()
		{
			return $this->params;
		}
		public function save()
		{
		  return parent::save();
		}
	}
?>