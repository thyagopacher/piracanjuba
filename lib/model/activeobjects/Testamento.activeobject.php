<?php
	class Testamento extends ActiveObject {
		protected $activeModel = "TestamentoModel";
		protected $FID = "testamentoid";
		public function gettestamentoid()
		{
			return $this->returnKey("testamentoid");
		}

		public function getnome()
		{
			return $this->returnKey("nome");
		}

		public function getinformacao()
		{
			return $this->returnKey("informacao");
		}

		public function getProperties()
		{
			return $this->params;
		}
		public function save()
		{
		  return  parent::save();
		}
	}
?>