<?php
	class TabelaNutricional extends ActiveObject {
		protected $FID = "id";
		protected $activeModel = "TabelaNutricionalModel";
		public function getID()
		{
			return $this->getTABELAID();
		}

		public function getTABELAID()
		{
			return $this->returnKey("id");
		}
		public function getTABELAPRODUTOID()
		{
			return $this->returnKey("produto_id");
		}
		public function getTABELAVALORENERGICO()
		{
			return $this->returnKey("valor_energetico");
		}
		public function getTABELAVALORPORCAO()
		{
			return $this->returnKey("valor_por_porcao");
		}
		public function getTABELAQUANTIDADE()
		{
			return $this->returnKey("quantidade_porcao");
		}
		public function getTABELAPORCENTAGEM()
		{
			return $this->returnKey("porcentagem_por_porcao");
		}

		public function getTABELASTATUS()
		{
			return $this->returnKey("status");
		}
		public function getStatus()
		{
			return $this->getTABELASTATUS();
		}
		public function getProperties()
		{
			return $this->params;
		}
		public function save()
		{
			return parent::save();
		}


		public function toJSON()
		{


			$tag = new StdClass();
			foreach($this->getProperties() as $prop => $value)
			{
				$tag->$prop = utf8_encode($value);
			}


			return $tag;
		}

	}
?>
