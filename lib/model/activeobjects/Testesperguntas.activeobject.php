<?php
	class Testesperguntas extends ActiveObject {
		protected $activeModel = "TestesperguntasModel";
		protected $FID = "TSP_ID";
		public function getTSPID()
		{
			return $this->returnKey("TSP_ID");
		}

		public function getTSPIPR()
		{
			return $this->returnKey("TSP_IPR");
		}

		public function getTSPTES()
		{
			return $this->returnKey("TSP_TES");
		}

		public function getTSPORD()
		{
			return $this->returnKey("TSP_ORD");
		}

		public function getTSPTIT()
		{
			return $this->returnKey("TSP_TIT");
		}

		public function getTSPTXT()
		{
			return $this->returnKey("TSP_TXT");
		}

		public function getTSPFT1()
		{
			return $this->returnKey("TSP_FT1");
		}

		public function getTSPAL1()
		{
			return $this->returnKey("TSP_AL1");
		}

		public function getTSPAL2()
		{
			return $this->returnKey("TSP_AL2");
		}

		public function getTSPAL3()
		{
			return $this->returnKey("TSP_AL3");
		}

		public function getTSPAL4()
		{
			return $this->returnKey("TSP_AL4");
		}

		public function getTSPAL5()
		{
			return $this->returnKey("TSP_AL5");
		}

		public function getTSPAL6()
		{
			return $this->returnKey("TSP_AL6");
		}

		public function getTSPAL7()
		{
			return $this->returnKey("TSP_AL7");
		}

		public function getTSPAL8()
		{
			return $this->returnKey("TSP_AL8");
		}

		public function getTSPAL9()
		{
			return $this->returnKey("TSP_AL9");
		}

		public function getTSPAL0()
		{
			return $this->returnKey("TSP_AL0");
		}

		public function getTSPPT1()
		{
			return $this->returnKey("TSP_PT1");
		}

		public function getTSPPT2()
		{
			return $this->returnKey("TSP_PT2");
		}

		public function getTSPPT3()
		{
			return $this->returnKey("TSP_PT3");
		}

		public function getTSPPT4()
		{
			return $this->returnKey("TSP_PT4");
		}

		public function getTSPPT5()
		{
			return $this->returnKey("TSP_PT5");
		}

		public function getTSPPT6()
		{
			return $this->returnKey("TSP_PT6");
		}

		public function getTSPPT7()
		{
			return $this->returnKey("TSP_PT7");
		}

		public function getTSPPT8()
		{
			return $this->returnKey("TSP_PT8");
		}

		public function getTSPPT9()
		{
			return $this->returnKey("TSP_PT9");
		}

		public function getTSPPT0()
		{
			return $this->returnKey("TSP_PT0");
		}

		public function getTSPSTS()
		{
			return $this->returnKey("TSP_STS");
		}

		public function getProperties()
		{
			return $this->params;
		}
		public function delete()
		{
			$this->params['TSP_STS'] = 9;
			return $this->save();
		}
		public function save()
		{
		 return parent::save();
		}
	}
?>