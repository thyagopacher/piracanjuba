<?php
	class Grupo extends ActiveObject {
		protected $activeModel = "GrupoModel";
		protected $FID = "GRP_ID";
		
		public function getGRPID()
		{
			return $this->returnKey("GRP_ID");
		}

		public function getGRPTIT()
		{
			return $this->returnKey("GRP_TIT");
		}

		public function getGRPDES()
		{
			return $this->returnKey("GRP_DES");
		}

		public function getGRPSTS()
		{
			return $this->returnKey("GRP_STS");
		}

		public function getProperties()
		{
			return $this->params;
		}
		public function delete()
		{
			$this->params['GRP_STS'] = 9;
			return $this->save();
		}
		public function save()
		{
		 return  parent::save();
		}
	}
?>