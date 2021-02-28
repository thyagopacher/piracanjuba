<?php
	class Tagconteudo extends ActiveObject {
		protected $activeModel = "TagconteudoModel";
		protected $FID = "CTA_ID";
		
		public function getCTAID()
		{
			return $this->returnKey("CTA_ID");
		}

		public function getCTACNT()
		{
			return $this->returnKey("CTA_CNT");
		}

		public function getCTATAG()
		{
			return $this->returnKey("CTA_TAG");
		}

		public function getCTASTS()
		{
			return $this->returnKey("CTA_STS");
		}

		public function getProperties()
		{
			return $this->params;
		}
		public function unpublish()
		{
			$this->params["CTA_STS"] = 9;
			$this->save();
		}
		public function save()
		{
		  if(!empty($this->params['created_at']))
		  {
			  unset( $this->params['created_at'] );
		  }
		  parent::save();
		}
	}
?>