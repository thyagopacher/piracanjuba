<?php
	class Arquivoconteudo extends ActiveObject {
		protected $activeModel = "ArquivoconteudoModel";
		private $file = "";
		protected $FID = "ARC_ID";
		public function getARCID()
		{
			return $this->returnKey("ARC_ID");
		}

		public function getARCORD()
		{
			return $this->returnKey("ARC_ORD");
		}

		public function getARCAID()
		{
			return $this->returnKey("ARC_AID");
		}

		public function getARCCID()
		{
			return $this->returnKey("ARC_CID");
		}
		public function getARCTIT()
		{
			return $this->returnKey("ARC_TIT");
		}

		public function getARCCTP()
		{
			return $this->returnKey("ARC_CTP");
		}

		public function getARCTXT()
		{
			return $this->returnKey("ARC_TXT");
		}
		public function getARCSTS()
		{
			return $this->returnKey("ARC_STS");
		}
		public function getFile()
		{
			$this->file = ArquivoModel::getOne($this->getARCAID());
			if(!empty($this->file[0]))
			{
				return $this->file[0];
			}
			return false; 
		}
		public function unpublished()
		{
			$this->params['ARC_STS'] = 9;
			$this->save();
		}
		public function toJSON()
		{
			$ret = new StdClass();
			foreach($this->getProperties() as $prop => $value)
			{
				$ret->$prop = utf8_encode($value);
			}
			$file = $this->getFile();
			$ret->fto = $file->toJSON();
			
			return $ret;
			
		}
		public function delete()
		{
			return $this->unpublished();
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