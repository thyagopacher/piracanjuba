<?php
	class Selections extends Conteudo {
		protected $activeModel = "CalendarsModel";
		protected $FID = "id";
		
		array("id", "place", "date", "team1", "team2", "winner", "score_team1", "score_team2", "status");
		
		
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
			return $this->returnKey("team1");
		}
		public function getTeam2()
		{
			return $this->returnKey("team2");
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