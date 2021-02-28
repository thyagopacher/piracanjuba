<?php
	class Selections extends ActiveObject {
		protected $activeModel = "SelectionsModel";
		protected $FID = "id";
		
		public function getID()
		{
			return $this->returnKey("id");
		}
		public function getName()
		{
			return $this->returnKey("name");
		}
		public function getInitialPos()
		{
			return $this->returnKey("initial_pos");
		}
		public function getPoints()
		{
			return $this->returnKey("points");
		}
		public function getGroup()
		{
			return $this->returnKey("group");
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
		public function getDTA()
		{
		  return time();
		}
		public function __toString()
		{
			return (string)$this->returnKey("name");
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