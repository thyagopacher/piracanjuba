<?php
	class Books extends ActiveObject {
		protected $activeModel = "BooksModel";
		protected $FID = "livroid";
		protected $testamento;
		public function getlivroid()
		{
			return $this->returnKey("livroid");
		}

		public function getsigla()
		{
			return $this->returnKey("sigla");
		}

		public function getnome()
		{
			return $this->returnKey("nome");
		}

		public function getinformacao()
		{
			return $this->returnKey("informacao");
		}

		public function gettestamentoid()
		{
			return $this->returnKey("testamentoid");
		}
		public function gettestamento()
		{
			if(!empty($this->testamento))
			{
				return $this->testamento;
			}
			if(empty($this->testamento))
			{
				$testamento = TestamentoModel::getOne($this->gettestamentoid());
				if(!empty($testamento[0]))
				{
					$this->testamento = $testamento[0];
				}
			}
			return $this->testamento;
		}

		public function getcategoriaid()
		{
			return $this->returnKey("categoriaid");
		}

		public function getProperties()
		{
			return $this->params;
		}
		public function save()
		{
		  return parent::save();
		}
		// Outputs
		public function toJSON()
		{
			$ret = parent::toJSON();
			$ret->testamento = $this->gettestamento()->toJSON();
			$ret->testamento_nome = $ret->testamento->nome;
			return $ret;
		}
	}
?>