<?php
	class Cidades extends ActiveObject {
		protected $FID = "id";
		protected $activeModel = "CidadesModel";
		public function getID()
		{
			return $this->getCID();
		}

		public function getCID()
		{
			return $this->returnKey("id");
		}
		public function getCNome()
		{
			return $this->returnKey("nome");
		}
		public function getCESTADOID()
		{
			return $this->returnKey("estado_id");
		}


	}
?>