<?php
	class Biblia extends ActiveObject {
		protected $activeModel = "BibliaModel";
		protected $FID = "textoid";
		protected $livro;
		public function gettextoid()
		{
			return $this->returnKey("textoid");
		}

		public function gettitulo()
		{
			return $this->returnKey("titulo");
		}

		public function getsubtitulo()
		{
			return $this->returnKey("subtitulo");
		}

		public function getcapitulo()
		{
			return $this->returnKey("capitulo");
		}

		public function getversiculo()
		{
			return $this->returnKey("versiculo");
		}

		public function gettexto()
		{
			return $this->returnKey("texto");
		}

		public function getreferencias()
		{
			return $this->returnKey("referencias");
		}

		public function getisjesus()
		{
			return $this->returnKey("isjesus");
		}

		public function getlivroid()
		{
			return $this->returnKey("livroid");
		}
		public function getLivro()
		{
			if(!empty($this->livro))
			{
				return $this->livro;
			}
			if(empty($this->livro))
			{
				$livro = BooksModel::getOne($this->getlivroid());
				if(!empty($livro[0]))
				{
					$this->livro = $livro[0];
					return $this->livro;
				}
			}
			return false;
		}
		public function formatedVersicle()
		{
			$livro = $this->getLivro();
			if($livro != false)
			{
				return sprintf("%s %s:%s", $livro->getnome(), ((string)$this->getcapitulo()), ((string)$this->getversiculo()));
			}
			return false;
		}
		public function getProperties()
		{
			return $this->params;
		}
		public function toJSON()
		{
			$ret = parent::toJSON();
			$ret->formatedVersicle = utf8_encode($this->formatedVersicle());
			return $ret;
		}
	}
?>