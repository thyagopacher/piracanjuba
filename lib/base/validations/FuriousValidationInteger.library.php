<?php
	class FuriousValidationInteger extends FuriousValidation
	{
		public function __construct (array $params = null)
		{
			parent::__construct($params);
			$this->messages["Max"] = "Número fora dos limites permitidos";
			$this->messages["Min"] = "Número fora dos limites permitidos";
			$this->messages["Default"] = "Este valor não é um inteiro";
		}
		public function validateMax($v, $max)
		{
			if($this->validateDefault($v))
			{
				if($v <= $max)
				{
					return true;
				}
			}
			return false;
		}
		public function validateMin($v, $min)
		{
			if($this->validateDefault($v))
			{
				if($v >= $min)
				{
					return true;
				}
			}
			return false;
		}
		public function validateDefault ( $v )
		{
			
			if(is_numeric( (int)$v ) && !is_bool($v))
			{
				return true;
			} else {
				return false;
			}
		}
	}
?>