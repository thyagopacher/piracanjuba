<?php

	class FuriousLoginForm extends FuriousFormBase 
	{
		protected $name = "Login";
		//protected $class = "Users";
		public function configure(){
			$this->addWidgets(array(
				new FuriousInput2("username", "Nome de Usuário:"),
				new FuriousPasswordInput2("passwd", "Senha:"),
			));
			parent::configure();
		}
	}
?>