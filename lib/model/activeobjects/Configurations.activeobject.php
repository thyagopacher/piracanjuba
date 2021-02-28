<?php
	class Configurations extends ActiveObject {
		protected $activeModel = "ConfigurationsModel";
		protected $FID = "id";
		public function getID()
		{
			return $this->returnKey("id");
		}

		public function getName()
		{
			return $this->returnKey("name");
		}

		public function getValue()
		{
			return $this->returnKey("value");
		}

		public function getStatus()
		{
			return $this->returnKey("status");
		}

		public function getProperties()
		{
			return $this->params;
		}
		
	}
?>