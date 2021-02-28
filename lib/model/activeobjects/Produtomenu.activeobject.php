<?php
	class Produtomenu extends ActiveObject {
		protected $activeModel = "ProdutomenuModel";
		protected $FID = "MNU_ID";
		public function getMNUID()
		{
			return $this->returnKey("MNU_ID");
		}

		public function getMNUIPR()
		{
			return $this->returnKey("MNU_IPR");
		}

		public function getMNUORD()
		{
			return $this->returnKey("MNU_ORD");
		}

		public function getMNUDRE()
		{
			return $this->returnKey("MNU_DRE");
		}

		public function getMNUGRP()
		{
			return $this->returnKey("MNU_GRP");
		}

		public function getMNUTIT()
		{
			return $this->returnKey("MNU_TIT");
		}

		public function getMNUTIP()
		{
			return $this->returnKey("MNU_TIP");
		}

		public function getMNULNK()
		{
			return $this->returnKey("MNU_LNK");
		}

		public function getMNUURL()
		{
			return $this->returnKey("MNU_URL");
		}

		public function getMNUADM()
		{
			return $this->returnKey("MNU_ADM");
		}

		public function getMNUCHP()
		{
			return $this->returnKey("MNU_CHP");
		}

		public function getMNUEDT()
		{
			return $this->returnKey("MNU_EDT");
		}

		public function getMNUTXT()
		{
			return $this->returnKey("MNU_TXT");
		}

		public function getMNUWRD()
		{
			return $this->returnKey("MNU_WRD");
		}
		public function getMNUIMG3()
		{
			return $this->returnKey("MNU_IMG3");
		}
		public function getMNUEMB1()
		{
			return $this->returnKey("MNU_EMB1");
		}
		public function getMNUEMB2()
		{
			return $this->returnKey("MNU_EMB2");
		}

		public function getMNUIMG()
		{
			return $this->returnKey("MNU_IMG");
		}
		public function getMNUIMG2()
		{
			return $this->returnKey("MNU_IMG2");
		}

		public function getMNULIN()
		{
			return $this->returnKey("MNU_LIN");
		}

		public function getMNULN2()
		{
			return $this->returnKey("MNU_LN2");
		}

		public function getMNUTGT()
		{
			return $this->returnKey("MNU_TGT");
		}

		public function getMNUFTW()
		{
			return $this->returnKey("MNU_FTW");
		}

		public function getMNUFTR()
		{
			return $this->returnKey("MNU_FTR");
		}
		public function getMNULTX()
		{
			return $this->returnKey("MNU_LTX");
		}
		public function getMNUSTS()
		{
			return $this->returnKey("MNU_STS");
		}
		public function getMNUIRE()
		{
			return $this->returnKey("MNU_IRE");
		}
		public function getMNUCAT()
		{
			return $this->returnKey("MNU_CAT");
		}
		public function getMNUDTP()
		{
			return $this->returnKey("MNU_DTP");
		}
		public function getMNUDTA()
		{
			return $this->returnKey("MNU_DTA");
		}
		public function getMNUPRG()
		{
			return $this->returnKey("MNU_PRG");
		}
		
		public function getProperties()
		{
			return $this->params;
		}
		public function getMenuURL()
		{
			$edt = ProdutoModel::getOne($this->getMNUIPR());
			if(!empty($edt[0]))
			{
				$edt = $edt[0];
				return sprintf("%s%s.php", $edt->getURL(), $this->getMNUTIP());
			}
			return "";
		}
		public function toJSON()
		{
			$obj = new StdClass();
			foreach($this->getProperties() as $prop => $value)
			{
				$obj->$prop = utf8_encode($value);
			}
			return $obj;
		}
		public function toSmallJSON()
		{
			$obj = new StdClass();
			$tip = explode("/", $this->getMNUTIP());
			$obj->type = utf8_encode($tip[0]);
			$obj->name = utf8_encode($this->getMNUTIT());
			$obj->id = utf8_encode($this->getMNUID());
			return $obj;
		}
		public function save()
		{
		  return parent::save();
		}
	}
?>