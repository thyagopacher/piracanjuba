<?php
	class Testesrespostas extends ActiveObject {
		protected $activeModel = "TestesrespostasModel";
		protected $FID = "TSR_ID";
		public function getTSRID()
		{
			return $this->returnKey("TSR_ID");
		}

		public function getTSRIPR()
		{
			return $this->returnKey("TSR_IPR");
		}

		public function getTSRTES()
		{
			return $this->returnKey("TSR_TES");
		}

		public function getTSRINI()
		{
			return $this->returnKey("TSR_INI");
		}

		public function getTSRFIM()
		{
			return $this->returnKey("TSR_FIM");
		}

		public function getTSRTIT()
		{
			return $this->returnKey("TSR_TIT");
		}

		public function getTSRTXT()
		{
			return $this->returnKey("TSR_TXT");
		}

		public function getTSRFT1()
		{
			return $this->returnKey("TSR_FT1");
		}

		public function getTSRSTS()
		{
			return $this->returnKey("TSR_STS");
		}

		public function getProperties()
		{
			return $this->params;
		}
		public function delete()
		{
			$this->params['TSR_STS'] = 9;
			return $this->save();	
		}
		public function save()
		{
		  return parent::save();
		}
	}
?>