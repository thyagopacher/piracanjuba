<?php
	class Securitymenu extends ActiveObject {
		protected $activeModel = "SecuritymenuModel";
		protected $FID = "MSC_ID";
		public function getMSCID()
		{
			return $this->returnKey("MSC_ID");
		}

		public function getMSCIGR()
		{
			return $this->returnKey("MSC_IGR");
		}

		public function getMSCIMN()
		{
			return $this->returnKey("MSC_IMN");
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