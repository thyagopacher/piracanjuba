<?php
	class Links extends ActiveObject {
		protected $activeModel = "LinksModel";
		protected $FID = "LNK_ID";
		public function getLNKID()
		{
			return $this->returnKey("LNK_ID");
		}

		public function getLNKIPR()
		{
			return $this->returnKey("LNK_IPR");
		}

		public function getLNKCNT()
		{
			return $this->returnKey("LNK_CNT");
		}

		public function getLNKTIP()
		{
			return $this->returnKey("LNK_TIP");
		}

		public function getLNKTIT()
		{
			return $this->returnKey("LNK_TIT");
		}

		public function getLNKLNK()
		{
			$link = $this->returnKey("LNK_LNK");


			if(APP_NAME == "frontend"){


				if(substr($this->returnKey("LNK_LNK"), 0, 1) == "/"){
					$link = "http://".$_SERVER['HTTP_HOST'].$this->returnKey("LNK_LNK");
				}



			}
			return $link;
		}

		public function getLNKSTS()
		{
			return $this->returnKey("LNK_STS");
		}

		public function getProperties()
		{
			return $this->params;
		}
		public function unpublish()
		{
			$this->params["LNK_STS"] = 9;
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