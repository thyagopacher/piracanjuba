<?php
	class Mensagens extends ActiveObject {
		protected $activeModel = "MensagensModel";
		protected $FID = "MSG_ID";
		public function getID()
		{
			return $this->getMSGID();
		}
		public function getMSGID()
		{
			return $this->returnKey("MSG_ID");
		}

		public function getMSGIPR()
		{
			return $this->returnKey("MSG_IPR");
		}

		public function getMSGCNT()
		{
			return $this->returnKey("MSG_CNT");
		}

		public function getMSGNOM()
		{
			return $this->returnKey("MSG_NOM");
		}

		public function getMSGEMA()
		{
			return $this->returnKey("MSG_EMA");
		}

		public function getMSGTIT()
		{
			return $this->returnKey("MSG_TIT");
		}

		public function getMSGTEL()
		{
			return $this->returnKey("MSG_TEL");
		}

		public function getMSGTXT()
		{
			return $this->returnKey("MSG_TXT");
		}
		public function getArquivo()
		{
			$id = $this->getMSGTXT();
			if(!empty($id) && (is_numeric($id)))
			{
				$id = (int)$id;
				$arquivo = ArquivoModel::getOne($id);
				if(!empty($arquivo[0]))
				{
					return $arquivo[0];
				}
			}
			return false;
		}
		public function getArquivo2()
		{
			$id = $this->getMSGRSP();
			if(!empty($id) && (is_numeric($id)))
			{
				$id = (int)$id;
				$arquivo = ArquivoModel::getOne($id);
				if(!empty($arquivo[0]))
				{
					return $arquivo[0];
				}
			}
			return false;
		}

		public function getMSGRSP()
		{
			return $this->returnKey("MSG_RSP");
		}
		public function getMSGCTI()
		{
			return $this->returnKey("MSG_CTI");
		}

		public function getMSGDTA()
		{
			return $this->returnKey("MSG_DTA");
		}

		public function getMSGSTS()
		{
			return $this->returnKey("MSG_STS");
		}
		public function getDTA()
		{
			return $this->getMSGDTA();
		}
		public function getMSGNOT()
		{
			return $this->returnKey("MSG_NOT");
		}
		public function getStatus()
		{
			return $this->getMSGSTS();
		}


		public function getProperties()
		{
			return $this->params;
		}
		public function save()
		{
		 	return parent::save();
		}
		public function toJSON(){
			$news = new StdClass();
			foreach($this->getProperties() as $prop => $value)
			{
				$news->$prop = utf8_encode($value);
			}
			if($news->MSG_CNT == 67 || $news->MSG_CNT == 68){
					$file = $this->getArquivo();

					if($file){
						$news->File1 = $file->toJSON();
					}
					$file2 = $this->getArquivo2();
					if($file2){
						$news->File2 = $file2->toJSON();
					}

			}
			return $news;
		}
	}
?>
