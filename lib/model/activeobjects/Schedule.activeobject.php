<?php
	class Schedule extends ActiveObject {
		protected $activeModel = "ScheduleModel";
		protected $FID = "id";
		
		public function getID()
		{
			return $this->returnKey("id");
		}
		public function getPlace()
		{
			return $this->returnKey("place");
		}
		public function getDate()
		{
			return $this->returnKey("date");
		}
		public function getTeam1()
		{
			$id  = $this->returnKey("team1");
			return $this->getTeam($id);
		}
		
		public function getTeam2()
		{
			$id  = $this->returnKey("team2");
			return $this->getTeam($id);
		}
		private function getTeam($id)
		{
			$team = SelectionsModel::getOne($id);
			return (!empty($team[0]))?$team[0]:false;
		}
		public function getWinner()
		{
			return $this->returnKey("winner");
		}
		public function getScoreTeam1()
		{
			return $this->returnKey("score_team1");
		}
		public function getScoreTeam2()
		{
			return $this->returnKey("score_team2");
		}
		public function getStatus()
		{
			return $this->returnKey("status");
		}
		public function getName()
		{
			return (string)$this;
		}
		public function __toString()
		{
			return $this->getPlace(). " - " . $this->getTeam1() . " x " . $this->getTeam2();
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