<?php
	class FuriousValidationString extends FuriousValidation
	{
		public function __construct (array $params = null)
		{
			parent::__construct($params);
			$this->messages["MaxLength"] = "A string possui mais caracteres que a quantidade m�xima";
			$this->messages["MinLength"] = "A string n�o possui a quantidade m�nima de caracteres";
			$this->messages["Default"] = "Este valor n�o � uma string";
		}
		public function validateMinLength ( $v, $min )
		{
			if(strlen(trim($v)) >= $min)
			{
				return true;
			}
			return false;
		}
		public function validateMaxLength ( $v, $max )
		{
			if(strlen(trim($v)) <= $max)
			{
				return true;
			}
			return false;
		}
		public function validateDefault ( $v )
		{
			/*
			if($this->fieldc != null)
			{*/
				return FuriousChecker::isString( $v );
			/*
			}
			return true;*/
		}
	}
?>