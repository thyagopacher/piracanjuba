<?php
	class Estado extends ActiveObject {
		protected $FID = "id";
		protected $activeModel = "EstadoModel";
		public function getID()
		{
			return $this->getDTQID();
		}

		public function getEID()
		{
			return $this->returnKey("id");
		}
		public function getNome()
		{
			return $this->returnKey("nome");
		}
		public function getSigla()
		{
			return $this->returnKey("sigla");
		}


	}
?>