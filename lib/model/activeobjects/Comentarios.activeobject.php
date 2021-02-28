<?php
	class Comentarios extends ActiveObject {
		protected $activeModel = "ComentariosModel";
		protected $content;
		protected $FID = "MSG_ID";
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

		public function getMSGPAI()
		{
			return $this->returnKey("MSG_PAI");
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

		public function getMSGTXT()
		{
			return $this->returnKey("MSG_TXT");
		}

		public function getMSGRSP()
		{
			return $this->returnKey("MSG_RSP");
		}

		public function getMSGDTA()
		{
			return $this->returnKey("MSG_DTA");
		}

		public function getMSGSTS()
		{
			return $this->returnKey("MSG_STS");
		}

		public function getMSGUID()
		{
			return $this->returnKey("MSG_UID");
		}
		public function getUser()
		{
			$uid = $this->returnKey("MSG_UID");
			if(!empty($uid))
			{
				$user = UsuarioModel::getOne($uid);
				if(!empty($user[0]))
				{
					return $user[0];
				}
			}
			return false;
		}

		public function getContent()
		{
			if(!empty($this->content))
			{
				return $this->content;
			}
			$news = ConteudoModel::getOne($this->getMSGCNT());
			if(!empty($news[0]))
			{
				$this->content = $news[0];
				return $this->content;
			}
			
			return false;
		}
		public function approve()
		{
			$this->MSG_STS = 1;
			return $this->save();
		}
		public function delete()
		{
			$this->MSG_STS = 9;
			return $this->save();
		}
		public function getProperties()
		{
			return $this->params;
		}
		public function save()
		{
		 return parent::save();
		}
		public function toJSON()
		{
			$ret = new StdClasS();
			foreach($this->getProperties() as $prop => $value)
			{
				$ret->$prop = utf8_encode($value);
			}
			if(!empty($this->children))
			{
				$ret->children = array();
				foreach($this->children as $child)
				{
					$ret->children[] = $child->toJSON();
				}
			}
			$user = $this->getUser();
			if($user)
			{
				$ret->user = $user->toJSON();
			}
			return $ret;
		}
	}
?>