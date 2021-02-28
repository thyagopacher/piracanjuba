<?php
	class Sevenerrors extends ActiveObject {
		protected $activeModel = "SevenerrorsModel";
		protected $FID = "ER7_ID";
		public function getER7ID()
		{
			return $this->returnKey("ER7_ID");
		}

		public function getER7CNT()
		{
			return $this->returnKey("ER7_CNT");
		}

		public function getER7IMG1()
		{
			return $this->returnKey("ER7_IMG1");
		}

		public function getER7IMG2()
		{
			return $this->returnKey("ER7_IMG2");
		}

		public function getER7CO1()
		{
			return $this->returnKey("ER7_CO1");
		}

		public function getER7CO2()
		{
			return $this->returnKey("ER7_CO2");
		}

		public function getER7CO3()
		{
			return $this->returnKey("ER7_CO3");
		}

		public function getER7CO4()
		{
			return $this->returnKey("ER7_CO4");
		}

		public function getER7CO5()
		{
			return $this->returnKey("ER7_CO5");
		}

		public function getER7CO6()
		{
			return $this->returnKey("ER7_CO6");
		}

		public function getER7CO7()
		{
			return $this->returnKey("ER7_CO7");
		}

		public function getER7STS()
		{
			return $this->returnKey("ER7_STS");
		}
		public function getProperties()
		{
			return $this->params;
		}
		public function delete()
		{
			$this->params['ER7_STS'] = 9;
			$this->save();
		}
		public function save()
		{
		   return parent::save();
		}
	}
?>