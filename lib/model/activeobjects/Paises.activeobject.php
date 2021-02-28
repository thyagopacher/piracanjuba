<?php
	class Paises extends ActiveObject {
		protected $FID = "iso";
		protected $activeModel = "PaisesModel";
		public function getID()
		{
			return $this->getPAISISO();
		}

        public function getPAISISO()
        {
            return $this->returnKey("iso");
        }
		public function getPAISISO3()
		{
			return $this->returnKey("iso3");
		}
        public function getPAISNUMCODE()
        {
            return $this->returnKey("numcode");
        }

		public function getPAISNOME()
		{
			return $this->returnKey("nome");
		}


	}
?>