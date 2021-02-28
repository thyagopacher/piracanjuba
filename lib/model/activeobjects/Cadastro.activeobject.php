<?php
	class Cadastro extends ActiveObject {
		protected $activeModel = "CadastroModel";
		protected $FID = "CAD_ID";
		public function getCADID()
		{
			return $this->returnKey("CAD_ID");
		}
		public function setType($type)
		{
			switch($type){
				case "USER":
					$this->CAD_TIP = "CADUSU";
				break;
				case "ENTERPRISE":
					$this->CAD_TIP = "CADENT";
				break;
				case "PRESS":
					$this->CAD_TIP = "CADPRE";
				break;
			}
		}
		
		public function getCADNOM()
		{
			return $this->returnKey("CAD_NOM");
		}
		public function getCADTEL()
		{
			return $this->returnKey("CAD_TEL");
		}
		public function getCADSTS()
		{
			return $this->returnKey("CAD_STS");
		}
		public function getStatus()
		{
			return $this->getCADSTS();
		}
		public function getCADTIP()
		{
			return $this->returnKey("CAD_TIP");
		}
		public function getCADEST()
		{
			return $this->returnKey("CAD_EST");
		}
		public function getCADCID()
		{
			return $this->returnKey("CAD_CID");
		}
		public function getCADEMA()
		{
			return $this->returnKey("CAD_EMA");
		}
		public function getCADPAS()
		{
			return $this->returnKey("CAD_PAS");
		}
		public function getCADNEW()
		{
			return $this->returnKey("CAD_NEW");
		}
		public function getCADSEX()
		{
			return $this->returnKey("CAD_SEX");
		}
		public function getCADCAR()
		{
			return $this->returnKey("CAD_CAR");
		}
		public function getCADSIT()
		{
			return $this->returnKey("CAD_SIT");
		}
		public function getCADCPF()
		{
			return $this->returnKey("CAD_CPF");
		}
		public function getCADRG()
		{
			return $this->returnKey("CAD_RG");
		}
		public function getCADDAT()
		{
			return $this->returnKey("CAD_DAT");
		}
		public function getCADRAM()
		{
			return $this->returnKey("CAD_RAM");
		}
		public function getCADCNPJ()
		{
			return $this->returnKey("CAD_CNPJ");
		}
		public function getCADNIC()
		{
			return $this->returnKey("CAD_NIC");
		}
		public function getCADTWI()
		{
			return $this->returnKey("CAD_TWI");
		}
		public function getCADCEL()
		{
			return $this->returnKey("CAD_CEL");
		}
		public function getCADFAX()
		{
			return $this->returnKey("CAD_FAX");
		}
		public function getEditorials($taxonomy = "CAT_EMP")
		{
			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_categorias_conteudos`.`CCL_CNT`", $this->getCADID(), FuriousExpressionsDB::EQUAL);
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.`CCL_CAT`", "`cnt_categorias`.`CAT_ID`");
			$criteria->add("`cnt_categorias_conteudos`.`CCL_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_categorias_conteudos`.`CCL_TIP`", $taxonomy, FuriousExpressionsDB::EQUAL);
			$categories = CategoriasModel::doSelect($criteria);
			return $categories;
		}
		public function getProperties()
		{
			return $this->params;
		}
	}
?>