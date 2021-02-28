<?php
	class Players extends ActiveObject {
		protected $activeModel = "PlayersModel";
		protected $FID = "id";
		private $image;
		
		public function getID()
		{
			return $this->returnKey("id");
		}
		public function getTime()
		{
			return $this->returnKey("time");
		}
		public function getTeam()
		{
			$team = SelectionsModel::getOne($this->getTime());
			return (!empty($team[0]))?$team[0]:false;
		}
		public function getAge()
		{
			return $this->returnKey("age");
		}
		public function getGoals()
		{
			return $this->returnKey("goals");
		}
		public function getPosition()
		{
			return $this->returnKey("position");
		}
		public function getStatus()
		{
			return $this->returnKey("status");
		}
		public function getName()
		{
			return $this->returnKey("name");
		}
		public function __toString()
		{
			return $this->getName();
		}
		public function getImage()
		{
			if(!isset($this->image[0]))
			{
				$criteria = new FuriousSelectCriteria();
				$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_arquivos_conteudo`", "`cnt_arquivos_conteudo`.`ARC_AID`", "`cnt_arquivos`.`ARQ_ID`");
				$criteria->add("`cnt_arquivos_conteudo`.`ARC_CID`", $this->getID(), FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_arquivos_conteudo`.`ARC_CTP`", "THB_PLA", FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_arquivos_conteudo`.`ARC_STS`", 1, FuriousExpressionsDB::EQUAL);
				$criteria->addAscendingOrder("`cnt_arquivos_conteudo`.`ARC_ORD`");

				$this->image = ArquivoModel::doSelect($criteria);
			}
			return (!empty($this->image[0]))?$this->image[0]:false;
		}
		public function getProperties()
		{
			return $this->params;
		}
		public function save()
		{
		  return parent::save();
		}
		public function delete()
		{
			$this->params['status'] = 9;
			return $this->save();
		}
		public function publish()
		{
			$this->params['status'] = 1;
			return $this->save();
		}
		public function unpublish()
		{
			$this->params['status'] = 0;
			return $this->save();
		}
		
	}
?>